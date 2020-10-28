<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Mockery\CountValidator\Exception;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $users = User::orderBy('id', 'desc')->whereHas('roles',function ($role){
             $role->where('id','>',Auth::user()->roles->first()->id);
         })->get();

         return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();

        $roles = Role::orderBy('name','asc')->where('id','>',Auth::user()->roles->first()->id)->get();

        return view('users.create', compact('user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                'photo' => 'mimes:jpeg,bmp,png|max:2048',
            ]);
            $image = $request->file('photo');

            if ($image) {
                $path = Storage::putFile('images/users',$image);
            }else{
                $path='';
            }

            $user =  User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'photo'=>$path
            ]);

           if ($user) {
                $user->assignRole($request->input('role'));

                return redirect()->route("users.index");
            } else {
                return redirect()->route("users.index");
            }
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->route("users.index");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return view('users.show', compact('user'));
        } else {
            return back()->with($this->not_found_message);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if ($user) {
            $roles = Role::orderBy('name','asc')->where('id','>',Auth::user()->roles->first()->id)->get();
            return view('users.edit', compact('user', 'roles'));
        } else {
           return redirect()->route('users.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
                'photo' => 'mimes:jpeg,bmp,png|max:2048',
            ]);
            $data=array();
            $user = User::find($id);
            if ($user) {
                $user->name = $request->name;
                $user->email = $request->email;
                if($request->password)
                    $user->password = Hash::make($request->input('password'));

                $image = $request->file('photo');
                if ($image) {
                    $path = Storage::putFile('images/users',$image);
                    if ($path) {
                        $data['photo'] = $path;
                        if (isset($user->photo)) {
                            Storage::delete($user->photo);
                        }
                    }
                }
                $user->update($data);
                $user->syncRoles($request->input('role'));
                return redirect()->route('users.index');
            } else {
                return redirect()->route('users.index');
            }
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->route('users.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            if (isset($user->photo)) {
                Storage::delete($user->photo);
            }
            $user->delete();
            return redirect()->route('users.index');
        } else {
            return redirect()->route('users.index');
        }
    }
}