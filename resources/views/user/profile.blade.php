@extends('common.page')

@section('content')
    <div>
        <div>
            <h1>Мой профиль</h1>
            <p>
                @if ($user->role->name == 'user' || $user->role->name == 'admin')
                    <a href="/project/create">Создать проект</a>
                @endif
                <a href="/profile/edit">Редактировать профиль</a>
            </p>
        </div>
        <p>Имя: {{ $user->name }}</p>
        <p>Роль: {{ $user->role->name }}</p>
        <p>Обо мне: {{ $user->about }}</p>
        <p>Статус: {{ $user->status }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>Дата создания аккаунта: {{ $user->created_at }}</p>
    </div>
    <p>
        <div style="display: grid; grid-template-columns: 1fr 1fr;">
            <div>
                <h2>Мои {{$user->role->name == 'user' ? 'созданные' : 'рабочие'}} проекты</h2>
                @include('user.projects', ['user' => $user])
            </div>
            @if ($user->author)
                <div>
                    <h2>Мои заявки</h2>
                    @include('user.responses', ['user' => $user])
                </div>
            @endif
        </div>
    </p>
@endsection
