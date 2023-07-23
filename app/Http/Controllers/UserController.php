<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TemaDashboard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Contracts\Service\Attribute\Required;

class UserController extends Controller
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

        return view('v_user.index', [
            'title' => 'Kelola Data User',
            'users' => User::all(),
            'tema' => $tema
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tema = $this->tema();

        return view('v_user.create', [
            'title' => 'Tambah Data User',
            'tema' => $tema
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['status'] = 1;
        $validatedData = $request->validate([
            'role' => 'required',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:8000',
            'no_induk' => 'required|unique:users,no_induk',
            'name' => 'required|max:255',
            'birthdate' => 'required',
            'no_hp' => 'required|unique:users,no_hp',
            'address' => 'required',
            'major' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'status' => 'required',
        ]);

        if ($request->file('avatar')) {
            $validatedData['avatar'] = $request->file('avatar')->store('user-images');
        }

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        return redirect('/dashboard/user')->with('success', 'Tambah Data User Berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $tema = $this->tema();

        return view('v_user.show', [
            'title' => 'Lihat Data User',
            'user' => $user,
            'tema' => $tema
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $tema = $this->tema();

        return view('v_user.edit', [
            'title' => 'Ubah Data User',
            'user' => $user,
            'tema' => $tema
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'role' => 'nullable',
            'status' => 'nullable',
            'address' => 'required',
            'major' => 'required',
            'name' => 'required|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:8000'
        ];

        if ($request->no_induk != $user->no_induk) {
            $rules['no_induk'] = 'required|unique:users';
        }

        if ($request->no_hp != $user->no_hp) {
            $rules['no_hp'] = 'required|unique:users';
        }

        if ($request->username != $user->username) {
            $rules['username'] = 'required|unique:users';
        }

        if ($request->email != $user->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }

        if ($request->password) {
            $rules['password'] = 'required';
            $rules['newpassword'] = 'required|confirmed';
            if (!Hash::check($request->password, $user->password)) {
                return back()->with('password', 'The password field is incorrect');
            }
        }

        $validatedData = $request->validate($rules);

        if ($request->file('avatar')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['avatar'] = $request->file('avatar')->store('user-images');
        } else {
            $validatedData['avatar'] = $request->oldImage;
        }

        unset($validatedData['newpassword']);

        $validatedData['isRegistered'] = 1;

        User::where('id', $user->id)->update($validatedData);

        if ($request->profil) {
            return redirect('/profile')->with('success', 'Data Profil berhasil diubah');
        } else {
            return redirect('/dashboard/user')->with('success', 'Data User berhasil diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->avatar) {
            Storage::delete($user->avatar);
        }
        User::destroy($user->id);
        return redirect('/dashboard/user')->with('success', 'Data Dosen telah dihapus');
    }
}
