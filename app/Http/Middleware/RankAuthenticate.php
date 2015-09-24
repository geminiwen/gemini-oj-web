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

        $hashId = "contest_id_" . hash("sha1", $id);
        $id = $request->route("id");
        $contest = Contest::find($id);

        $hashId = "contest_id_" . hash("sha1", $id);

        $isSecret = $contest->is_secret;
        $password = $contest->password;

        $session = $request->session();

        $decrypt = $session->get($hashId, "");

        if ($isSecret && $decrypt != $password) {
            $url = sprintf("/contest/%d/decrypt", $id);
            return redirect()->guest($url);
        }
        return $next($request);
    }
}