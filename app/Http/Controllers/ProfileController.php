<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Mockery\CountValidator\Exception;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    public function edit($id)
    {
        $user = User::find($id);
        if ($user) {
            return view('profile.index', compact('user', 'roles'));
        } else {
            return redirect()->route('profile.index');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'photo' => 'mimes:jpeg,bmp,png|max:2048',
            ]);
            $data=array();
            $user = User::find($id);

            if ($user) {
                $user->name = $request->name;
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
                //dd($data);
                $user->update($data);
                return redirect()->back();
            } else {
                return redirect()->back();
            }
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return redirect()->back();
        }
    }



    public function changePasswordForm()
    {
        $user = Auth::user();
        return view('profile.change-password', compact('user'));
    }


    public function updatePassword(Request $request)
    {
        try {
            try {
                $request->validate([
                    /* 'name' => ['required', 'string', 'max:255'],
                     'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.auth()->user()->id],*/
                    'password' => ['required', 'string', 'min:6', 'confirmed'],
                    'old_password' => ['required'],
                ]);

            } catch (\Illuminate\Validation\ValidationException $e) {
                return redirect()->back()->withErrors($e->errors());
            }
            if (Hash::check($request->old_password, Auth::user()->password)) {
                $user = Auth::user();

                if ($user) {
                    if ($request->password)
                        $user->password = Hash::make($request->input('password'));
                    $user->save();

                    return redirect('update-password')->with($this->create_success_message);
                } else {
                    return back()->withErrors('Unauthenticated');
                }
            } else {

                return redirect()->back()->withErrors('Password does not match');
            }

        } catch (\Exception $ex) {
            Log::error($ex->getMessage());
            return back();
        }
    }
}
