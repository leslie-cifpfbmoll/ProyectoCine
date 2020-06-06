<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Image;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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
            return redirect()->route('admin.administrar.getUsuarios');
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

        return redirect()->route('admin.administrar.getUsuarios');
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
        return redirect()->route('admin.administrar.getUsuarios');
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



        return redirect()->route('admin.administrar.getUsuarios');
    }
    public function update_avatar(Request $request){
        $user = Auth::user();
         $reservas = DB::select(DB::raw("select DISTINCT r.id, r.cantidad, p.nombre, h.hora, c.fecha, s.id as sala FROM reserva r, reservas_user ru, carteleras_reservas cr, cartelera c, peliculas p, carteleras_peliculas cp, carteleras_horarios ch, horarios h, carteleras_salas cs, sala s WHERE ru.user_id LIKE :user_id AND r.id LIKE ru.reservas_id AND r.id LIKE cr.reservas_id AND c.id LIKE cr.carteleras_id AND cp.carteleras_id LIKE c.id AND p.id LIKE cp.peliculas_id AND c.id LIKE ch.carteleras_id AND ch.horarios_id LIKE h.id AND cs.carteleras_id LIKE c.id AND cs.salas_id LIKE s.id"), array('user_id' => $user->id));
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename= time() . '.' . $avatar->getClientOriginalName();
            Image::make($avatar)->resize(300,300)->save( public_path('http://localhost/ProyectoCine/public/uploads/avatars/' . $filename));
            //Image::make($avatar)->resize(300,300)->save(public_path('uploads/avatars/' . $filename));
            $user->avatar = $filename;
            $user->save();
        }
         return view('admin.perfil.index')->with('user', $user)->with('reservas', $reservas);
        
    }

}
