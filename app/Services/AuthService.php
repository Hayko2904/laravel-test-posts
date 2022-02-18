<?php


namespace App\Services;


use App\Jobs\SendRegistrationEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthService
{
    public function login(array $data)
    {
        if (!empty($data['email'])) {
            $auth = is_numeric($data['email'])
                ? auth()->attempt(['phone' => $data['email'], 'password' => $data['password']])
                : auth()->attempt(['email' => $data['email'], 'password' => $data['password']]);
        } elseif (is_null($data['email'])) {
            $auth = auth()->attempt(['phone' => $data['phone'], 'password' => $data['password']]);
        }

        if (auth()->user() && is_null(auth()->user()->email_verified_at)) {
            $this->logout();

            return false;
        }

        return $auth;
    }

    public function registration(array $data)
    {
        try {
            DB::beginTransaction();
            $data['password'] = bcrypt($data['password']);
            $data['verify_token'] = Str::random(20);
            if (!$data['email']) {
                $data['email_verified_at'] = Carbon::now();
            }

            $user = User::query()->create($data);

            DB::commit();

            if ($user['email']) {
                dispatch(new SendRegistrationEmail($user));
            }

            return $user;
        } catch (\Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function getUser(array $data)
    {
        if (!empty($data['email'])) {
            $user = !is_numeric($data['email'])
                ? User::query()->whereEmail($data['email'])->first()
                : User::query()->wherePhone($data['email'])->first();
        }

        if (!empty($data['token'])) {
            $user = User::query()->whereVerifyToken($data['token'])->first();
        }

        return $user;
    }

    public function verify(User $user)
    {
        try {
            DB::beginTransaction();
            $user->query()
                ->update([
                    'verify_token' => null,
                    'email_verified_at' => Carbon::now()
                ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function logout()
    {
        return auth()->logout();
    }
}
