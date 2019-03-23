<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
	protected $table = 'category';
	protected $primaryKey = 'category_id';

	public function description()
	{
		return $this->hasMany('App\Models\Category', 'category_id', 'category_id');
	}

	public static function withDescription()
	{
		$categories = DB::table('category')
		->join('category_description', 'category.category_id', '=', 'category_description.category_id')
		->orderBy('category.sort_order', 'ASC')
		->orderBy('category.category_id', 'ASC')
		->get();
		return $categories;
	}

	public static function buildTree($categories, $parent = null)
	{
		$branch = array();

		foreach ($categories as $row) {
			if ($row->parent_id == $parent) {
				$row->children = Category::buildTree($categories, $row->category_id);
				$branch[] = $row;
			}
		}
		return $branch;
	}
}