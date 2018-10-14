<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = [
    'name', 'url','image','description',
	];

	public function rules(){
		return  [
			'name'      => 'required|min:3|max:100',
            'url'     	=> 'required|min:3|max:100',
            'image' 	=> 'image',
            'description'  => 'required|min:3|max:100',
		];
	}
}
