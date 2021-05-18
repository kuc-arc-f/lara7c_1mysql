<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CmsPostsController extends Controller
{
  /**************************************
   *
   **************************************/
  public function index()
  {
//exit();
/*
    $page = 1;
    if(isset($_GET['page'])){
      $page = $_GET['page'];
    }
    $tasks = Task::orderBy('id', 'desc')->paginate(10 );
*/
    $items = [];
    return view('cms_posts/index')->with([
      'items', $items , 'page' => 1,
    ]);
  }    
  /**************************************
   *
   **************************************/
  public function create()
  {
    return view('cms_posts/create')->with('task',  null);
  }
  /**************************************
   *
   **************************************/
	public function store(Request $request)
	{
		$data = $request->all();
    $ret = $this->upload_file($request, 22);
//var_dump($data );
    //return redirect()->route('/cms_posts');
    $arr = array( "title"=> $data["title"] );
    return response()->json($arr);
    exit();
  }
	/**************************************
	 *
     **************************************/
    private function upload_file(Request $request, $message_id ){
      $ret = true;
//      $datetime = strtotime(date('YmdHis'));
      $datetime = (String)strtotime("now");
      $temporary_file = $request->file('attach_file')->store('cms_files_tmp');
      $origiinal_name = $request->file('attach_file')->getClientOriginalName();
  //var_dump( "temporary_file=". $temporary_file );
      $filename = $datetime . "_" . $message_id."_" . $origiinal_name;
 //     $filename = $message_id."_" . $origiinal_name;
      $storage_path = storage_path('app/') . $temporary_file;
      Storage::copy($temporary_file , 'cms_files/' . $filename );
      //delete
      Storage::delete($temporary_file );
      // fname-save
      /*
      $message_file = new MessageFile();
      $message_file["message_id"]= $message_id;
      $message_file["name"]= $filename;
      $message_file->save();
      */
      return $ret;
    }  
  /**************************************
   *
   **************************************/
  public function test()
  {
    $d = strtotime("now");
// var_dump( (String)$d );
    return view('cms_posts/test')->with('task',  null);
  }
}
