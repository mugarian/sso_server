<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Models\TemaDashboard;
use jcobhams\NewsApi\NewsApi;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{

    public function tema()
    {
        $tema = TemaDashboard::where('user_id', auth()->user()->id)->get()->first();
        if (!$tema) $tema = TemaDashboard::get()->first();

        return $tema;
    }

    public function index()
    {
        $tema = $this->tema();

        $api_key = '9ebeafd8d5654d78b55c72523c9d65b2';
        $newsapi = new NewsApi($api_key);

        $categories = $newsapi->getCategories();
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

        $news = News::where('user_id', auth()->user()->id)->get()->first();

        if (!$news) $news = News::get()->first();

        $query = $news->query;
        $sources = null;
        $country = $news->country;
        $category = $news->category;
        $page_size = $news->page_size;
        $page = null;

        $all_news = $newsapi->getTopHeadlines($query, $sources, $country, $category, $page_size, $page);

        return view('v_news.index', [
            'title' => 'Kelola Berita',
            'tema' => $tema,
            'all_news' => $all_news->articles,
            'countries' => $countries,
            'categories' => $categories,
            'news' => $news,
        ]);
    }

    public function storeapi(Request $request)
    {
        $validatedData = $request->validate([
            'query' => 'nullable',
            'country' => 'required',
            'category' => 'required',
            'page_size' => 'required',
        ]);

        $news = News::where('user_id', auth()->user()->id)->first();

        if ($news) {
            $news->update([
                'query' => $validatedData['query'],
                'country' => $validatedData['country'],
                'category' => $validatedData['category'],
                'page_size' => $validatedData['page_size'],
            ]);
        } else {
            News::create([
                'user_id' => auth()->user()->id,
                'query' => $validatedData['query'],
                'country' => $validatedData['country'],
                'category' => $validatedData['category'],
                'page_size' => $validatedData['page_size'],
            ]);
        }

        return redirect('/portal')->with('success', 'Update Rekomendasi Berita berhasil');
    }
}
