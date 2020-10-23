<?php
namespace App\Http\Middleware\V1;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Exception;


class AuthToken {
  public static function handle(Request $req, Closure $next, ...$guards) {
    $header = $req->header();
    $token = $header["authorization"];
    if ($token != null && $token[0] != null) {
      try {
        // mut $token
        $token = strtr($token[0],["Bearer " => ""]);
        // var_dump($token);
        // mut $token
        $token = JWT::decode($token, env("APP_KEY","sdlfjsdlj"), array("HS256"));
      } catch(Exception $e) {
        return response("",403);
      }
      $user = User::get_user($token->user_id);
      if (isset($user) && $user !== false) {
        $req->user = $user;
        return $next($req);
      }
    }

    return response("",403);
  }
}

?>
