<ul>
    @foreach ($projects as $project)
        <div>
            <a href="/project/{{ $project->id }}">
                <h3>{{ $project->name }}</h3>
            </a>
            <p>О проекте: {{ $project->short_about }}</p>
            <p>Оплата: {{ $project->award }}</p>
        </div>
    @endforeach
</ul>
