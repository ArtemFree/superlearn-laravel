@extends('common.page')

@section('content')
    <div>
        <h1>Проект {{ $project->name }}</h1>
        @if ($project->is_archived_manually && !$project->is_completed)
            <p style="color: red;">Архивирован пользователем</p>
        @endif
        @if ($project->is_completed)
            <p style="color: rgb(0, 72, 255);">Завершен</p>
        @endif
        @if ($project->is_in_work && !$project->is_completed && !$project->is_archived_manually)
            <p style="color: rgb(0, 72, 255);">В работе</p>
        @endif
        <p>Создан: {{ date($project->created_at) }}</p>
        <p>Вознаграждение: <strong>{{ $project->award }}</strong></p>
        <p>Коротко: {{ $project->short_about }}</p>
        <p>Подробнее: {{ $project->about }}</p>
        <a href="/project/{{ $project->id }}/edit">Изменить</a>
        <a href="/project/{{ $project->id }}/delete" style="color: red;">Удалить</a>
    </div>
@endsection
