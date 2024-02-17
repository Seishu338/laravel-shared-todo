<div class="modal fade" id="addTodoModal{{ $group->id }}" tabindex="-1" aria-labelledby="addTodoModalLabel{{ $group->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addTodoModalLabel{{ $group->id }}">Todo追加</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('todos.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="text" class="form-control border-3 @error('content') is-invalid @enderror" required name="content">
                    <input type="hidden" class="form-control" name="group_id" value="{{$group->id}}">
                </div>
                @error('content')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                    <button type="submit" class="btn btn-primary">追加</button>
                </div>
            </form>
        </div>
    </div>
</div>