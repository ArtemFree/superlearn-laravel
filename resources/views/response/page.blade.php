<div>
    <a href="/project/{{ $response->project->id }}">Назад</a>
    <h1>Отлик: {{ $response->project->name }}</h1>
    <p>Создан: {{ date($response->project->created_at) }}</p>
    <p>Создал: {{ $response->project->user_id }}</p>
    <p>Вознаграждение: <strong>{{ $response->project->award }}</strong></p>
    <p>Коротко: {{ $response->project->short_about }}</p>
    <p>Подробнее: {{ $response->project->about }}</p>

    @if (Auth::user()->role->name == 'author' && $response->selected_author_id == $response->author->id && !$response->project->is_in_work)
        <form method="POST"
        action="/project/{{ $response->project->id }}/response/confirm-author">
            @csrf
            <p style="padding: 16px; background-color: #5cd9b0; width: fit-content;">
                Вас выбрали в качестве исполнителя. Пожалуйста, подтвердите ваше участие.
                
                <button style="margin-left: 24px;">Подтвердить</button>
            </p>
            <label>
                <input required type="checkbox" name="confirmed" />
                <span>Я подтверждаю свое согласие и согласен с Правилами сервиса и Политикой обработкой персональных данных</span>
            </label>

        </form>
    @endif

    @if (Auth::user()->role->name == 'author' && $response->project->author_id && Auth::id())
        <p style="padding: 16px; background-color: #5cd9b0; width: fit-content;">
            Вы являетесь исполнителем проекта.
        </p>
    @endif

    @if (Auth::user()->role->name == 'user' && $response->project->author_id)
        <p style="padding: 16px; background-color: #5cd9b0; width: fit-content;">
            Исполнитель подтвердил свое участие в проекте.
        </p>
    @endif

    @if (Auth::user()->role->name == 'user' && $response->selected_author_id && !$response->project->author_id)
        <p style="padding: 16px; background-color: #5cd9b0; width: fit-content;">
            Вы выбрали автора в качестве исполнителя. Ожидается его подтверждение.
        </p>
    @endif

    @if (Auth::user()->role->name == 'user' && !$response->selected_author_id)
        <form method="POST"
            action="/project/{{ $response->project->id }}/response/{{ $response ? $response->id : '' }}/select-author">
            @csrf
            <p>
                <button>Выбрать этого исполнителя</button>
            </p>
        </form>
    @endif

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
        <form action="/project/{{ $response->project->id }}/response/{{ $response ? $response->id : '' }}/message"
            method="POST" style="margin-top: 64px; display: flex; flex-direction: column; width: 50%">
            @csrf

            <textarea name="text" id="text" cols="30" rows="10" placeholder="Введите сообщение..."></textarea>
            <button style="margin-top: 16px;">Отправить</button>
        </form>
    </div>
</div>
