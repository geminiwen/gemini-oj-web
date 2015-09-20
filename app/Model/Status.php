<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/20
 * Time: 下午1:29
 */

namespace Gemini\Model;


use Illuminate\Database\Eloquent\Model;

class Status extends Model{

    protected $table = "status";
    protected $guarded = [];
    public $timestamps = false;


    public function user() {
        return $this->belongsTo('Gemini\Model\User', 'user_id')->select(['id', 'username']);
    }

    public function problem() {
        return $this->belongsTo('Gemini\Model\Problem', 'problem_id');
    }
}