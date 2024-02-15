<div class="modal fade" id="editTodoModal{{ $todo->id }}" tabindex="-1" aria-labelledby="editTodoModalLabel{{ $todo->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editTodoModalLabel{{ $todo->id }}">Todo編集</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('todos.update',$todo)}}" method="post">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <input type="text" class="form-control" name="content" value="{{$todo->content}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                    <button type="submit" class="btn btn-primary">編集</button>
                </div>
            </form>
        </div>
    </div>
</div>