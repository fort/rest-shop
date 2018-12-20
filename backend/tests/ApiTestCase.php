<?php
trait ApiTestCase {

	public function containErrors ($content)
	{
		$this->seeJson();
		$json = json_decode($content, true);
		$this->assertArrayHasKey('errors', $json, "Expecting 'errors' in {$content}");
		return $this;
	}

	public function errorsHasKeys($content, $keys) {
		$this->containErrors($content);

		if (is_string($keys))
			$keys = [$keys];
		$args = func_get_args();
		$json = json_decode($content, true);
		$errors = json_decode($json['errors'], true);
		$this->assertEquals(true, is_array($errors));
		foreach ($keys as $key) {
			$this->assertArrayHasKey($key, $errors, "Expecting {$key} in {$json['errors']}");
		}
		return $this;
	}

	public function assertSuccess($content, $flag = null)
	{
		$flag = !! $flag;
		$json = json_decode($content, true);
		$this->assertArrayHasKey('success', $json, "Expecting 'success' in {$content}");
		if (null !== $flag) {
			$str_flag = ($flag) ? 'true' : 'false';
			$this->assertEquals($flag, $json['success'], "Expecting success as {$str_flag} in {$content}");
		}
	}
	public function jsonHasToken($content)
	{
		$json = json_decode($content, true);
		$this->assertArrayHasKey('token', $json, "Expecting 'token' in {$content}");
		return $json;
	}
	
	public function jsonHasKey($content, $key)
	{
		$json = json_decode($content, true);
		$this->assertArrayHasKey($key, $json, "Expecting '{$key}' in {$content}");
		return $json;
	}
}