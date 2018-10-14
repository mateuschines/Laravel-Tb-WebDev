<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
    	return view('welcome');
    }

    public function amigos()
	 {
		$amigos = [
			['nome' => 'José Silva', 'idade' => 22],
			['nome' => 'Maria José', 'idade' => 20],
			['nome' => 'João Pinheiro', 'idade' => 35]
		];
	 	return $amigos;
	}

	public function sobre()
	 {
		$eu = [
			'nome' => 'Mateus', 'idade' => 21
		];
	 	return view('sobre', compact('eu'));
	}
}
