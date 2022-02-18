<?php


namespace App\Services;


use App\Models\User;

class UserService
{
    public function index()
    {
        return User::all();
    }

    public function upload($file, $userId = null)
    {
        $file = $file->store('', 'public');

        if ($userId) {
            $user = auth()->user()->is_admin
            ? User::query()->find($userId)
            : User::query()->find(auth()->id());

            $user->update([
                'avatar' => $file
            ]);
        }
    }
}
