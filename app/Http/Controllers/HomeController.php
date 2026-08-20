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
        // EJ
        $nosotros = "hola";

        return view('nosotros', compact(
            'nosotros',
        ));
    }

    public function productos()
    {
        // EJ
        $productos = "hola";

        return view('productos', compact(
            'productos',
        ));
    }
    public function contacto()
    {
        // EJ
        $contacto = "hola";

        return view('contacto', compact(
            'contacto',
        ));
    }
    public function servicios()
    {
        // EJ
        $servicios = "hola";

        return view('servicios', compact(
            'servicios',
        ));
    }
}