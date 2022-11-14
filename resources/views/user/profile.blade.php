@extends('common.page')

@section('content')
    <div>
        <div>
            <h1>Мой профиль</h1>
            <p>
                @if ($user->role->id == 1)
                    <a href="/project/create">Создать проект</a>
                @endif
                <a href="/profile/edit">Редактировать профиль</a>
            </p>
        </div>
        <p>Роль: {{ $user->role->name }}</p>
        <p>Обо мне: {{ $user->about }}</p>
        <p>Статус: {{ $user->status }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>Дата создания аккаунта: {{ $user->created_at }}</p>
    </div>
@endsection
