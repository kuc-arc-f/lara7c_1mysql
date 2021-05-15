<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libs\LibPagenate;
use App\Category;
//
class ApiCategoryController extends Controller
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
  public function list(Request $request)
  {   
//var_dump($pageInfo);
    $items = Category::orderBy('id', 'asc')
    ->get();
    return response()->json($items);
  }

}
