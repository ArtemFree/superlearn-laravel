<form>
    <p>Фильтры</p>
    <select name="project_type" id="">
        <option value="all">Все</option>
        <option {{ $project_type == 'completed' ? 'selected' : '' }} value="completed">Завершенные</option>
        <option {{ $project_type == 'archived' ? 'selected' : '' }} value="archived">Архивированные</option>
    </select>
    <select name="project_order" id="">
        <option {{ $project_order == 'new' ? 'selected' : '' }} value="new">Сначала новые</option>
        <option {{ $project_order == 'old' ? 'selected' : '' }} value="old">Сначала старые</option>
    </select>
    <input name="award_from" placeholder="Вознаграждение от:"
        @isset($award_from)
            value={{ $award_from }} 
        @endisset />
    <button type="submit">Применить</button>
</form>
