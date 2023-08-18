<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 追記
use App\Models\News;
use App\Models\Comment;
use Auth;

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
    
    public function add(Request $request)
    {
        return view('news.detail');
    }    
    
    public function comment(Request $request)
    {
        $this->validate($request, Comment::$rules);

        $comment = new Comment;
        $form = $request->all();
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);

        // データベースに保存する
        $comment->fill($form);
        $comment->user_id= Auth::id();
        $comment->save();
        // /commentにリダイレクトする
        return redirect('detail?id=' . $comment->news_id);
    }
}