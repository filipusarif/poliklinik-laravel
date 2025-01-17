<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poli;

class HomepageController extends Controller
{
    //
    public function index()
    {
        $polis = Poli::all();

        return view('frontend.homepage', compact('polis'));
    }
}
