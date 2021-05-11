<?php
//タスク

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Task;
//use App\Libs\LibPagenate;
//
class TasksController extends Controller
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
//var_dump("#index");
//exit();
    $tasks = Task::orderBy('id', 'desc')->paginate(10 );
    return view('tasks/index')->with('tasks', $tasks);
  }    
  /**************************************
   *
   **************************************/
  public function create()
  {
    return view('tasks/create')->with('task',  null);
  }
  /**************************************
   * 入力値の検証
   **************************************/    
  private function validator(array $data)
  {
    return Validator::make($data, [
        'title' => ['required', 'string', 'max:255'],
    ]);
  }       
  /**************************************
   *
   **************************************/    
  public function store(Request $request)
  {
    $data = $request->all();
    $inputs = $request->all();
    //validation
    $validation = $this->validator($inputs);
    if($validation->fails())
    {
// debug_dump($validation->errors());
      return redirect()->back()->withErrors($validation->errors())->withInput();
    }
    $task = new Task();
    $task->fill($inputs);
    $task->save();
    return redirect()->route('tasks.index');      
//exit();
  }  
  /**************************************
   *
   **************************************/
  public function show($id)
  {
    return view('tasks/show')->with('task_id', $id );
  }   
  /**************************************
   *
   **************************************/
  public function edit($id)
  {
    $task = Task::find($id);
    return view('tasks/edit')->with([
      'task'=>$task, 'task_id'=>$id
    ]);
  }
  /**************************************
   *
   **************************************/
  public function update(Request $request, $id)
  {
    $task = Task::find($id);
    $task->fill($request->all());
    $task->save();
    return redirect()->route('tasks.index');    
  }
  /**************************************
   *
   **************************************/
  public function destroy($id)
  {
// var_dump( $id );
    $task = Task::find($id);
    $task->delete();
    return redirect()->route('tasks.index');
  }      
  /**************************************
   *
   **************************************/
  public function test1(){
//var_dump("#test1");
      $LibPagenate = new LibPagenate();
      $LibPagenate->init();
      $ret = $LibPagenate->get_page_start(1);
print_r($ret);
      exit();
      /*
      print_r($result );
      print_r($result["_id"] );
      print_r($result["title"] );        
      */
  }

}
