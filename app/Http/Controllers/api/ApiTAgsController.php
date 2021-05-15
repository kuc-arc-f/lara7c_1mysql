<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libs\LibPagenate;
use App\Tag;
//
class ApiTAgsController extends Controller
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
    $items = Tag::orderBy('id', 'asc')
    ->get();
    return response()->json($items);
  }

}
