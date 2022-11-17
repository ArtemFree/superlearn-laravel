<div>
    <h1>Отклик: {{ $project->name }}</h1>

    <p><strong>О проекте:</strong></p>
    <p>Создан: {{ date($project->created_at) }}</p>
    <p>Создал: {{ $project->user_id }}</p>
    <p>Вознаграждение: <strong>{{ $project->award }}</strong></p>
    <p>Коротко: {{ $project->short_about }}</p>
    <p>Подробнее: {{ $project->about }}</p>

    <form method="POST" action="/project/{{ $project->id }}/response">
        @csrf

        <div style="display: flex; flex-direction: column; width: 30%;">
            <textarea name="about_response" id="about_response" cols="30" rows="10"
                placeholder="Опишите, почему именно вы подходите на этот проект"></textarea>
            @error('about_response')
                {{ $message }}
            @enderror
            <button style="margin-top: 12px;">Откликнуться</button>
        </div>
    </form>
</div>
