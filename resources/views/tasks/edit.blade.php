@extends('layouts.app_react')

@section('title', "")

@section('content')

<div class="panel panel-default">
    <br />
    <div class="panel-heading">
       <br />
       <br />
       <h3>編集</h3>
    </div>
    <hr />
    <div class="panel-body">
        <form action="/tasks/{{$task_id}}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">title</label>
            <div class="col-sm-6">
                <input id="task-title" class="form-control" required="required" name="title" type="text" 
                value="{{$task["title"] }}" />
        </div>
        <div class="form-group">
            <label for="content" class="col-sm-3 control-label">content</label>
            <div class="col-sm-6">
                <input id="task-content" class="form-control" name="content" type="text" 
                value="{{$task["content"] }}" />
            </div>
        </div>
        <hr />       
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <input class="btn btn-primary" type="submit" value="保存">
            </div>
        </div>
        </form>
        <hr />
        <!-- delete -->
        <div class="form-group">
            <div class="col-sm-6">
                <form action="/tasks/{{$task_id}}" method="POST">
                    @method('DELETE')
                    @csrf  
                    <input class="btn btn-outline-danger btn-sm" type="submit" value="Delete">                  
                </form>

            </div>
        </div>         
    </div>
    <hr />
    <br />
    <div class="panel-footer">
    </div>
</div>

@endsection
