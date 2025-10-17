<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function login(): Response {
        return response()
            -> view('user.login', [
                'title' => 'Login'
            ]);
    }

    public function doLogin(Request $request): Response|RedirectResponse {
        $user = $request->input('user');
        $password = $request->input('password');

        if (empty($user) || empty($password)) {
            return response()
                ->view('user.login', [
                    'title' => 'Login',
                    'error' => 'Username and password are required.'
                ]);
        }

        if ($this->userService->login($user, $password)) {
            $request->session()->put('user', $user);
            return redirect('/');
        }

        return response()->view('user.login', [
            'title' => 'Login',
            'error' => 'Invalid username or password.'
        ]);
    }

    public function doLogout() {

    }
}
