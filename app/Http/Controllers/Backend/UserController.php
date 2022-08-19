<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function UserView(){

        $users = User::all();

        return view('backend.user.view_user', compact('users'));
    }

    public function UserAdd(){

        return view('backend.user.add_users');
    }

    public function UserStore(Request $request){

        $validatedData = $request->validate([
            'email'=> 'required|unique:users',
            'name'=> 'required',

        ]);

        $user = new User;
        $user->usertype = $request->usertype;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $notification = array(
            'message' => 'User Inserted Successfully',
            'alert-type'=> "success"
        );

        return redirect()->route('user.view')->with($notification);

    }

    public function UserEdit($id){

        $user = User::find($id);

        return view('backend.user.edit_user', compact('user'));

    }

    public function UserUpdate(Request $request, $id){



        $user = User::find($id);
        $user->usertype = $request->usertype;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $notification = array(
            'message' => 'User Updated Successfully',
            'alert-type'=> "info"
        );

        return redirect()->route('user.view')->with($notification);

    }

    public function UserDelete($id){

        User::find($id)->delete();

        $notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type'=> "info"
        );

        return redirect()->route('user.view')->with($notification);
    }



}
