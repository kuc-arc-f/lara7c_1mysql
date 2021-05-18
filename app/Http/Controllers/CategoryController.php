<?php
//タスク

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Libs\LibPagenate;
//
class CategoryController extends Controller
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
    $page = 1;
    if(isset($_GET['page'])){
      $page = $_GET['page'];
    }
    $items = Category::orderBy('id', 'desc')->get();
//var_dump($items); ->toArray()
    return view('category/index')->with('items', $items
    );
  }  


}
