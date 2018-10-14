<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function index()
    {
        return view ('site.index');
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
