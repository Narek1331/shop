<?php

namespace App\Services;
use App\Models\User;

class UserService
{

    public function store($name,$surname,$email,$password){
        return User::create([
            'name'=>$name,
            'surname'=>$surname,
            'email'=>$email,
            'password'=>$password
        ]);
    }

    public function update($user_id,$data){
        return User::find($user_id)->update($data);
    }

}

?>
