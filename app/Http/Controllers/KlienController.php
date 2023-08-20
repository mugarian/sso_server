<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemaDashboard;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Storage;

class KlienController extends Controller
{
    public function tema()
    {
        $tema = TemaDashboard::where('user_id', auth()->user()->id)->get()->first();
        if (!$tema) $tema = TemaDashboard::get()->first();

        return $tema;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tema = $this->tema();
        $clients = Client::all();

        return view('v_client.index', [
            'title' => 'Kelola Data client',
            'clients' => $clients,
            'tema' => $tema
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tema = $this->tema();

        return view('v_client.create', [
            'title' => 'Tambah Data Client',
            'tema' => $tema
        ]);
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
    public function show($client)
    {
        $tema = $this->tema();

        $client = CLient::find($client);


        return view('v_client.show', [
            'title' => 'Lihat Data Client',
            'client' => $client,
            'tema' => $tema
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($client)
    {
        $tema = $this->tema();

        $client = CLient::find($client);

        return view('v_client.edit', [
            'title' => 'Ubah Data Client',
            'client' => $client,
            'tema' => $tema
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        if ($client->logo) {
            Storage::delete($client->logo);
        }
        Client::destroy($client->id);
        return redirect('/dashboard/klien')->with('success', 'Data Client berhasil dihapus');
    }
}
