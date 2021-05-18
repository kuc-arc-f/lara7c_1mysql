<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Tag;
use App\Libs\LibPagenate;
//
class TagsController extends Controller
{
  /**************************************
   *
   **************************************/
  public function __construct(){
  }
  /**************************************
   *
   **************************************/
  public function index()
  {
    if($this->auth_check('normal_user')== NULL){ return redirect('/login'); }
    $items = Tag::orderBy('id', 'desc')->get();
//var_dump($items); ->toArray()
    return view('tags/index')->with('items', $items
    );
  }  


}
