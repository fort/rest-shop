<?php

use Tymon\JWTAuth\Facades\JWTAuth;

class AdminAuthTest extends TestCase
{
    protected $token = null;

    public function login()
    {
        $response = $this->call('POST', '/admin/auth/login',
            AdminData::CREDENTIALS['valid']);
        $data = json_decode($response->content(), true);
        $this->assertArrayHasKey('token', $data);
        $this->token = $data['token'];
        return $this->token;
    }

    public function test_adminAuthLoginOk()
    {
        $response = $this->call('POST', '/admin/auth/login',
            AdminData::CREDENTIALS['valid']);
        $this->assertArrayHasKey('token', $response->original);
    }

    public function test_adminAuthLoginUsernameInvalidFailure()
    {
        $response = $this->call('POST', '/admin/auth/login',
            AdminData::CREDENTIALS['invalid']['invalidUsername']);
        $this->assertEquals(422, $response->status());
        $this->assertArrayHasKey('username', $response->original);
    }

    public function test_adminAuthLoginEmail404Failure()
    {
        $response = $this->call('POST', '/admin/auth/login',
            AdminData::CREDENTIALS['invalid']['notfoundUsername']);
        $this->assertEquals(404, $response->status());
    }

    public function test_adminAuthLoginExpectUsernameFailure()
    {
        $credentials = AdminData::CREDENTIALS['valid'];
        unset($credentials['username']);
        $response = $this->call('POST', '/admin/auth/login',
            $credentials);
        $this->assertEquals(422, $response->status());
        $this->assertArrayHasKey('username', $response->original);
    }

    public function test_adminAuthLoginExpectPwdFailure()
    {
        $credentials = AdminData::CREDENTIALS['valid'];
        unset($credentials['password']);
        $response = $this->call('POST', '/admin/auth/login',
            $credentials);
        $this->assertEquals(422, $response->status());
        $this->assertArrayHasKey('password', $response->original);
    }

    public function test_adminAuthLoginExpectAllFailure()
    {
        $credentials = AdminData::CREDENTIALS['valid'];
        $response = $this->call('POST', '/admin/auth/login',
            []);
        $this->assertEquals(422, $response->status());
        $this->assertArrayHasKey('username', $response->original);
        $this->assertArrayHasKey('password', $response->original);
    }

    public function test_adminMeOk()
    {
        $this->login();
        $response = $this->call('GET', '/admin/me?token=' . $this->token);
        $data = json_decode($response->content(), true);
        $this->assertArrayHasKey('user_id', $response->original);
    }
}