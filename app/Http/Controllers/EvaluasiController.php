<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Evaluasi;
use Illuminate\Http\Request;
use App\Models\TemaDashboard;

class EvaluasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function tema()
     {
         $tema = TemaDashboard::where('user_id', auth()->user()->id)->get()->first();
         if (!$tema) $tema = TemaDashboard::get()->first();

         return $tema;
     }

    public function index()
    {
        $tema = $this->tema();

        return view('v_evaluasi.index', [
            'title' => 'Kelola Data Evaluasi Kinerja',
            'beritas' => Berita::all(),
            'tema' => $tema
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Evaluasi $evaluasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluasi $evaluasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluasi $evaluasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluasi $evaluasi)
    {
        //
    }
}
