<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agenda;
use App\Models\Celebrate;
use App\Models\TemaPortal;
use Illuminate\Http\Request;
use App\Models\TemaDashboard;

class CelebrateController extends Controller
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
        // $users = DB::table('users')->where('id', '!=', '1')->where('tgl_lahir', '=', date('Y-m-d'))->orderBy('tgl_lahir', 'asc')->get();
        $users = User::where('id', '<>', '1')->whereRaw("DATE_FORMAT(birthdate,'%m-%d') = DATE_FORMAT(NOW(),'%m-%d')")->get();

        $user = User::find(auth()->user()->id);

        $celebrates = Celebrate::all();

        return view('v_celebrate.index', [
            'title' => 'Kelola Data Ucapan Pereayaan',
            'users' => $users,
            'celebrates' => $celebrates,
            'tema' => $tema
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($user)
    {
        $user = User::find($user);
        $tema = $this->tema();
        return view('v_celebrate.create', [
            'title' => 'Ucapan Perayaan Untuk ' . $user->name,
            'user' => $user,
            'tema' => $tema
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'receiver_id' => 'required',
            'sender_id' => 'required',
            'message' => 'required',
        ]);

        Celebrate::create($validatedData);

        if ($request->celebrate) {
            return redirect('/show/celebrate/' . $request->receiver_id)->with('success', 'Ucapan Perayaan Berhasil Dikirim');
        } else {
            return redirect('/dashboard/celebrate')->with('success', 'Ucapan Perayaan Berhasil Dikirim');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Celebrate $celebrate)
    {
        $tema = $this->tema();
        return view('v_celebrate.show', [
            'title' => 'Ucapan Perayaan Untuk ' . $celebrate->receiver->name,
            'celebrate' => $celebrate,
            'tema' => $tema,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($celebrate)
    {
        $tema = $this->tema();
        $celebrate = celebrate::find($celebrate);
        return view('v_celebrate.edit', [
            'title' => 'Kelola Ucapan Perayaan',
            'celebrate' => $celebrate,
            'tema' => $tema,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $celebrate)
    {
        $validatedData = $request->validate([
            'receiver_id' => 'required',
            'sender_id' => 'required',
            'message' => 'nullable',
            'reply' => 'nullable',
        ]);

        Celebrate::find($celebrate)->update($validatedData);
        if ($request->celebrate) {
            return redirect('/show/celebrate/' . $request->receiver_id)->with('success', 'Ucapan Perayaan Berhasil Dikirim');
        } else {
            return redirect('/dashboard/celebrate')->with('success', 'Ucapan Perayaan Berhasil Dikirim');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Celebrate $celebrate)
    {
        Celebrate::destroy($celebrate->id);
        return redirect('/dashboard/celebrate')->with('success', 'Ucapan Perayaan Berhasil Dihapus');
    }

    public function showcelebrate($id)
    {
        $user = User::find($id);
        $celebrates = Celebrate::where('receiver_id', $id)->orderBy('updated_at', 'DESC')->get();
        $tema = TemaPortal::get()->first();

        return view('v_celebrate.showall', [
            'title' => 'Ucapan Perayaan Untuk ' . $user->name,
            'celebrates' => $celebrates,
            'user' => $user,
            'tema' => $tema,
        ]);
    }
}
