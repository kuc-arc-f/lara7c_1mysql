<?php
/*
https://readouble.com/laravel/7.x/ja/authentication.html
https://readouble.com/laravel/7.x/ja/hashing.html
https://readouble.com/laravel/7.x/ja/session.html
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\AdminUser;

class TestAuthController extends Controller
{
    //
  /**************************************
   *
   **************************************/
  public function __construct(){
//    $this->middleware('auth');
  }
  /**************************************
   *
   **************************************/
  public function index()
  {
  //var_dump("#index");
  //exit();
    return view('test_auth/index')->with('tasks', [] );
  }
  /**************************************
   *
   **************************************/
  public function test1()
  {
var_dump("#test1");
    $hashedPassword = Hash::make("pass123");
//var_dump($hashedPassword);
    $user = new AdminUser();
    $user->name   = 'n2';
    $user->password   = $hashedPassword;
    $user->email   = "a4@example.com";
//    $user->save();
    $user = AdminUser::orderBy('id', 'desc')
    ->where('name', 'n2')->get()->toArray();
//var_dump(count($user));
    if(count($user) > 0){
      $userOne = $user[0];
      $hashedPassword = $userOne["password"];
    }
//var_dump($userOne["password"]);
    if (Hash::check('pass123', $hashedPassword)) {
      var_dump("パスワード一致");
    }else{
      var_dump("NG-パスワード");
    }
exit();
  }
  /**************************************
   *
   **************************************/
  public function test_session(Request $request){
    $request->session()->put('key', 'value3');
    $value = $request->session()->get('key');
// var_dump($value );
    $data = $request->session()->all();
    var_dump($value );
    $request->session()->flash('flash_message_success', 'Task was successful-2');
//    $request->session()->flash('flash_message_error', 'Error, save');
    return redirect('/test_auth/test_flash');
  } 
  /**************************************
   *
   **************************************/
  public function test_flash(Request $request){
    /*
    $value = $request->session()->get('status');
    $request->session()->forget('status');
var_dump($value );
    */
    $data = $request->session()->all();
//var_dump($data["normal_user"] );
var_dump($data);
//exit();
    return view('test_auth/index')->with('tasks', [] );
  }           
}
