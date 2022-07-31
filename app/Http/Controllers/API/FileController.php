<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;

class FileController extends Controller
{

	private $userFolder = '../public/users-files/user1/';

	public function create(Request $request)
	{
		$folderName = $request->get('folderName');
			mkdir($this->userFolder . $folderName);
		return [
			"status" => true,
			"message" => "Folder successfully created",
		];
	}

	public function upload(Request $request)
	{
		$validator = Validator::make($request->all(), [
					'file' => 'required|mimes:doc,docx,pdf,txt,csv,png,jpg,gif,jpeg|max:2048',
		]);

		if ($validator->fails()) {
			return [
				'status' => 'false',
				'message' => $validator->errors()
			];
		}

//        $file = $request->file('file');
//        if ($file) {
//            $path = $file->store('public/users-files/user1');
//            $name = $file->getClientOriginalName();

		$tmpName = $_FILES['file']['tmp_name'];
		$fileName = $_FILES['file']['name'];
		move_uploaded_file($tmpName, $this->userFolder . $fileName);

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
		$itemName = $request->get('itemName');
		$itemFullPath = $this->userFolder . $itemName;
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
		$itemName = $request->get('itemName');
		$newName = $request->get('newName');
		rename($this->userFolder . $itemName, $this->userFolder . $newName);
		return [
			"status" => true,
			"message" => "File successfully deleted",
		];
	}
}
