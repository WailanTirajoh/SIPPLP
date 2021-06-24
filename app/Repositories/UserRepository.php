<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public static function store($data)
    {
        $user = new User();
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = bcrypt($data->password);
        $user->role = 'Super';
        $user->save();

        if($data->hasfile('avatar'))
        {
            $avatarName = $data->file('avatar')->getClientOriginalName();
            $data->file('avatar')->move('img/user/'.$user->id.'/',$avatarName);
            $user->avatar = $avatarName;
            $user->save();
        }

        return $user;
    }

    public static function update($data, $user)
    {
        $user->name = $data->name;

        if(auth()->user()->role == 'Super') {
            $user->email = $data->email;
        }

        if(auth()->user()->id == $user->id || in_array(auth()->user()->role, ['Super', 'Admin'])) {
            $user->password = bcrypt($data->password);
        }

        $user->save();

        if($data->hasfile('avatar'))
        {
            $avatarName = $data->file('avatar')->getClientOriginalName();
            $data->file('avatar')->move('img/user/'.$user->id.'/',$avatarName);
            $user->avatar = $avatarName;
            $user->save();
        }

        return $user;
    }

    public static function storeAtlet($data)
    {
        $user = new User;
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = bcrypt($data->tanggal_lahir);
        $user->role = 'Atlet';
        $user->save();

        if($data->hasfile('avatar'))
        {
            $path = 'img/user/'.$user->id;

            $fileName = $data->file('avatar')->getClientOriginalName();
            $data->file('avatar')->move($path.'/',$fileName);
            $user->avatar = $fileName;
            $user->save();
        }

        return $user;
    }

    public static function storePelatih($data)
    {
        $user = new User;
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = bcrypt($data->tanggal_lahir);
        $user->role = 'Pelatih';
        $user->save();

        if($data->hasfile('avatar'))
        {
            $path = 'img/user/'.$user->id;

            $fileName = $data->file('avatar')->getClientOriginalName();
            $data->file('avatar')->move($path.'/',$fileName);
            $user->avatar = $fileName;
            $user->save();
        }

        return $user;
    }

    public static function showSuper($request)
    {
        $users = User::
        // where('role','Super')->
        orderBy('role','ASC')
        // orderBy('id', 'DESC')
        ;

        if (!empty($request->qu)) {
            $users = $users->where('name', 'LIKE', '%' . $request->qu . '%');
        }

        $users = $users->paginate(10, ['*'], 'users');
        $users->appends($request->all());

        return $users;
    }
}
