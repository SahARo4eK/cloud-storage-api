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
//		$validator = Validator::make($request->all(), [
//					'file' => 'required|mimes:doc,docx,pdf,txt,csv,png,jpg,gif,jpeg|max:20480000',
//		]);
//		
//		if ($validator->fails()) {
//			return [
//				'status' => 'false',
//				'message' => $validator->errors()
//			];
//		}

//        $file = $request->file('file');
//        if ($file) {
//            $path = $file->store('public/users-files/user1');
//            $name = $file->getClientOriginalName();
		//$fileData = $request->get('fileData');
		$tmpName = $_FILES['file']['tmp_name'];
		$fileName = $_FILES['file']['name'];
		if('php' == File::getExtension($fileName)){
			return [
				'status' => 'false',
				'message' => '.php extension not allowed'
			];
		}
		move_uploaded_file($tmpName, $userFolder . $fileName);

		//store your file into directory and db
//            $save = new File();
//            $save->name = $file;
//            $save->path= $path;
//            $save->save();

		return [
			"status" => true,
			"message" => "File successfully uploaded",
			"file" => $fileName
		];

		//}
	}

	public function delete(Request $request)
	{
		$userFolder = File::getUserDir();
		$itemName = $request->get('itemName');
		$itemFullPath = $userFolder . $itemName;
			if(is_dir($itemFullPath)) {
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
