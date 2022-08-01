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
		if (!is_dir($userDirectory)) {
			mkdir($userDirectory);
		}
		$filesFolders = File::scanDirectory($userDirectory);
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

	public function getUser()
	{
		$users = DB::select('select name from users');
		return ['users' => $users];
	}

	public function getDirectorySize(Request $request)
	{
		$folder = $request->get('folder');
		$directory = File::getUserDir();
		if(null != $folder) {
			$directory .= $folder . '/';
		}
		if(!is_dir($directory)) {
			return [
				'status' => 'false',
				'message' => 'There is no folder: ' . $folder
			];
		}
		return File::getDirSize($directory);
	}

}
