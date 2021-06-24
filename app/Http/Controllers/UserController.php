<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = UserRepository::showSuper($request);
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(StoreUserRequest $request)
    {
        $user = UserRepository::store($request);
        return redirect()->route('user.index')->with('success', 'User ' . $user->name . ' created');
    }

    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    public function update(User $user, UpdateCustomerRequest $request)
    {
        $user->update($request->all());
        return redirect()->route('user.index')->with('success', 'User ' . $user->name . ' udpated!');
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('user.index')->with('success', 'User ' . $user->name . ' deleted!');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('failed', 'Customer ' . $user->name . ' cannot be deleted! Error Code:' . $e->errorInfo[1]);;
        }
    }

    public function profile()
    {
        $id = Auth::id();
        return 'Otw buat profile id-'.$id;
    }

    public function activity()
    {
        $id = Auth::id();
        return 'Otw buat activity id-'.$id;
    }

    public function setting()
    {
        $id = Auth::id();
        return 'Otw buat setting id-'.$id;
    }

    public function editPassword(User $user)
    {
        return view('user.editPassword', compact('user'));
    }

    public function updatePassword(UpdatePasswordRequest $request, User $user)
    {
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('user.show', ['user'=>$user])->with('success', 'Password berhasil diubah');
    }
}
