<?php

use Tymon\JWTAuth\Facades\JWTAuth;

class ClientAuthTest extends TestCase
{
    protected $token = null;

    public function login()
    {
        $response = $this->call('POST', '/client/auth/login',
            ClientData::CREDENTIALS['valid']);
        $data = json_decode($response->content(), true);
        $this->assertArrayHasKey('token', $data);
        $this->token = $data['token'];
        return $this->token;
    }

    public function test_clientAuthLoginOk()
    {
        $response = $this->call('POST', '/client/auth/login',
            ClientData::CREDENTIALS['valid']);
        $this->assertArrayHasKey('token', $response->original);
    }

    public function test_clientAuthLoginEmailInvalidFailure()
    {
        $response = $this->call('POST', '/client/auth/login',
            ClientData::CREDENTIALS['invalid']['invalidEmail']);
        $this->assertEquals(422, $response->status());
        $this->assertArrayHasKey('email', $response->original);
    }

    public function test_clientAuthLoginEmail404Failure()
    {
        $response = $this->call('POST', '/client/auth/login',
            ClientData::CREDENTIALS['invalid']['notfoundEmail']);
        $this->assertEquals(404, $response->status());
    }

    public function test_clientAuthLoginExpectEmailFailure()
    {
        $credentials = ClientData::CREDENTIALS['valid'];
        unset($credentials['email']);
        $response = $this->call('POST', '/client/auth/login',
            $credentials);
        $this->assertEquals(422, $response->status());
        $this->assertArrayHasKey('email', $response->original);
    }

    public function test_clientAuthLoginExpectPwdFailure()
    {
        $credentials = ClientData::CREDENTIALS['valid'];
        unset($credentials['password']);
        $response = $this->call('POST', '/client/auth/login',
            $credentials);
        $this->assertEquals(422, $response->status());
        $this->assertArrayHasKey('password', $response->original);
    }

    public function test_clientAuthLoginExpectAllFailure()
    {
        $credentials = ClientData::CREDENTIALS['valid'];
        $response = $this->call('POST', '/client/auth/login',
            []);
        $this->assertEquals(422, $response->status());
        $this->assertArrayHasKey('email', $response->original);
        $this->assertArrayHasKey('password', $response->original);
    }

    public function test_clientMeOk()
    {
        $this->login();
        $response = $this->call('GET', '/client/me?token=' . $this->token);
        $data = json_decode($response->content(), true);
        $this->assertArrayHasKey('customer_id', $response->original);
    }
}