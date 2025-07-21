<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Lulusan;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index()
    {
        // Ambil data alumni beserta relasi lulusan dan wali
        $alumnis = Alumni::with(['lulusans', 'wali'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('alumni.index', compact('alumnis'));
    }

    public function show($id)
    {
        $alumni = Alumni::with(['lulusans', 'wali'])->findOrFail($id);
        return view('alumni.show', compact('alumni'));
    }
}