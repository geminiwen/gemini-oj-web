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

class RankEndTimeCheck {

    public function handle($request, Closure $next) {
        $id = $request->route("id");
        $contest = Contest::find($id);

        $currentTime = time();

        $endTime = strtotime($contest->end_time);

        if ($currentTime > $endTime) {
            return response("Contest Ended", "404");
        }
        return $next($request);
    }
}