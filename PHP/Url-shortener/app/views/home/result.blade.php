@extends('layouts.application')

@section('content')
  <h1>Here is your short url:</h1>
  {{link_to($shortened, $shortened)}}
@stop