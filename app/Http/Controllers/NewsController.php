<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

// 追記
use App\Models\News;
use App\Models\Comment;
use Auth;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::query();
        $posts = $query->orderByDesc('updated_at')->paginate(10);
        
        $headline = null;
        if (empty($request->page) || $request->page == 1) {
            if (count($posts) > 0) {
                $headline = $posts->shift();
            }
        }
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
        
        $comments = $news->comments->sortByDesc('updated_at');
        return view('news.detail', ['news' => $news,'comments' =>$comments]);
    }
    
    public function add(Request $request)
    {
        return view('news.comment');
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