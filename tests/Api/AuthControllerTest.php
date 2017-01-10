<?php

use App\Models\User;

class AuthControllerTest extends TestCase
{
    public function test_login_returns_email_validation_error_no_data()
    {
        $this->post('/api/login')
        ->seeJsonStructure([
            'email' => []
        ]);
        $this->assertResponseStatus(HTTP_CODE_VALIDATION_ERROR);
    }

    public function test_login_returns_password_validation_error_no_data()
    {
        $this->post('/api/login')
        ->seeJsonStructure([
            'password' => []
        ]);
        $this->assertResponseStatus(HTTP_CODE_VALIDATION_ERROR);
    }

    public function test_login_returns_email_validation_error_empty_key()
    {
        $this->post('/api/login',['email' => null])
        ->seeJsonStructure([
            'email' => []
        ]);
        $this->assertResponseStatus(HTTP_CODE_VALIDATION_ERROR);
    }

    public function test_login_returns_password_validation_error_empty_key()
    {
        $this->post('/api/login',['password' => null])
        ->seeJsonStructure([
            'password' => []
        ]);
        $this->assertResponseStatus(HTTP_CODE_VALIDATION_ERROR);
    }

    public function test_login_returns_email_validation_error_on_empty_string()
    {
        $this->post('/api/login',['email' => ''])
        ->seeJsonStructure([
            'email' => []
        ]);
        $this->assertResponseStatus(HTTP_CODE_VALIDATION_ERROR);
    }

    public function test_login_returns_password_validation_error_on_empty_string()
    {
        $this->post('/api/login',['password' => ''])
        ->seeJsonStructure([
            'password' => []
        ]);
        $this->assertResponseStatus(HTTP_CODE_VALIDATION_ERROR);
    }

    public function test_login_returns_email_validation_error_on_spaced_string()
    {
        $this->post('/api/login',['email' => '   '])
        ->seeJsonStructure([
            'email' => []
        ]);
        $this->assertResponseStatus(HTTP_CODE_VALIDATION_ERROR);
    }

    public function test_login_returns_password_validation_error_on_spaced_string()
    {
        $this->post('/api/login',['password' => '   '])
        ->seeJsonStructure([
            'password' => []
        ]);
        $this->assertResponseStatus(HTTP_CODE_VALIDATION_ERROR);
    }

    public function test_no_user_returns_email_validation()
    {
        $this->runMigrations();
        $this->post('/api/login',[
            'email' => 'example@example.co.za',
            'password' => 'password'
        ])->seeJsonStructure([
            'email' => []
        ]);
        $this->assertResponseStatus(HTTP_CODE_VALIDATION_ERROR);
    }

    public function test_incorrect_credentials_returns_email_validation()
    {
        $this->runMigrations();
        $user = factory(\App\Models\User::class)->create();
        $this->post('/api/login',[
            'email' => $user->email,
            'password' => 'password'
        ])->seeJsonStructure([
            'email' => []
        ]);
        $this->assertResponseStatus(HTTP_CODE_VALIDATION_ERROR);
    }

    public function test_correct_credentials_returns_token_response()
    {
        $this->runMigrations();
        $user = factory(User::class)->create([
            'password' => bcrypt('password')
        ]);
        $this->post('/api/login',[
            'email' => $user->email,
            'password' => 'password'
        ])->seeJsonStructure([
            'token'
        ]);
        $this->assertResponseStatus(HTTP_CODE_OK);
    }

    public function test_user_gets_valid_api_token_on_login()
    {
        $this->runMigrations();
        $user = factory(User::class)->create([
            'password' => bcrypt('password')
        ]);
        $this->assertFalse($user->hasValidToken());
        $this->post('/api/login',[
            'email' => $user->email,
            'password' => 'password'
        ])->seeJsonStructure([
            'token'
        ]);
        $this->assertResponseStatus(HTTP_CODE_OK);
        $user = User::find($user->id);
        $this->assertNotNull($user->api_token);
        $this->assertNotNull($user->api_token_expires);
        $this->assertTrue($user->hasValidToken());
    }
}
