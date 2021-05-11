<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestAuthController extends Controller
{
    //
  /**************************************
   *
   **************************************/
  public function __construct(){
    $this->middleware('auth');
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
}
