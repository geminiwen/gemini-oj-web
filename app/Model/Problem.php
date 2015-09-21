<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/20
 * Time: 下午1:29
 */

namespace Gemini\Model;


use Illuminate\Database\Eloquent\Model;

class Problem extends Model{

    protected $table = "problem";
    public $timestamps = false;
    public $fillable = ["title", "description", "input", "output",
                        "sample_input", "sample_output", "input_file", "output_file"];

}