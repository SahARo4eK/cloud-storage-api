<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
	
	public static function getExtension($filename) {
		return preg_replace('/^.*\.(.*)$/U', '$1', $filename);
	}
}
