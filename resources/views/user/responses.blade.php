<ul>
    @foreach ($responses as $response)
        <div>
            <a href="/project/{{ $response->project->id }}">
                <h3>{{ $response->project->name }}</h3>
            </a>
            <p>О проекте: {{ $response->project->short_about }}</p>
            <p>Оплата: {{ $response->project->award }}</p>
            <a href="/project/{{$response->project->id}}/response">Страница отклика </a>
        </div>
    @endforeach
</ul>
