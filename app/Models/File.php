<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class File extends Model
{
    use HasFactory;
	
	public static function getExtension($filename) {
		return preg_replace('/^.*\.(.*)$/U', '$1', $filename);
	}
	
	public static function  getUserDir() {
		if(Auth::check()) {
			$userFolder = '../public/users-files/' . Auth::user()->name . '/';
		}
		else {
			$userFolder = '../public/users-files/guest/';
		}
		return $userFolder;
	}
}
