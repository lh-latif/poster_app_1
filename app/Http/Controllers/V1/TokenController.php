<?php
namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;

use App\Models\User;
use Firebase\JWT\JWT;
use App\Models\Result;

class TokenController {
  public static function login(Request $req) {
    $data = $req->validate([
      "password" => ["string","min:6"],
      "email" => ["email"]
    ]);
    $result = User::verify_user(
        $data["email"],
        $data["password"]
      );
    if ($result->is_error()) {
      return response()->json([
        "error" => "not_found"
      ]);
    } else {
      return response()->json([
        "token" => JWT::encode(["user_id" => $result->unwrap()->id], env("APP_KEY","sdlfjsdlj"))
      ]);
    }
  }

  public static function user(Request $req) {
    return response()->json($req->user);
  }
}

?>
