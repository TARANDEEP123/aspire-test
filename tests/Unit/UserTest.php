<?php

namespace Tests\Unit;

use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
       $userData = [

        'email' => 'admin@aspire.com',
        'password' => 'password',
    ];

    $response = $this->post('/api/login', $userData);
    $response->assertStatus(200);
    }
}
