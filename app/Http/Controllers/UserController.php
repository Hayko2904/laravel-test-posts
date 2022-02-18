<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $data = $this->userService->index();

        return view('users', [
            'users' => $data
        ]);
    }

    public function upload(Request $request, int $id)
    {
        if ($request->hasFile('file')) {
            $this->userService->upload($request->file('file'), $id);
        }

        return redirect()->route('home');
    }

    public function profile()
    {
        return view('profile', [
            'user' => auth()->user()
        ]);
    }
}
