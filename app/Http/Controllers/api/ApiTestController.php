<?php
namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Task;
//
class ApiTestController extends Controller
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
  public function index()
  {   
//exit();
    $todos = Task::orderBy('id', 'desc')
    ->limit($this->TBL_LIMIT)
    ->get();
    return response()->json($todos);
  }
  /**************************************
   *
   **************************************/
  public function test1()
  {   
var_dump("test");
exit();
//    return response()->json($todos);
  }  
  /**************************************
   *
   **************************************/  
  public function create_task(Request $request){
      $task = new Task();
      $task->title   = request('title');
      $task->content = request('content');
      $task->save();
      $ret = ['title' => request('title'),'content' => request('content')];
      return response()->json($ret);
  }
  /**************************************
   *
   **************************************/
  public function get_item(Request $request)
  {
      $task = Task::find(request('id'));
      $ret = ['id'=> request('id') ];
      return response()->json($task );
  }
  /**************************************
   *
   **************************************/
  public function update_post(Request $request){
      $task = Task::find(request('id'));
      $task->title   = request('title');
      $task->content = request('content');
      $task->save();
      $ret = ['id'=> request('id') , 'title' => request('title'),
              'content' => request('content')];
      return response()->json($ret);
  }
  /**************************************
   *
   **************************************/
  public function delete_task(Request $request){
      $task = Task::find(request('id'));
      $task->delete();
      $ret = ['id'=> request('id') ];
      return response()->json($ret);
  }
  /**************************************
   *
   **************************************/
  public function test_tasks()
  {   
//exit();
      $todos = Task::orderBy('id', 'desc')
      ->limit($this->TBL_LIMIT)
      ->get();
      return response()->json($todos);
  }
}
