<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 追記
use App\Models\News;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $posts = News::all()->sortByDesc('updated_at');

        if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

        // news/index.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、という変数を渡している
        return view('news.index', ['headline' => $headline, 'posts' => $posts]);
    }
    
    // ニュース詳細を表示するアクションを追加
    public function detail(Request $request)
    {
        // 指定されたニュース記事を取得する
        $news = News::find($request->id);
        if (empty($news)) {
            abort(404);
        }
        return view('news.detail', ['news' => $news]);
    }
}