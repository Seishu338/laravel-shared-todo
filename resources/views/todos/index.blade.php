@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row mb-3">
        <div class="col-3">
            <button class="btn btn-light border mx-2 px-3" id="mytodo-button" href="#" data-bs-toggle="modal" data-bs-target="#todocreateModal">+mytodoの追加</button>

            <!-- Modal -->
            <div class="modal fade" id="todocreateModal" tabindex="-1" aria-labelledby="todocreateModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="todocreateModalLabel">My Todo追加</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('todos.store')}}" method="post">
                            @csrf
                            <div class="modal-body">
                                <input type="text" class="form-control" name="content">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                                <button type="submit" class="btn btn-primary">追加</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <button class="btn btn-light border mx-2 px-3" href="{{route('groups.index')}}">+グループ</button>
        </div>
    </div>
    <div class="row">
        @foreach($groups as $group)
        <div class="col-4">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h4 class="card-title ms-1 mb-0">{{$group->name}}</h4>
                    <div class="button_solid001 my-3">
                        <a href="#">+Todo追加</a>
                    </div>
                    @foreach($group->todos()->get() as $todo)
                    <div class="card mx-2 mb-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title ms-1 mb-0">{{$todo->content}}</h5>
                                <div class="dropdown dropend">
                                    <a href="#" class="dropdown-toggle px-1 fs-5 fw-bold link-dark text-decoration-none" id="dropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="dropdownMenuLink">
                                        <li><a href="#" class="dropdown-item">編集</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="#" class="dropdown-item">削除</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @if($group->mytodo == 0)
        <script>
            const button = document.getElementById('mytodo-button');
            button.style.display = "none";
        </script>
        @endif
        @endforeach
    </div>
</div>


@endsection