<?php
/**
 * Created by IntelliJ IDEA.
 * User: geminiwen
 * Date: 15/9/23
 * Time: 下午10:04
 */

namespace Gemini\Http\Middleware;


use Closure;
use Gemini\Model\Contest;

class RankTimeCheck {

    public function handle($request, Closure $next) {
        $id = $request->route("id");
        $contest = Contest::find($id);

        $currentTime = time();

        $startTime = strtotime($contest->start_time);

        if ($currentTime < $startTime) {
            return response("Contest Not Start", "404");
        }
        return $next($request);
    }
}