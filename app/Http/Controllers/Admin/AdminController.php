<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use App\Models\Admin\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function adminLogin()
    {
        if(Auth::guard('admin')->check()){
            return redirect()->route('admin.dashboard');
        }
        return view('admin.admin.login');
    }
    public function adminLoginCheck(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->route('admin.dashboard');
        } else {
            return back()->withErrors('Your Email or Password is wrong|');
        }
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }
    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('index');
    }

    /* User List */
    public function userList()
    {
        return view('backend.user.user_list');
    }
    public function getUserList(Request $request)
    {
        if (!$request->ajax()) {
            return 'Sorry! this is a request without proper way.';
        }
        try {
            $list = User::orderBy('id', 'desc')->get();
            return DataTables::of($list)
                ->editColumn('status', function ($list) {
                    return CommonFunction::getStatus($list->status);
                })
                ->editColumn('name', function ($list) {
                    return $list->first_name . ' ' . $list->last_name;
                })
                ->editColumn('address', function ($list) {
                    return $list->address . ', ' . $list->city . ', ' . $list->country;
                })
                ->addColumn('action', function ($list) {
                    if($list->status == 1) {
                        return '<a style="padding:2px;font-size:15px;" href="' . route('inactive.user', ['id' => $list->id]) . '" class="btn btn-sm btn-success btn-xs pl-1 pr-1"> Active </a>';
                    } else {
                        return '<a style="padding:2px;font-size:15px;" href="' . route('active.user', ['id' => $list->id]) . '" class="btn btn-danger btn-xs pl-1 pr-1"> Inactive </a>';
                    }
                })
                ->addIndexColumn()
                ->rawColumns(['status', 'name', 'address', 'action'])
                ->make(true);
        } catch (\Exception $e) {
            return Redirect::back();
        }
    }
    public function activeUser($id){
        $user = User::find($id);
        $user->status = 1;
        $user->save();
        return back()->with('message', 'User Active Successfully')->withSuccess('User Active Successfully');
    }
    public function inactiveUser($id){
        $user = User::find($id);
        $user->status = 0;
        $user->save();
        return back()->with('message', 'User Inactive Successfully')->withSuccess('User Inactive Successfully');
    }
}
