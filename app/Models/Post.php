<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    protected $fillable = [
        'title',
        'user_id',
        'category_id',
        'description',
        'date',
        'hour',
        'featured',
        'status',
        'image'
    ];

    public function rules($id = ''){
        return [
            'title'         => 'required|min:3|max:250',
            'category_id'   => 'required',
            'description'   => 'required|min:10|max:6000',
            'date'          => 'required|date',
            'hour'          => 'required',
            'status'        => 'required|in:A,R',
            'image'         => 'image',
        ];
    }

    /**
     * Retornar o usuário do post./
     */    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
