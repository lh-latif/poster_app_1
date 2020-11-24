<?php

namespace App\Models;

use App\Models\User\{Data,Password};
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\Result;

class User {
    private static function join_user_and_password($id) {
        $user = Data::get_table();
        $passw = Password::get_table();
        DB::table($user)
          ->join($passw,$user.".id","=",$passw.".user_id")
          ->select($user.".*",$passw.".*")
          ->where($user.".id",$id)
          ->first();
    }

    public static function add_user_and_password($name,$email,$password) {
        return DB::transaction(function() use (&$name,&$email,&$password) {
            $user = self::add_user($name,$email);
            $password = self::add_password($user->id,$password);
        });
    }

    public static function get_user($id) {
        return Data::find($id);
    }

    public static function verify_user($email,$password) {
        $user = Data::get_table();
        $passw = Password::get_table();
        $user_data = DB::table($user)
          ->join($passw,$user.".id","=",$passw.".user_id")
          ->select($user.".*",$passw.".*")
          ->where($user.".email",$email)
          ->first();
        // var_dump($user_data);
        if (isset($user_data) && password_verify($password,$user_data->hash)) {
            return Result::success($user_data);
        } else {
            return Result::error(new Exception("user not found"));
        }
    }

    private static function add_user($name,$email) {
        $user = new Data();
        $user->name = $name;
        $user->email = $email;
        $user->save();
        return $user;
    }

    private static function add_password($user_id,$password) {
        $password = crypt($password,"KUcingTerbangX2sfd23234234ffdsgdsfg");
        $passw = new Password();
        $passw->user_id = $user_id;
        $passw->hash = $password;
        return $passw->save();
    }
}
