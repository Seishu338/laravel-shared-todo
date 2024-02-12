@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row mb-3">
        <div class="col-lg-4 col d-flex flex-row">
            <a class="btn btn-light border mx-2 px-3" id="mytodo-button" href="{{route('todos.create')}}" role="button">+mytodoの追加</a>
            <a class="btn btn-light border mx-2 px-3" href="{{route('groups.index')}}" role="button">+グループ</a>
            <div class="mx-2 px-3 mt-2 fw-bold">
                @sortablelink('mytodo', 'sort') &#8646;
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($groups as $group)
        @if($group->mytodo ==1)
        <div class="col-4">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h4 class="card-title ms-1 mb-0">{{$group->name}}</h4>
                    <div class="button_solid001 my-3">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addTodoModal{{ $group->id }}">+Todo追加</a>
                    </div>
                    <!-- modal -->
                    <div class="modal fade" id="addTodoModal{{ $group->id }}" tabindex="-1" aria-labelledby="addTodoModalLabel{{ $group->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addTodoModalLabel{{ $group->id }}">My Todo追加</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('todos.store')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="text" class="form-control" name="content">
                                        <input type="hidden" class="form-control" name="group_id" value="{{$group->id}}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                                        <button type="submit" class="btn btn-primary">追加</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if($group->todos()->get() !== NULL)
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
                    @endif
                </div>
            </div>
        </div>
        @else
        <div class="col-4">
            <div class="card text-bg-light">
                <div class="card-body">
                    <h4 class="card-title ms-1 mb-0">共有{{$group->name}}</h4>
                    <div class="button_solid001 my-3">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addsharedTodoModal{{ $group->id }}">+Todo追加</a>
                    </div>
                    <div class="modal fade" id="addsharedTodoModal{{ $group->id }}" tabindex="-1" aria-labelledby="addsharedTodoModalLabel{{ $group->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="addsharedTodoModalLabel{{ $group->id }}">共有Todo追加</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('todos.store')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="text" class="form-control" name="content">
                                        <input type="hidden" class="form-control" name="group_id" value="{{$group->id}}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                                        <button type="submit" class="btn btn-primary">追加</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if($group->todos()->get() !== NULL)
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
                    @endif
                </div>
            </div>
        </div>
        @endif
        @if($group->mytodo == 1)
        <script>
            const button = document.getElementById('mytodo-button');
            button.style.display = "none";
        </script>
        @endif
        @endforeach
    </div>
</div>
@endsection