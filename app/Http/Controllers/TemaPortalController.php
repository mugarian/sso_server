<?php

namespace App\Http\Controllers;

use App\Models\TemaPortal;
use Illuminate\Http\Request;
use App\Models\TemaDashboard;
use Illuminate\Support\Facades\Storage;

class TemaPortalController extends Controller
{
    public function temadashboard()
    {
        $temadashboard = TemaDashboard::where('user_id', auth()->user()->id)->get()->first();
        if (!$temadashboard) {
            $temadashboard = TemaDashboard::get()->first();
        }

        return $temadashboard;
    }

    public function index()
    {
        $tema = $this->temadashboard();
        $temaPortal = TemaPortal::get()->first();

        return view('v_temaportal', [
            'title' => 'Kelola Tema Portal',
            'temaPortal' => $temaPortal,
            'tema' => $tema
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bg_main' => 'required',
            'layout_main' => 'required',
            'color_main' => 'required',
            'button_primary' => 'required',
            'button_color_primary' => 'required',
            'cover_main' => 'nullable|mimes:jpg,jpeg,png|max:8000',
        ]);

        if ($request->file('cover_main')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['cover_main'] = $request->file('cover_main')->store('cover-images');
        }

        TemaPortal::where('user_id', 1)->update($validatedData);
        return redirect('/dashboard/temaportal')->with('success', 'Update tema portal berhasil');
    }
}
