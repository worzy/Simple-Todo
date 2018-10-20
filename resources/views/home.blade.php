@extends('layouts.app')

@section('title', 'My Todos')

@section('content')
<div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-8">
            <h1>Todos</h1>
        </div>
    </div>
</div>
<div id="todoapp">
  <Todo></Todo>
</div>


@endsection