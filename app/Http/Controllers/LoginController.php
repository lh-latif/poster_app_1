<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController {
    public static function show(Request $req) {
        $msg = $req->session()->get("login");
        if (isset($msg)) {
            var_dump($msg);
        }
        return view("login");
    }

    public static function submit(Request $req) {
        $data = $req->validate([
          "email" => ["email"],
          "password" => ["string","min:6"]
        ]);
        $result = User::verify_user(
            $data["email"],
            $data["password"]
          );
        if ($result->is_success()) {
            $req->session()->put("usk",$result->unwrap()->id);
            return redirect("/account");
        } else {
            $req->session()->put("login",$result->unwrap()->getMessage());
            return redirect("/login");
        }

    }
}

?>
