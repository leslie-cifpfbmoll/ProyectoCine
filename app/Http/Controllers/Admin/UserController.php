<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = User::paginate(10);
        return view('admin.users.index')->with('users', $users);
    }

    public function edit(Request $request, $id) {


        $user = User::find($id);
        $roles = Role::all();
        if (Auth::user()->id == $id) {
            $request->session()->flash('warning', 'No puedes editar tu propio usuario.');
            return redirect()->route('admin.users.index');
        }
        return view('admin.users.edit')->with(['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, $id) {
        $user = User::find($id);
        $roles = Role::all();

        if (!$request->roles || !$request->name || !$request->email) {
            $request->session()->flash('error', 'Rellena todos los campos.');
            return view('admin.users.edit')->with(['user' => $user, 'roles' => $roles]);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->roles()->sync($request->roles);

        if ($user->save()) {
            $request->session()->flash('success', 'Usuario actualizado correctamente.');
        } else {
            $request->session()->flash('error', 'No ha sido posible actualizar el usuario.');
        }

        return redirect()->route('admin.users.index');
    }

    public function create() {
        $roles = Role::all();
        return view('admin.users.create')->with(['roles' => $roles]);
    }

    public function store(Request $request) {
        $roles = Role::all();

        if (!$request->roles || !$request->name || !$request->email || !$request->password) {
            $request->session()->flash('error', 'Rellena todos los campos.');
            return view('admin.users.create')->with(['roles' => $roles]);
        }
        $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
        ]);

        $user->roles()->sync($request->roles);

        $request->session()->flash('success', 'Usuario creado correctamente.');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $user = User::find($id);
        if ($user->delete()) {

            $request->session()->flash('success', 'Usuario borrado correctamente.');
            return redirect()->route('admin.users.index');
        } else {
            $request->session()->flash('error', 'No ha sido posible borrar el usuario.');
        }



        return redirect()->route('admin.users.index');
    }

}
