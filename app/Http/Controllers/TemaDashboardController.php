<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemaDashboard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TemaDashboardController extends Controller
{
    public function index()
    {
        $tema = TemaDashboard::where('user_id', auth()->user()->id)->get()->first();

        if (!$tema) {
            $tema = TemaDashboard::get()->first();
        }
        return view('v_temadashboard', [
            'title' => 'Kelola Tema Dashboard',
            'tema' => $tema
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bg_sidebar' => 'required',
            'color_sidebar' => 'required',
            'bg_sidebar_active' => 'required',
            'bg_navbar' => 'required',
            'color_navbar' => 'required',
            'bg_footer' => 'required',
            'color_footer' => 'required',
            'bg_primary' => 'required',
            'color_primary' => 'required',
            'bg_secondary' => 'required',
            'color_secondary' => 'required',
        ]);

        DB::table('tema_dashboards')->upsert(
            [
                'user_id' => auth()->user()->id,
                'bg_sidebar' => $validatedData['bg_sidebar'],
                'color_sidebar' => $validatedData['color_sidebar'],
                'bg_sidebar_active' => $validatedData['bg_sidebar_active'],
                'bg_navbar' => $validatedData['bg_navbar'],
                'color_navbar' => $validatedData['color_navbar'],
                'bg_footer' => $validatedData['bg_footer'],
                'color_footer' => $validatedData['color_footer'],
                'bg_primary' => $validatedData['bg_primary'],
                'color_primary' => $validatedData['color_primary'],
                'bg_secondary' => $validatedData['bg_secondary'],
                'color_secondary' => $validatedData['color_secondary'],
            ],
            ['user_id'],
            [
                'bg_sidebar', 'color_sidebar', 'bg_sidebar_active', 'bg_navbar', 'color_navbar', 'bg_footer', 'color_footer', 'bg_primary', 'color_primary', 'bg_secondary', 'color_secondary'
            ]
        );

        return redirect('/dashboard/temadashboard')->with('success', 'Update tema Dashboard berhasil');
    }
}
