@extends('layouts.application')

@section('content')
  <h1>{{ link_to("/tasks", "All tasks:") }}</h1>
  
  <ul class="list-group">
    @foreach($tasks as $task)
      <li class='list-group-item'>
        <a href="/{{$task->user->username}}/tasks"><img src="{{gravatar_url($task->user->email)}}" alt="{{$task->user->email}}"></a>
        {{ link_to_route("user.tasks.show", $task->title, [$task->user->username, $task->id]) }}
      </li>
    @endforeach
  </ul>

<hr>

@if(!empty($users))
  <h3>Add new task:</h3>
  @include('tasks.partials._form')
@endif

@stop