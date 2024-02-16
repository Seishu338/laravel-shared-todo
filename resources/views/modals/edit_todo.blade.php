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
                    <input type="text" class="form-control border-3 @error('content') is-invalid @enderror" required name="content" value="{{$todo->content}}">
                    <div class="d-flex flex-wrap my-2 mx-1">
                        @foreach ($tags as $tag)
                        <div class="d-flex align-items-center mt-2 me-2">
                            @if ($todo->tags()->where('tag_id', $tag->id)->exists())
                            <input class="me-1" type="checkbox" name="tag_ids[]" value="{{ $tag->id }}" checked>
                            @else
                            <input class="me-1" type="checkbox" name="tag_ids[]" value="{{ $tag->id }}">
                            @endif
                            <span class="tag">{{ $tag->name }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @error('content')
                <span class="invalid-feedback" role="alert">
                    <strong>入力してください</strong>
                </span>
                @enderror
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                    <button type="submit" class="btn btn-primary">編集</button>
                </div>
            </form>
        </div>
    </div>
</div>