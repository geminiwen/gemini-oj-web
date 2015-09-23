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

class RankAuthenticate {

    public function handle($request, Closure $next) {
        $id = $request->route("id");
        $contest = Contest::find($id);

        $isSecret = $contest->is_secret;

        if ($isSecret) {
            return response("Contest is Private", 404);
        }
        return $next($request);
    }
}