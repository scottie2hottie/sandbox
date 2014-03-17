@extends('layouts.application')

@section('content')
  <h1>My awesome url shortener</h1>

  {{Form::open(array('url'=>'/'))}}
    {{Form::text('url')}}
  {{Form::close()}}

  {{$errors->first('url', '<p class="message">:message</p>')}}
@stop