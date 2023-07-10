<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profiles;

class ProfileController extends Controller
{
        public function add()
    {
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
        // Validationを行う
        $this->validate($request, Profiles::$rules);

        $profile = new Profiles;
        $form = $request->all();

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);

        // データベースに保存する
        $profile->fill($form);
        $profile->save();
        
        return redirect('admin/profile/create');
    }
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Profiles::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = Profiles::all();
        }
        return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }


    public function edit(Request $request)
    {
        // News Modelからデータを取得する
        $profile = Profiles::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        return view('admin.profile.edit', ['profile_form' => $profile]);
    }
    
    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Profiles::$rules);
        // News Modelからデータを取得する
        $profile = Profiles::find($request->id);
        // 送信されてきたフォームデータを格納する
        $profile_form = $request->all();

        if ($request->remove == 'true') {
            $profile_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $profile_form['image_path'] = basename($path);
        } else {
            $profile_form['image_path'] = $profile->image_path;
        }

        unset($profile_form['image']);
        unset($profile_form['remove']);
        unset($profile_form['_token']);

        $profile->fill($profile_form)->save();

        return redirect('admin/profile/create');
    }
}
