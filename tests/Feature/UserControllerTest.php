<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLogin()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Login');
    }

    public function testLoginSuccess()
    {
        $response = $this->post('/login', [
            'user' => 'admin',
            'password' => 'admin'
        ]);

        $response->assertRedirect('/')
            ->assertSessionHas('user', 'admin');
    }

    public function testLoginFailure()
    {
        // $response = $this->post('/login', [])
        //     ->assertSeeText("Username and password are required.");
        $response = $this->post('/login', [
            'user' => 'admin',
            'password' => 'wrongpassword'
        ])->assertSeeText("Invalid username or password.");
    }

    public function testLoginValidationError()
    {
        $response = $this->post('/login', [])
            ->assertSeeText("Username and password are required.");
    }

    public function testLogout() {
        $this -> withSession([
            "user" => "admin"
        ])->post('/logout')
        ->assertRedirect("/")
        ->assertSessionMissing("user");
    }

    public function testLoginPageForMember() {
        $this->withSession([
            "user" => "admin"
        ])->get('/login')
        ->assertRedirect("/");
    }

    public function testLoginForUserAlreadyLogin() {
        $this->withSession([
            "user"=>"admin"
        ])->post('/login', [
            "user"=>"admin",
            "password"=>"admin"
        ])->assertRedirect("/");
    }

    public function testGuest() {
        $this->post('/logout')
        ->assertRedirect('/');
    }
}
