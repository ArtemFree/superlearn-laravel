@extends('common.page')

@section('content')
<div>
    <h1>Автор {{ $author->firstName . ' ' . $author->lastName }}</h1>
    @if ($author->is_banned)
        <p style="color: red">Автор заблокирован</p>
    @endif
    <div>
        <p>Статус: {{ $author->status }}</p>
        <p>О себе: {{ $author->about }}</p>
        <p>Возраст: {{ $author->age }}</p>
    </div>
</div>
@endsection