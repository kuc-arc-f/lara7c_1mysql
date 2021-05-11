
@extends('layouts.app_react')

@section('title', '新規作成')

@section('content')
  <div class="panel panel-default">
      <br />
      <div class="panel-heading">
          <br />
          <br />
          <!-- class="mt-10" -->
          <h3 >新規作成</h3>
      </div>
      <hr />
  @if (count($errors) > 0)
    <div class="alert alert-danger">
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
    </div>
  @endif
      <div class="panel-body">
          <form action="/tasks" method="POST">
              @method('POST')
              @csrf
              <div class="form-group">
                  <label for="title" class="col-sm-3 control-label">title</label>
                  <div class="col-sm-6">
                      <input id="task-title" class="form-control" required="required" name="title" type="text">
                  </div>
              </div>
              <div class="form-group">
                  <label for="content" class="col-sm-3 control-label">content</label>
                  <div class="col-sm-6">
                      <input id="task-content" class="form-control" name="content" type="text">
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-6">
                      <input class="btn btn-primary" type="submit" value="保存">
                  </div>
              </div>
          </form>
      </div>
      <hr />
      <br />
      <div class="panel-footer">
      </div>
  </div>
@endsection
