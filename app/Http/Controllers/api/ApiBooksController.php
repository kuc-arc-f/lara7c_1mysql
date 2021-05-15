<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libs\AppConst;
use App\Libs\LibPagenate;

use App\Book;
//
class ApiBooksController extends Controller
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
//exit();
    $page = 1;
    $pageNo = $request->input("page"); 
    if(isset($pageNo)){
      $page = $pageNo;
    }    
    $LibPagenate = new LibPagenate();
    $LibPagenate->init();
    $pageInfo = $LibPagenate->get_page_start($page);
		$items = Book::orderBy('id', 'desc')
    ->skip($pageInfo["start"])->take($pageInfo["limit"])
    ->get();
    $param = $LibPagenate->get_page_items($items);
		return response()->json($param);
	}
  /**************************************
   *
   **************************************/  
  public function create(Request $request){
    $inputs = $request->all();
    $inputs["radio_2"] = 0;
    $book = new Book();
    $book->fill($inputs);
    $book->save();
    $request->session()->flash('flash_message_success', 'Sucsess, save item');
    return response()->json($inputs);
  }
  /**************************************
   *
   **************************************/  
  public function show(Request $request)
  {
    $ret = array();
    $id = $request->input("id"); 
    if(isset($id)){
      $ret = Book::find($id);
    }
//    $ret = ['id'=> $id ];
    return response()->json($ret );
  }	
  /**************************************
   *
   **************************************/
  public function update(Request $request){
    $inputs = $request->all();
    $book = Book::find(request('id'));
    $book->fill($inputs);
    $book->save();
    $request->session()->flash('flash_message_success', 'Sucsess, save item');
    return response()->json($inputs);
}
  /**************************************
   *
   **************************************/
  public function delete(Request $request){
      $book = Book::find(request('id'));
      $book->delete();
      $ret = ['id'=> request('id') ];
      $request->session()->flash('flash_message_success', 'Sucsess, delete item');
      return response()->json($ret);
  }	

}
