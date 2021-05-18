<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
//
class UsersController extends Controller
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
    return view('users/login')->with('user',  null);
  }   
  /**************************************
   *
   **************************************/
  public function logout(Request $request)
  {
    $key = env('SESSION_KEY_USER', '' );
    $request->session()->forget($key);
    return redirect('/login');
  }   
  /**************************************
   *
   **************************************/
  public function add(Request $request)
  {
    $users = User::orderBy('id', 'desc')
    ->get()->toArray();
    $num = count($users);
//var_dump(count($users));
    if($num >= 2){
      $request->session()->flash(
        'flash_message_error', 'Error, max user over'
      );
      return redirect('/home');
    }else{
      return view('users/add')->with('user',  null);
    }

//    exit();
  }   

}
