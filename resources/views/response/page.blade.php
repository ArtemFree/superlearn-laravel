<div>
    <a href="/project/{{$response->project->id}}">Назад</a>
    <h1>Отлик: {{ $response->project->name }}</h1>
    <p>Создан: {{ date($response->project->created_at) }}</p>
    <p>Создал: {{ $response->project->user_id }}</p>
    <p>Вознаграждение: <strong>{{ $response->project->award }}</strong></p>
    <p>Коротко: {{ $response->project->short_about }}</p>
    <p>Подробнее: {{ $response->project->about }}</p>

    <div style="display: grid; grid-template-columns: 1fr 1fr; width: 50%; column-gap: 10px;">
        <div>
            <h2>Сообщения</h2>
            <ul style="display: flex; flex-direction: column; list-style: none; padding: 0; margin: 0">
                @foreach ($response->messages as $message)
                    <li
                        style="{{ $message->user_id == $user->id ? 'align-self: end;' : '' }} margin-top: 8px; border-radius: 6px; max-width: 70%; background-color: #f6f6f6; padding: 12px 12px; display: flex; flex-direction: column;">
                        <div>{{ $message->user_id == $user->id ? 'Вы' : $message->user->name }}</div>
                        <div>{{ $message->text }}</div>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- make it broadcast --}}
        <form style="margin-top: 64px; display: flex; flex-direction: column; width: 50%">
            <textarea name="" id="" cols="30" rows="10" placeholder="Введите сообщение..."></textarea>
            <button style="margin-top: 16px;">Отправить</button>
        </form>
    </div>
</div>
