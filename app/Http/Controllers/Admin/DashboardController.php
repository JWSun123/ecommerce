<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function users(){
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function viewUser($id){
        $user = User::find($id);
        return view('admin.users.view',compact('user'));
    }

    public function updateRole(Request $request, $id){
        $user = User::find($id);
        $user->role_as = $request->input('role_as');
        $user->save();
        return redirect('users')->with('status', "Role Updated Successfully!");
    }
}
