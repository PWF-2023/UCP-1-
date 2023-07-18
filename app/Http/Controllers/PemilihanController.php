<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kandidat; 

class PemilihanController extends Controller
{
    public function index()
    {
        $kandidat = Kandidat::all();

        return view('pemilihan.index', compact('kandidat'));
    }
}
