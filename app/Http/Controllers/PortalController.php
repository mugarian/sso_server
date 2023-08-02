<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\LogHistory;
use App\Models\TemaPortal;
use Illuminate\Http\Request;
use Laravel\Passport\Client;
use App\Models\TemaDashboard;
use jcobhams\NewsApi\NewsApi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Dcblogdev\MsGraph\Facades\MsGraph;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class PortalController extends Controller
{
    public function index()
    {
        $api_key = '9ebeafd8d5654d78b55c72523c9d65b2';
        $newsapi = new NewsApi($api_key);

        $news = News::where('user_id', auth()->user()->id)->get()->first();
        if (!$news) $news = News::get()->first();
        $query = $news['query'] ?? null;
        $sources = null;
        $country = $news['country'] ?? null;
        $category = $news['category'] ?? null;
        $page_size = $news['page_size'] ?? 6;
        $page = null;

        $all_news = $newsapi->getTopHeadlines($query, $sources, $country, $category, $page_size, $page);
        $tema = TemaPortal::get()->first();
        $events = User::all();
        $agendas = Agenda::all();
        $clients = Client::all();
        $beritas = Berita::all();

        $news = News::where('user_id', auth()->user()->id)->get()->first();
        if (!$news) $news = News::get()->first();
        $countries = [
            ['Amerika', 'us'],
            ['Arab Saudi', 'sa'],
            ['Belanda', 'nl'],
            ['China', 'cn'],
            ['Inggris', 'gb'],
            ['Indonesia', 'id'],
            ['Japan', 'jp'],
            ['Jerman', 'de'],
            ['Korea', 'kr'],
            ['Rusia', 'ru'],
            ['Singapura', 'sg'],
        ];
        $categories = $newsapi->getCategories();
        return view('v_portal', [
            'title' => 'SSO Portal',
            'all_news' => $all_news->articles,
            'news' => $news,
            'countries' => $countries,
            'categories' => $categories,
            'clients' => $clients,
            'tema' => $tema,
            'events' => $events,
            'agendas' => $agendas,
            'beritas' => $beritas,
        ]);
    }

    public function dashboard()
    {
        // $client = Client::all()->count();
        $client = Client::all()->count();
        $dosen = User::where('role', 'dosen')->count();
        $mahasiswa = User::where('role', 'mahasiswa')->count();
        $staff = User::where('role', 'staff')->count();

        $tema = TemaDashboard::where('user_id', auth()->user()->id)->get()->first();
        if (!$tema) $tema = TemaDashboard::get()->first();

        $logs = LogHistory::whereBetween('login_at', [date('Y-m-d 00:00:00'), date('Y-m-d 23:59:59')])->orderBy('login_at', 'desc')->get();
        $activities = DB::table('activity_log')
            ->join('users', 'activity_log.causer_id', '=', 'users.id')
            ->select('activity_log.*', 'users.name')
            ->orderBy('created_at', 'desc')->get();

        return view('v_dashboard', [
            'title' => 'Dashboard',
            'client' => $client,
            'dosen' => $dosen,
            'mahasiswa' => $mahasiswa,
            'staff' => $staff,
            'tema' => $tema,
            'logs' => $logs,
            'activities' => $activities
        ]);
    }

    public function faq()
    {
        $tema = TemaPortal::get()->first();
        $events = User::all();
        $agendas = Agenda::all();

        return view('v_faq', [
            'title' => 'Frequently Ask Question ',
            'tema' => $tema,
            'events' => $events,
            'agendas' => $agendas
        ]);
    }

    public function profile()
    {
        $user = User::find(auth()->user()->id);
        $tema = TemaPortal::get()->first();
        $events = User::all();
        $agendas = Agenda::all();

        return view('v_profil', [
            'title' => 'Profil ',
            'user' => $user,
            'tema' => $tema,
            'events' => $events,
            'agendas' => $agendas
        ]);
    }

    public function updateprofile(Request $request, $id)
    {
        $user = User::find($id);
        $rules = [
            'role' => 'nullable',
            'status' => 'nullable',
            'address' => 'required',
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

        User::find($user->id)->update($validatedData);

        if ($request->isRegistered) {
            return redirect('/profile')->with('success', 'Data Profil berhasil diubah');
        } else {
            return redirect('/portal')->with('success', 'Selamat Anda Telah Terdaftar di Sistem SSO');
        }
    }

    public function connect()
    {
        return MsGraph::connect();
    }

    public function logout()
    {
        return MsGraph::disconnect();
    }

    public function app()
    {
        // return MsGraph::get('me');
        return redirect('/portal');
    }
}
