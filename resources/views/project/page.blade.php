@extends('common.page')

@section('content')
    <div>
        <h1>Проект {{ $project->name }}</h1>
        @if (Auth::user()->id == $project->user_id)
            <p>Проект создан вами</p>
        @endif
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
        <p>Создал: {{ $project->user_id }}</p>
        <p>Вознаграждение: <strong>{{ $project->award }}</strong></p>
        <p>Коротко: {{ $project->short_about }}</p>
        <p>Подробнее: {{ $project->about }}</p>

        @can('update', $project)
            <a href="/project/{{ $project->id }}/edit">Изменить</a>
        @endcan
        @can('delete', $project)
            <a href="/project/{{ $project->id }}/delete" style="color: red;">Удалить</a>
        @endcan

        @if (Auth::user()->role->name == 'author' && !$response && !$project->author_id)
            <a href="/project/{{ $project->id }}/response/create">Откликнуться</a>
        @endif

        @if (Auth::user()->role->name == 'author' && $response && !$project->author_id)
            <div>Вы откликнулись на этот проект</div>
            <a href="/project/{{ $project->id }}/response">Страница отклика</a>
        @endif

        @if (Auth::user()->role->name == 'author' && Auth::user()->author->id == $project->author_id)
            <div>Вы выбраны в качестве исполнителя</div>
        @endif

        @if ($project->user_id == Auth::id())
            <ul>
                @foreach ($project->responses as $response)
                    <li>
                        <a href="/project/{{ $project->id }}/response/{{ $response->id }}">
                            <h3>Заявка от пользователя: {{ $response->author->user->name }}</h3>
                        </a>
                        <p>Сообщение: {{ $response->messages[0]->text }}</p>
                        <p>Дата: {{ $response->created_at }}</p>
                    </li>
                @endforeach
            </ul>
        @endif

    </div>
@endsection
