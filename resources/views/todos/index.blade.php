@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row mb-3">
        <div class="col d-flex flex-row">
            <a class="btn btn-light border mx-2 px-3" href="{{route('groups.create')}}" role="button">+グループ</a>
            <a class="btn btn-light border mx-2 px-3" href="#" data-bs-toggle="modal" data-bs-target="#addTagModal" role="button">+タグ</a>
            @include('modals.add_tag')
        </div>
    </div>
    <div class="row">
        @foreach($groups as $group)
        @if($group->mytodo ==1)
        <!-- mytodo -->
        <div class="col-md-4 col">
            <div class="card text-bg-light mb-3">
                <div class="card-body">
                    <h4 class="card-title ms-1 mb-0">{{$group->name}}</h4>
                    <div class="button_solid001 my-3">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addTodoModal{{ $group->id }}">+Todo追加</a>
                    </div>
                    @include('modals.add_todo')
                    @foreach($group->todos()->where('done','0')->get() as $todo)
                    @if($todo->working==NULL)
                    <div class="card mx-2 my-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title ms-1 mb-0">{{$todo->content}}</h5>
                                <div class="dropdown dropend">
                                    <a href="#" class="dropdown-toggle px-1 fs-5 fw-bold link-dark text-decoration-none" id="dropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                                    <ul class="dropdown-menu text-center" aria-labelledby="dropdownMenuLink">
                                        <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editTodoModal{{ $todo->id }}">編集</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="{{route('todos.done', $todo)}}" class="dropdown-item">完了</a></li>
                                    </ul>
                                </div>
                                @include('modals.edit_todo')
                            </div>
                            <div class="d-flex  justify-content-end mx-1">
                                @foreach ($todo->tags()->orderBy('id', 'asc')->get() as $tag)
                                <div class="d-flex align-items-center mt-2 me-2">
                                    <span class="tag-index">{{ $tag->name }}</span>
                                </div>
                                @endforeach
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
                            <div class="d-flex  justify-content-end mx-1">
                                @foreach ($todo->tags()->orderBy('id', 'asc')->get() as $tag)
                                <div class="d-flex align-items-center mt-2 me-2">
                                    <span class="tag-index">{{ $tag->name }}</span>
                                </div>
                                @endforeach
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
                            <div class="d-flex  justify-content-end mx-1">
                                @foreach ($todo->tags()->orderBy('id', 'asc')->get() as $tag)
                                <div class="d-flex align-items-center mt-2 me-2">
                                    <span class="tag-index">{{ $tag->name }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <!-- 共有todo -->
        <div class="col-md-4 col">
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
                            <div class="d-flex  justify-content-end mx-1">
                                @foreach ($todo->tags()->orderBy('id', 'asc')->get() as $tag)
                                <div class="d-flex align-items-center mt-2 me-2">
                                    <span class="tag-index">{{ $tag->name }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="card mx-2 my-3">
                        <div class="card-body" style="opacity:0.5;" id="card">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="card-title ms-1 mb-0">{{$todo->content}}</h5>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="fw-bold">進行中&nbsp;:&nbsp;{{$todo->working}}</p>
                                <div class="d-flex  justify-content-end mx-1">
                                    @foreach ($todo->tags()->orderBy('id', 'asc')->get() as $tag)
                                    <div class="d-flex align-items-center mt-2 me-2">
                                        <span class="tag-index">{{ $tag->name }}</span>
                                    </div>
                                    @endforeach
                                </div>
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
                            <div class="d-flex  justify-content-end mx-1">
                                @foreach ($todo->tags()->orderBy('id', 'asc')->get() as $tag)
                                <div class="d-flex align-items-center mt-2 me-2">
                                    <span class="tag-index">{{ $tag->name }}</span>
                                </div>
                                @endforeach
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