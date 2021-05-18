<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libs\LibPagenate;
use Illuminate\Support\Facades\Hash;
use App\User;
//
class ApiUsersController extends Controller
{
  /**************************************
   *
   **************************************/
  public function __construct(){
      $this->TBL_LIMIT = 500;
  }
  /**************************************
   *
   **************************************/  
  public function valid_login( $email, $password ,$request){
    $ret = false;
    $hashedPassword = '';
    $user = User::orderBy('id', 'desc')
    ->where('email', $email)->get()->toArray();
//var_dump(count($user));
    if(count($user) > 0){
      $userOne = $user[0];
      $hashedPassword = $userOne["password"];
      if (Hash::check($password , $hashedPassword)) {
        $userOne["password"] = "";
        $sessionKeyUser = env('SESSION_KEY_USER', '' );
        $request->session()->put($sessionKeyUser, $userOne);
        $ret = true;
      }        
    }
    return $ret;
  }
  /**************************************
   *
   **************************************/  
  public function login(Request $request){
    $retArr = array('ret' => 0, 'message'=>"" );

    $valid = $this->valid_login(
      request('email'), request('password') , $request
    );
    if($valid){
      $request->session()->flash('flash_message_success', 'Sucsess, Login OK');
      $retArr = array('ret' => 1, 'message'=>"" );
    }
    return response()->json($retArr);
  }  
  /**************************************
   *
   **************************************/  
  public function valid_add( $email ){
    $ret = true;
    $user = User::orderBy('id', 'desc')
    ->where('email', $email)->get()->toArray();
//var_dump(count($user));
    if(count($user) > 0){
      $ret = false;
    }
    return $ret;
  }
  /**************************************
   *
   **************************************/  
  public function add(Request $request){
    $retArr = array('ret' => 1, 'message'=>"" );
    $valid = $this->valid_add( request('email') );
    if($valid == false){
      $retArr = array('ret' => 0, 'message'=>"Error, validate", 'user'=>[] );
    }else{
      $password = request('password');
      $hashedPassword = Hash::make($password);
      $user = new User();
      $user->name   = request('name');
      $user->password   = $hashedPassword;
      $user->email   = request('email');    
      $user->save();
      $request->session()->flash('flash_message_success', 'Sucsess, save item');
    }
    /*
    $ret = [
      'name' => request('name'), 'email' => request('email'),
    ];
    */
    return response()->json($retArr);
  }
  /**************************************
   *
   **************************************/
  public function delete(Request $request){
    /*
      $task = Task::find(request('id'));
      $task->delete();
      $ret = ['id'=> request('id') ];
      $request->session()->flash('flash_message_success', 'Sucsess, delete item');
      return response()->json($ret);
    */
  }
  /**************************************
   *
   **************************************/
  public function test()
  {   
    $user = User::orderBy('id', 'desc')
    ->where('email', 'a4@example.com')->get()->toArray();
    if(count($user) > 0){
      $userOne = $user[0];
      $hashedPassword = $userOne["password"];
var_dump($userOne["id"]);
    }
//var_dump($hashedPassword);
    if (Hash::check('password', $hashedPassword)) {
      var_dump("パスワード一致");
    }else{
      var_dump("NG-パスワード");
    }    
exit();
  }
}
