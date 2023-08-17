<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\TemaPortal;
use Illuminate\Http\Request;
use App\Models\TemaDashboard;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
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

        return view('v_news.index', [
            'title' => 'Kelola Data Berita',
            'beritas' => Berita::all(),
            'tema' => $tema
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tema = $this->tema();

        return view('v_news.create', [
            'title' => 'Tambah Data Berita',
            'tema' => $tema
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:8000',
            'description' => 'required',
            'attachment' => 'nullable|file|max:8000',
        ]);

        if ($request->file('avatar')) {
            $validatedData['avatar'] = $request->file('avatar')->store('news-images');
            $validatedData['cover'] = $validatedData['avatar'];
            unset($validatedData['avatar']);
        }

        if ($request->file('attachment')) {
            $validatedData['attachment'] = $request->file('attachment')->store('news-files');
        }

        $validatedData['user_id'] = auth()->user()->id;

        Berita::create($validatedData);
        return redirect('/dashboard/news')->with('success', 'Tambah Data Berita Berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $berita = Berita::find($id);
        $tema = $this->tema();

        return view('v_news.show', [
            'title' => 'Lihat Data Berita',
            'berita' => $berita,
            'tema' => $tema
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $berita = Berita::find($id);
        $tema = $this->tema();

        return view('v_news.edit', [
            'title' => 'Ubah Data Berita',
            'berita' => $berita,
            'tema' => $tema
        ]);
    }

    public function shownews($id)
    {
        $berita = Berita::find($id);
        $tema = TemaPortal::get()->first();

        return view('v_news.shownews', [
            'title' => 'Lihat Data Berita',
            'berita' => $berita,
            'tema' => $tema,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $berita = Berita::find($id);
        $validatedData = $request->validate([
            'title' => 'required',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:8000',
            'description' => 'required',
            'attachment' => 'nullable|file|max:8000',
        ]);

        if ($request->file('avatar')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['avatar'] = $request->file('avatar')->store('news-images');
            $validatedData['cover'] = $validatedData['avatar'];
            unset($validatedData['avatar']);
        } else {
            $validatedData['avatar'] = $request->oldImage;
            $validatedData['cover'] = $validatedData['avatar'];
            unset($validatedData['avatar']);
        }

        if ($request->file('attachment')) {
            if ($request->oldAttachment) {
                Storage::delete($request->oldAttachment);
            }
            $validatedData['attachment'] = $request->file('attachment')->store('news-files');
        } else {
            $validatedData['attachment'] = $request->oldAttachment;
        }

        Berita::find($berita->id)->update($validatedData);
        return redirect('/dashboard/news')->with('success', 'Ubah Data Berita Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $berita = Berita::find($id);
        if ($berita->cover) {
            Storage::delete($berita->cover);
        }
        if ($berita->attachment) {
            Storage::delete($berita->attachment);
        }
        Berita::destroy($berita->id);
        return redirect('/dashboard/news')->with('success', 'Data Berita telah dihapus');
    }
}
