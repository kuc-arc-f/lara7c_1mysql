@extends('layouts.app_layout')
@section('title', '')

@section('content')

<div class="container" style="margin-top: 16px;">
  <div class="row">
    <div class="col-sm-6"><h3>Category</h3>
    </div>
    <div class="col-sm-6" style="text-align: right;">
    </div>
  </div>
  <table class="table table-striped task-table">
  <thead>
    <th>ID</th>
    <th>Name</th>
  </thead>    
  <tbody>
  @foreach ($items as $item )
    <tr>
      <td class="table-text"><?= $item->id ?>
      </td>
      <td class="table-text"><?= $item->name ?>
      </td>
    </tr>
  @endforeach
  </tbody>
  </table>
<!-- -->  
  <div id="app"></div>    
</div>


@endsection


