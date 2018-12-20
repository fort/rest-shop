<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\ApiException;

class Language extends Model
{
	protected $table = 'language';
	protected $primaryKey = 'language_id';

	public static function checkCodeOrReturnDefault($code = null)
	{
		$result = Language::select('code')
		->where('status', '=', 1);
		if (strlen($code)) {
			$result->where('code', '=', $code);
		}

		$result = $result->first();
		if (!$result)
			throw new ApiException("Invalid locale", 1);
	}
}