<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    public function setup(): void
    {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);
    }

    public function test_example(): void
    {
        self::assertTrue(true);
    }

    public function test_login_success(): void
    {
        $result = $this->userService->login('admin', 'admin');
        self::assertTrue($result);
    }

    public function test_login_failure(): void
    {
        $result = $this->userService->login('admin', 'wrong_password');
        self::assertFalse($result);
    }

    public function test_login_nonexistent_user(): void
    {
        $result = $this->userService->login('nonexistent_user', 'some_password');
        self::assertFalse($result);
    }
}
