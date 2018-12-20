<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Language;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
	public function me(Request $request)
	{
		$user = $request->user();
		return $user;
	}
}
