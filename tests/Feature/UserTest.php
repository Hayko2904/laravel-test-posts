<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_registration()
    {
        $phone = '11111111111111111111';
        $response = $this->post(route('auth.registration', [
            '_token' => csrf_token(),
            'name' => 'test_name',
            'email' => '',
            'phone' => $phone ,
            'password' => '123456789',
            'password_confirmation' => '123456789'
        ]));

        User::query()->wherePhone('11111111111111111111')->first()->delete();

        $response->assertRedirect(route('home'));
    }
}
