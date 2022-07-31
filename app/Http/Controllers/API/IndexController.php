<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{  
    public function getDirectory()
    { 
        $userDirectory = '../public/users-files/user1/';
        $filesFolders = array_diff(scandir($userDirectory), array('..', '.'));
        foreach($filesFolders as $item){
            $type = 'file';
            if(is_dir($userDirectory . $item)){
                $type = 'folder';
            }
            $response [] = [
                'name' => $item,
                'type' => $type
            ];
        }
        return $response;
    }
}