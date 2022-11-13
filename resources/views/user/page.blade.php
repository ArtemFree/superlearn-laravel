@extends('common.page')

@section('content')
<div>
    <h1>Пользователь {{ $user->name . ' ' . $user->last_name }}</h1>
    @if ($user->is_banned)
        <p style="color: red">Пользователь заблокирован</p>
    @endif
    <div>
        <p>Статус: {{ $user->status }}</p>
        <p>О себе: {{ $user->about }}</p>
        <p>Возраст: {{ $user->age }}</p>
    </div>
</div>
@endsection