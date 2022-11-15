@extends('common.page')

@php
    function getValue($oldValue, $currentValue)
    {
        if ($oldValue) {
            return $oldValue;
        } elseif ($currentValue) {
            return $currentValue;
        } else {
            return '';
        }
    }
@endphp

@section('content')
    <form method="POST" action="/project/{{ $project->id }}" style="width: 30%">
        @csrf
        <div style="margin-bottom: 24px; display: flex; flex-direction: column">
            <label for="name">Название проекта</label>
            <input type="text" value="{{ getValue(old('name'), $project->name) }}" name="name" id="name">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div style="margin-bottom: 24px; display: flex; flex-direction: column">
            <label for="short_about">Короткое описание проекта</label>
            <input type="text" value="{{ getValue(old('short_about'), $project->short_about) }}" name="short_about"
                id="short_about">
        </div>
        <div style="margin-bottom: 24px; display: flex; flex-direction: column">
            <label for="award">Вознаграждение</label>
            <input type="text" value="{{ getValue(old('award'), $project->award) }}" name="award" id="award">
            <x-input-error :messages="$errors->get('award')" class="mt-2" />
        </div>
        <div style="margin-bottom: 24px; display: flex; flex-direction: column">
            <label for="about">Описание проекта</label>
            <textarea name="about" id="about" cols="30" rows="10">{{ getValue(old('about'), $project->award) }}</textarea>
            <x-input-error :messages="$errors->get('about')" class="mt-2" />
        </div>

        <div style="margin-bottom: 24px; display: flex; flex-direction: column">
            <button>Сохранить проект</button>
        </div>

    </form>
@endsection
