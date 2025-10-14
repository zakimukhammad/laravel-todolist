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
}
