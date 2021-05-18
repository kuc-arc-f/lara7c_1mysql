<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdminUser;

class AdminUsersController extends Controller
{
  /**************************************
   *
   **************************************/
  public function __construct(){
  }    
  /**************************************
   *
   **************************************/
  public function login()
  {
    return view('admin/users/login')->with('user',  null);
  }   
  /**************************************
   *
   **************************************/
  public function logout(Request $request)
  {
    $key = env('SESSION_KEY_ADMIN_USER', '' );
    $request->session()->forget($key);
    return redirect('admin/login');
  }   
  /**************************************
   *
   **************************************/
  public function add(Request $request)
  {
    $users = AdminUser::orderBy('id', 'desc')
    ->get()->toArray();
    $num = count($users);
//var_dump(count($users));
    if($num >= 1){
      $request->session()->flash(
        'flash_message_error', 'Error, max user over'
      );
      return redirect('/admin');
    }else{
      return view('admin/users/add')->with('user',  null);
    }
  //    exit();
  }
      
}
