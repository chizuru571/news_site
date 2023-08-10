<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileHistory extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'profile_id' => 'required',
        'edited_at' => 'required'
    );

    /**
     * モデル関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'profilehistories';

    // public function profilehistories()
    // {
    //     return $this->hasMany('App\Models\ProfileHistory');
    // }
}
