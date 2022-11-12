@extends('common.page')

@section('content')
<h1>Проекты</h1>

@include('project.filters')

@if (count($projects) == 0)
    <p>Проектов не найдено</p>
@endif

@foreach ($projects as $project)
    <div>
        <h3>
            <a href="/project/{{ $project->id }}">{{ $project->name }}</a>
        </h3>
        <p>Коротко: {{ $project->short_about }}</p>
        <p>Вознаграждение: {{ $project->award }}</p>
        <p>Дата создания: {{ $project->created_at }}</p>
        @if ($project->is_completed)
            <p style="color: rgb(0, 72, 255);">Завершен</p>
        @endif
        @if ($project->is_archived_manually)
            <p style="color: red;">Архивирован пользователем</p>
        @endif
        <p></p>
    </div>
@endforeach
@endsection