<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.users.index')->with('users', User::paginate(10));
    }

    public function edit($id) {
        if (Auth::user()->id == $id) {
            return redirect()->route('admin.users.index');
        }
        return view('admin.users.edit')->with(['user' => User::find($id), 'roles' => Role::all()]);
    }

    public function update(Request $request, $id) {
        $user = User::find($id);
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index');
    }

    public function create() {
        return view('admin.users.create')->with(['roles' => Role::all()]);
    }

    public function store(Request $request) {
        if (!$request->roles || !$request->name || !$request->email || !$request->password) {
            return view('admin.users.create')->with(['roles' => Role::all()]);
        }
        $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
        ]);

        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $user = User::find($id);
        if ($user) {
            $user->roles()->detach();
            $user->delete();
            return redirect()->route('admin.users.index');
        }



        return redirect()->route('admin.users.index');
    }

}
