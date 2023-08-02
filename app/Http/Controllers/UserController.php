<?php

namespace App\Http\Controllers;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Models\TemaDashboard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Validation\Rules\Password;
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
            'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised(), 'confirmed'],
            'password_confirmation' => 'required',
            'status' => 'required',
            'isVerified' => 'required',
            'isRegistered' => 'required',
            'isMicrosoftAccount' => 'required',
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

        $activities = DB::table('activity_log')
            ->join('users', 'activity_log.causer_id', '=', 'users.id')
            ->select('activity_log.*', 'users.name')
            ->where('causer_id', $user->id)
            ->orderBy('created_at', 'desc')->get();

        return view('v_user.show', [
            'title' => 'Lihat Data User',
            'user' => $user,
            'tema' => $tema,
            'activities' => $activities
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
            'birthdate' => 'required',
            'status' => 'nullable',
            'isVerified' => 'nullable',
            'isRegistered' => 'nullable',
            'isMicrosoftAccount' => 'nullable',
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
            $rules['newpassword'] = ['required', 'string', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised(), 'confirmed'];
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

    public function import(Request $request)
    {
        $validatedData = $request->validate([
            'import' => 'required|file|mimes:xls,xlsx|max:8000'
        ]);

        $excelFile = $request->file('import');

        try {
            $spreadsheet = IOFactory::load($excelFile->getRealPath());
            $sheet        = $spreadsheet->getSheet(0);
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range    = range(2, $row_limit);
            $column_range = range('A', $column_limit);
            $startcount = 2;

            // $data = array();

            foreach ($row_range as $row) {

                $birthdate = $sheet->getCell('B' . $row)->getValue() . '-' . $sheet->getCell('C' . $row)->getValue() . '-' . $sheet->getCell('D' . $row)->getValue();
                $password = Hash::make($sheet->getCell('E' . $row)->getValue());

                $data_mentah = [
                    'name' => $sheet->getCell('A' . $row)->getValue(),
                    'birthdate' => $birthdate,
                    'no_induk' => $sheet->getCell('E' . $row)->getValue(),
                    'no_hp' => $sheet->getCell('F' . $row)->getValue(),
                    'address' => $sheet->getCell('G' . $row)->getValue(),
                    'major' => $sheet->getCell('H' . $row)->getValue(),
                    'role' => $sheet->getCell('I' . $row)->getCalculatedValue(),
                    'username' => $sheet->getCell('J' . $row)->getValue(),
                    'email' => $sheet->getCell('K' . $row)->getValue(),
                    'password' => $password,
                ];
                User::create($data_mentah);
            }
        } catch (\Exception $e) {
            return redirect('/dashboard/user')->with('fail', 'Import Data user Gagal');
        }
        return redirect('/dashboard/user')->with('success', 'Import Data user Berhasil');
    }
}
