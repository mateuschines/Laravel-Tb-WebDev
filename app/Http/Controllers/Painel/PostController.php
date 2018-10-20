<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Painel\StandardController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\DB;

use App\Models\Post;

class PostController extends StandardController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $model;
    protected $totalpages = 2;
    protected $views = 'painel.modulos.posts';
    protected $rotas = 'posts';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    

   
}
