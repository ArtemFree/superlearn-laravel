@extends('common.page')


@section('content')
<h1>Авторы</h1>

@foreach ($authors as $author)
@include('author.list-item')
@endforeach
@endsection