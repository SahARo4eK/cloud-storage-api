<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\File;

class IndexController extends Controller
{
	public function getDirectory()
	{
		$userDirectory = File::getUserDir();
		if(!is_dir($userDirectory)) {
			mkdir($userDirectory);
		}
		$filesFolders = array_diff(scandir($userDirectory), array('..', '.'));
		$response = [];
		foreach ($filesFolders as $item) {
			$type = 'file';
			if (is_dir($userDirectory . $item)) {
				$type = 'folder';
			}
			$response [] = [
				'name' => $item,
				'type' => $type
			];
		}
		return $response;
	}

	public function getUser(Request $request)
	{
		$users = DB::select('select name from users');
		return ['users' => $users];
	}

}
