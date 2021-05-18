@extends('layouts.app_layout')
@section('title', '')
@section('content')
<div class="container" style="margin-top: 16px;">
  <div class="row">
    <div class="col-sm-6"><h3>CmsPost - test </h3>
    </div>
    <div class="col-sm-6" style="text-align: right;">
    </div>
  </div>
  <hr />
  <form action="/cms_posts" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="col-sm-8">title<br />
      <input type="text" name="title" className="form-control"
      />
    </div>
    <div class="col-sm-8">
      <input type="file" value="Select File" name="attach_file"
      class="btn btn-outline-primary" />      
    </div>
    <hr />
    <button>Save</button>
  </form>  



</div>


@endsection
