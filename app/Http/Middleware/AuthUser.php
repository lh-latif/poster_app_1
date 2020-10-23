<?php
namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;


class AuthUser {
  public static function handle(Request $req, Closure $next, ...$guards) {
    $session = $req->session();
    if ($session->has("usk")) {
      $user = User::get_user($session->get("usk"));
      if (isset($user) && $user !== false) {
        $req->user = $user;
        return $next($req);
      }
    }

    return redirect("/login");
  }
}
?>
