<?php


use Tymon\JWTAuth\Facades\JWTAuth;

class AdminAuthTest extends TestCase
{
    use ApiTestCase;
    protected $token = null;

    public function login()
    {
        $response = $this->call('POST', '/admin/auth/login',
            CREDENTIALS['admin']['valid']);
        $json = $this->jsonHasToken($response->content());
        return $json['token'];
    }

    public function test_adminAuthLoginOk()
    {
        $response = $this->call('POST', '/admin/auth/login',
            CREDENTIALS['admin']['valid']);
        $this->jsonHasToken($response->content());
    }

    public function test_adminAuthLoginUsernameInvalidFailure()
    {
        $result = $this->call('POST', '/admin/auth/login',
            CREDENTIALS['admin']['invalid']['invalidUsername']);
        $this->assertResponseStatus(422);
        $this->errorsHasKeys($result->content(), ['username']);
    }

    public function test_adminAuthLoginEmail404Failure()
    {
        $response = $this->call('POST', '/admin/auth/login',
            CREDENTIALS['admin']['invalid']['notfoundUsername']);
        $this->assertResponseStatus(404);
    }

    public function test_adminAuthLoginExpectUsernameFailure()
    {
        $credentials = CREDENTIALS['admin']['valid'];
        unset($credentials['username']);
        $response = $this->call('POST', '/admin/auth/login',
            $credentials);
        $this->assertResponseStatus(422);
        $this->errorsHasKeys($response->content(), ['username']);
        $this->assertSuccess($response->content(), false);

    }

    public function test_adminAuthLoginExpectPwdFailure()
    {
        $credentials = CREDENTIALS['admin']['valid'];
        unset($credentials['password']);
        $response = $this->call('POST', '/admin/auth/login',
            $credentials);
        $this->assertResponseStatus(422);
        $this->errorsHasKeys($response->content(), ['password']);
    }

    public function test_adminAuthLoginExpectAllFailure()
    {
        $credentials = CREDENTIALS['admin']['valid'];
        $response = $this->call('POST', '/admin/auth/login',
            []);
        $this->assertResponseStatus(422);
        $this->errorsHasKeys($response->content(), ['password', 'username']);
    }

    public function test_adminMeOk()
    {
        $token = $this->login();
        $response = $this->call('GET', '/admin/me?token=' . $token);
        $data = json_decode($response->content(), true);
        $this->assertArrayHasKey('user_id', $response->original);
    }
}