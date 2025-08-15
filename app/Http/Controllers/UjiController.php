<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Uji;

class UjiController extends Controller
{
    public function index()
    {
        // Ambil semua data uji dari database
       $uji = Uji::with('pengajuan')->latest()->get();
        return view('uji.index', compact('uji'));
    }
}
