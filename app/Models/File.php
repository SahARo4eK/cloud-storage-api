<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class File extends Model
{
    use HasFactory;
	
	public static function getExtension(string $filename) {
		return preg_replace('/^.*\.(.*)$/U', '$1', $filename);
	}
	
	public static function  getUserDir() {
		if(Auth::check()) {
			$userFolder = '../public/users-files/' . Auth::user()->name . '/';
		}
		else {
			$userFolder = '../public/users-files/guest/';
			if(!is_dir($userFolder)) {
				mkdir($userFolder);
			}
		}
		return $userFolder;
	}
	
	public static function scanDirectory(string $directory) {
		return array_diff(scandir($directory), array('..', '.'));
	}
	
	public static function getDirSize(string $directory = null){
		$directorySize = 0;
		if(null === $directory) {
			$directory = File::getUserDir();
		}
		$items = File::scanDirectory($directory);
		foreach ($items as $item) {
			$itemPath = $directory . '/' . $item;
			if(is_dir($itemPath)) {
				$directorySize += self::getDirSize($itemPath);
			}
			else {
				$directorySize += filesize($itemPath);
			}
		}
		return $directorySize;
	}
}
