<div class="modal fade" id="addTagModal" tabindex="-1" aria-labelledby="addTagModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addTagModalLabel">タグ追加</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="d-flex flex-wrap mt-1 mb-3 mx-1">
                @foreach ($tags as $tag)
                <div class="d-flex align-items-center mt-2 mx-2">
                    <span class="tag">{{ $tag->name }}</span>
                    <form action="{{route('tags.destroy', $tag)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn-close"></button>
                    </form>
                </div>
                @endforeach
            </div>
            <form action="{{route('tags.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="text" class="form-control border-3 @error('reservations_date') is-invalid @enderror" required name="name">
                </div>
                @error('nme')
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