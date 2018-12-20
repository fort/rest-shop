<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryDescription;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class ProductController extends Controller
{
	public function getCategories(Request $request)
	{
		$tree = Category::buildTree(Category::withDescription());
		return response()->json($tree);
	}
}