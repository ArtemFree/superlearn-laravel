<form>
    {{-- <p>Фильтры</p>
    <select name="author_type" id="">
        <option value="all">Все</option>
        <option {{ $author_type == 'completed' ? 'selected' : '' }} value="completed">Завершенные</option>
        <option {{ $author_type == 'archived' ? 'selected' : '' }} value="archived">Архивированные</option>
    </select>
    <select name="author_order" id="">
        <option {{ $author_order == 'new' ? 'selected' : '' }} value="new">Сначала новые</option>
        <option {{ $author_order == 'old' ? 'selected' : '' }} value="old">Сначала старые</option>
    </select>
    <input name="award_from" placeholder="Вознаграждение от:"
        @isset($award_from)
            value={{ $award_from }} 
        @endisset />
    <button type="submit">Применить</button> --}}
</form>
