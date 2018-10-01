<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin_login');
    }

    public function error()
    {
        return view('admin.error');
    }

    public function showDashboard()
    {
        return view('admin.dashboard');
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = md5($request->password);
        $result = DB::table('admins')
            ->where('email', '=', $email)
            ->where('password', '=', $password)
            ->first();
        if ($result) {
            Session::put('admin_name', $result->name);
            Session::put('admin_id', $result->id);
            Session::put('access_level', $result->access_level);
            return redirect(route('dashboard'));

        } else {
            return redirect()->back()->with([
                'message' => 'Invalid Username or Password',
                'status' => 'danger'
            ]);
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect(route('admin'));
    }

    public function add_admin()
    {
        return view('admin.add_admin');
    }

    public function save_admin(Request $request)
    {
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->access_level = $request->access_level;
        $admin->password = md5($request->password);
        if (!$admin->validate()) {
            Session::put('errors', $admin->errors);
            return redirect(route('add_admin'));
        } else {
            $admin->save();
            Session::put('message', 'New Admin Saved');
            return redirect(route('add_admin'));
        }
    }

    public function all_admin()
    {
        $admins = Admin::paginate(8);
        return view('admin.all_admins', ['admins' => $admins]);
    }

    public function delete_admin($id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        Session::put('message', 'Admin Deleted Successfully');
        return redirect(route('all_admin'));
    }

    public function edit_admin($id)
    {
        $admin = Admin::find($id);
        return view('admin.edit_admin', ['admin' => $admin]);
    }

    public function update_admin(Request $request, $id)
    {
        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->phone = $request->phone;
        $admin->access_level = $request->access_level;
        $admin->save();
        Session::put('message', 'Admin Updated Successfully');
        return redirect(route('all_admin'));
    }

    public function edit_password($id)
    {
        $admin = Admin::find($id);
        return view('admin.edit_password', ['admin' => $admin]);
    }

    public function update_password(Request $request, $id)
    {
        $admin = Admin::find($id);
        $admin->password = md5($request->password);
        $admin->save();
        Session::put('message', 'Password Changed');
        return redirect(route('all_admin'));
    }
}