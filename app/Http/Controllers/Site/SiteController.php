<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{

    public function index()
    {
        $datas = DB::table('posts')->paginate(15);

        $Posts = DB::select('select * from posts');
        return view ('site.index', compact('Posts', 'datas'));
    }

    public function categoria()
    {
        return view ('site.pages.categoria');
    }

    public function post()
    {
        return view ('site.pages.post');
    }

    public function empresa()
    {
        return view ('site.pages.empresa');
    }

    public function contato()
    {
        return view ('site.pages.contato');
    }
}
