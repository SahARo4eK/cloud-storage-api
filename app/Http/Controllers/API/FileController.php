<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\File;
use Validator;
use Illuminate\Http\Request;

class FileController extends Controller
{
	public function create(Request $request)
	{
		$userFolder = File::getUserDir();
		$folderName = $request->get('folderName');
			mkdir($userFolder . $folderName);
		return [
			"status" => true,
			"message" => "Folder successfully created",
		];
	}

	public function upload(Request $request)
	{
		$userFolder = File::getUserDir();
		$paramFolder = $request->get('folder');
		if($paramFolder != null) {
			$uploadFolder = $userFolder . '/' .$paramFolder;
		}
		else {
			$uploadFolder = $userFolder;
		}
		
		$validator = Validator::make($request->all(), [
					'file' => 'required|max:2048',
		]);
		if ($validator->fails()) {
			return [
				'status' => 'false',
				'message' => $validator->errors()
			];
		}
		$tmpName = $_FILES['file']['tmp_name'];
		$fileName = $_FILES['file']['name'];
		if('php' == File::getExtension($fileName)){
			return [
				'status' => 'false',
				'message' => '.php extension not allowed'
			];
		}
		move_uploaded_file($tmpName, $uploadFolder . '/' . $fileName);
		return [
			"status" => true,
			"message" => "File successfully uploaded",
			"file" => $fileName
		];
	}

	public function delete(Request $request)
	{
		$userFolder = File::getUserDir();
		$itemName = $request->get('itemName');
		$itemFullPath = $userFolder . $itemName;
			if(is_dir($itemFullPath)) {
				$files = File::scanDirectory($itemFullPath);
				foreach ($files as $file) {
					unlink($itemFullPath . '/' . $file);
				}
				rmdir($itemFullPath);
			}
			else {
				unlink($itemFullPath);
			}
		return [
			"status" => true,
			"message" => "File successfully deleted",
		];
	}

	public function rename(Request $request)
	{
		$userFolder = File::getUserDir();
		$itemName = $request->get('itemName');
		$newName = $request->get('newName');
		rename($userFolder . $itemName, $userFolder . $newName);
		return [
			"status" => true,
			"message" => "File successfully deleted",
		];
	}
}
