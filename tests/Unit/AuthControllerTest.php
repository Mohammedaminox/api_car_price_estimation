<?php

namespace Tests\Unit;

use tests\TestCase;
class AuthControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testLoginWithIvalidData(){
        $response = $this->postJson('/api/login', [
            'email' => 'invalid@example.com',
            'password' => 'invalidpassword',
        ]);

        $response->assertStatus(401);
        $response->assertJson(['invalid' => 'invalid data']);
    }
}
