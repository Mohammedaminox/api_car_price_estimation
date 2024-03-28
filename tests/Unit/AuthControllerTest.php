<?php

namespace Tests\Unit;

use tests\TestCase;
class AuthControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testLoginWithInvalidData(){
        $response = $this->postJson('/api/login', [
            'email' => 'invalid@example.com',
            'password' => 'invalidpassword',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['valid' => 'valid data']);
    }
}
