<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Banner;
use Illuminate\Support\Facades\Http;


class HomeController extends Controller
{
    public function index()
    {
        // EJ
        $home = "hola";

        return view('home', compact(
            'home',
        ));
    }

    public function nosotros()
    {
        return view('nosotros');
    }

    public function productos()
    {
        return view('productos');
    }

    public function servicios()
    {
        return view('servicios');
    }

    public function contacto()
    {
        return view('contacto');
    }
}