@extends('common.page')

@php
    $is_author = $user->is_author;
@endphp

@section('content')
    <div>
        <div>
            <h1>Мой профиль</h1>
            <p>
                @if (!$is_author)
                    <a href="/project/create">Создать проект</a>
                @endif
                <a href="/profile/edit">Редактировать профиль</a>
            </p>
        </div>
        <p>Роль: {{ $is_author ? 'Автор' : 'Пользователь' }}</p>
        <p>Обо мне: {{ $user->about }}</p>
        <p>Статус: {{ $user->status }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>Дата создания аккаунта: {{ $user->created_at }}</p>
    </div>

    @if ($is_author)
        <div>
            <h2>Проекты</h2>
        </div>
    @endif
@endsection
