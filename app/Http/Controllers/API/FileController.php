<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\File;
use Validator;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(Request $request)
    {        
        $validator = Validator::make($request->all(),[ 
              'file' => 'required|mimes:doc,docx,pdf,txt,csv,png,jpg,gif,jpeg|max:2048',
        ]);   
 
        if($validator->fails()) {          
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
            move_uploaded_file($tmpName, '../public/users-files/user1/' . $fileName);
 
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
}
