<?php

namespace App\Services\impl;

use App\Services\UserService;

class UserServiceImpl implements UserService {

    private array $users = [
        'admin' => 'admin',
        'user1' => 'password1',
        'user2' => 'password2',
    ];

    public function login(string $user, string $password): bool
    {
        return isset($this->users[$user]) && $this->users[$user] === $password;
    }
}
