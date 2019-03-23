<?php

use Tymon\JWTAuth\Facades\JWTAuth;

class ClientAuthTest extends TestCase
{
    use ApiTestCase;
    public function login()
    {
        $response = $this->call('POST', '/client/auth/login',
            CREDENTIALS['client']['valid']);
        $json = $this->jsonHasToken($response->content());
        return $json['token'];
    }

    public function test_clientAuthLoginOk()
    {
        $response = $this->call('POST', '/client/auth/login',
            CREDENTIALS['client']['valid']);
        $this->assertResponseStatus(200);
        $this->jsonHasToken($response->content());
    }

    public function test_clientAuthLoginEmailInvalidFailure()
    {
        $response = $this->call('POST', '/client/auth/login',
            CREDENTIALS['client']['invalid']['invalidEmail']);
        $this->assertResponseStatus(422);
        $this->errorsHasKeys($response->content(), ['email']);
    }

    public function test_clientAuthLoginEmail404Failure()
    {
        $response = $this->call('POST', '/client/auth/login',
            CREDENTIALS['client']['invalid']['notfoundEmail']);
        $this->assertResponseStatus(404);
    }

    public function test_clientAuthLoginExpectEmailFailure()
    {
        $credentials = CREDENTIALS['client']['valid'];
        unset($credentials['email']);
        $response = $this->call('POST', '/client/auth/login',
            $credentials);
        $this->assertResponseStatus(422);
        $this->errorsHasKeys($response->content(), ['email']);
    }

    public function test_clientAuthLoginExpectPwdFailure()
    {
        $credentials = CREDENTIALS['client']['valid'];
        unset($credentials['password']);
        $response = $this->call('POST', '/client/auth/login',
            $credentials);
        $this->assertResponseStatus(422);
        $this->errorsHasKeys($response->content(), ['password']);
    }

    public function test_clientAuthLoginExpectAllFailure()
    {
        $credentials = CREDENTIALS['client']['valid'];
        $response = $this->call('POST', '/client/auth/login', []);
        $this->assertResponseStatus(422);
        $this->errorsHasKeys($response->content(), ['password', 'email']);
    }

    public function test_clientMeOk()
    {
        $token = $this->login();
        $response = $this->call('GET', '/client/me?token=' . $token);
        $this->assertResponseStatus(200);
        $this->jsonHasKey($response->content(), 'customer_id');
    }
}