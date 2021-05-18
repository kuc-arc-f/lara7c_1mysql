<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Log;
//
class BooksController extends Controller
{
  public function __construct(){
//      $this->middleware('auth');
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
    $books = Book::orderBy('updated_at', 'desc')->paginate(5);
    return view('books/index')->with([
        'books', $books , 'page' => $page,
    ]);
  }    
  /**************************************
   *
   **************************************/
  public function create()
  {
    if($this->auth_check('normal_user')== NULL){ return redirect('/login'); }
    return view('books/create')->with('book', new Book());
  }    
  /**************************************
   *
   **************************************/    
  public function store(Request $request)
{
    $inputs = $request->all();
//        $inputs["radio_1"] = 0;
    $inputs["radio_2"] = 0;
//debug_dump($inputs );
//exit();
    $book = new Book();
    $book->fill($inputs);
    $book->save();
    return redirect()->route('books.index');
  }
  /**************************************
   *
   **************************************/
  public function show($id)
  {
    return view('books/show')->with('book_id', $id );
  }    
  /**************************************
   *
   **************************************/
  public function edit($id)
  {
//        $book = Book::find($id);
//debug_dump($book );
//exit();
    if($this->auth_check('normal_user')== NULL){ return redirect('/login'); }
    return view('books/edit')->with('book_id', $id);
  }    
  /**************************************
   *
   **************************************/    
  public function update(Request $request, $id)
  {
      $inputs = $request->all();
      if(empty($inputs["check_1"] )){
          $inputs["check_1"] = 0;
      }
      if(empty($inputs["check_2"] )){
          $inputs["check_2"] = 0;
      }
//debug_dump($inputs );
//exit();
      $book = Book::find($id);
      $book->fill($inputs );
      $book->save();
      return redirect()->route('books.index');
  }
  /**************************************
   *
   **************************************/
  public function destroy($id)
  {
      $book = Book::find($id);
      $book->delete();
      return redirect()->route('books.index');
  }    
  /**************************************
   * csrf, test
   **************************************/
  public function test1(Request $request ){
// var_dump("#test1");
//exit();
      return view('books/test1')->with('book', null );
  }
  /**************************************
   *
   **************************************/    
  public function test2(Request $request )
  {
      $inputs = $request->all();
debug_dump($inputs );
exit();

  }    
  /**************************************
   * Blade, test
   **************************************/
  public function test3(){
//        \Log::info("ログ出力テスト");
//        \Log::debug("ログ出力テスト");
//        logger(print_r($array, true));
//var_dump("#test1");
      $book = Book::find(1);
dd($book->toArray() );
//dd("#test1");
exit();
      return view('books/test3')->with('book', null );
  }
      
}
