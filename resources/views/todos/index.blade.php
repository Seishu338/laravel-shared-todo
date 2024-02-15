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
        <!-- mytodo -->
        <div class="col-4">
            <div class="card text-bg-light mb-3">
                <div class="card-body">
                    <h4 class="card-title ms-1 mb-0">{{$group->name}}</h4>
                    <div class="button_solid001 my-3">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addTodoModal{{ $group->id }}">+Todo追加</a>
                    </div>
                    <span id="mytodo" data-mytodo="1"></span>
                    @include('modals.add_todo')
                    @foreach($group->todos()->where('done','0')->get() as $todo)
                    @if($todo->working==NULL)
                    <div class="card mx-2 my-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title ms-1 mb-0">{{$todo->content}}</h5>
                                <div class="dropdown dropend">
                                    <a href="#" class="dropdown-toggle px-1 fs-5 fw-bold link-dark text-decoration-none" id="dropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="dropdownMenuLink">
                                        <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editTodoModal{{ $todo->id }}">編集</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="{{route('todos.done', $todo)}}" class="dropdown-item">完了</a></li>
                                    </ul>
                                </div>
                                @include('modals.edit_todo')
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="card mx-2 my-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title ms-1 mb-0">{{$todo->content}}</h5>
                                <div class="dropdown dropend">
                                    <a href="#" class="dropdown-toggle px-1 fs-5 fw-bold link-dark text-decoration-none" id="dropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="dropdownMenuLink">
                                        <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editTodoModal{{ $todo->id }}">編集</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="{{route('todos.returnshare', $todo)}}" class="dropdown-item">完了</a></li>
                                    </ul>
                                </div>
                                @include('modals.edit_todo')
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <div class="mt-2">
                        <hr>
                    </div>
                    @foreach($group->todos()->where('done','1')->get() as $todo)
                    <div class="card mx-2 my-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title ms-1 mb-0"><span class="checkmark001"></span>{{$todo->content}}</h5>
                                <div class="dropdown dropend">
                                    <a href="#" class="dropdown-toggle px-1 fs-5 fw-bold link-dark text-decoration-none" id="dropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="dropdownMenuLink">
                                        <li><a href="#" class="dropdown-item">編集</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li>
                                            <form action="{{route('todos.destroy', $todo)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="dropdown-item">削除</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <!-- 共有todo -->
        <div class="col-4">
            <div class="card text-bg-light mb-3">
                <div class="card-body">
                    <h4 class="card-title ms-1 mb-0">共有Todo&nbsp;{{$group->name}}</h4>
                    <div class="button_solid001 my-3">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addTodoModal{{ $group->id }}">+Todo追加</a>
                    </div>
                    @include('modals.add_todo')
                    @foreach($group->todos()->where('done','0')->get() as $todo)
                    @if($todo->working==NULL)
                    <div class="card mx-2 my-3">
                        <div class="card-body" id="card">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title ms-1 mb-0">{{$todo->content}}</h5>
                                <div class="dropdown dropend" id="dropdown">
                                    <a href="#" class="dropdown-toggle px-1 fs-5 fw-bold link-dark text-decoration-none" id="dropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="dropdownMenuLink">
                                        <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editTodoModal{{ $todo->id }}">編集</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="{{route('todos.addmytodo',$todo)}}" class="dropdown-item">+MyTodo</a></li>
                                    </ul>
                                </div>
                                @include('modals.edit_todo')
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="card mx-2 my-3">
                        <div class="card-body" style="opacity:0.5;" id="card">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title ms-1 mb-0">{{$todo->content}}</h5>
                            </div>
                            <p class="fw-bold">進行中&nbsp;:&nbsp;{{$todo->working}}</p>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <div class="mt-2">
                        <hr>
                    </div>
                    @foreach($group->todos()->where('done','1')->get() as $todo)
                    <div class="card mx-2 my-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title ms-1 mb-0"><span class="checkmark001"></span>{{$todo->content}}</h5>
                                <div class="dropdown dropend">
                                    <a href="#" class="dropdown-toggle px-1 fs-5 fw-bold link-dark text-decoration-none" id="dropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="dropdownMenuLink">
                                        <li><a href="#" class="dropdown-item">編集</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li>
                                            <form action="{{route('todos.destroy', $todo)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="dropdown-item">削除</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endsection