<?php
class ProductControllerTest extends TestCase
{
	public function test_getCategories()
	{
		$result = $this->get('/client/categories', ['X-localization' => 'en-gb']);
		$this->assertEquals(200, $result->response->status());
		$categories = $result->response->content();
	}
}