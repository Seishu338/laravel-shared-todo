@extends('layouts.app')
@section('content')

<div class="container">
    <div class="col-10 offset-1">
        <div class="row my-2">
            <div class="col-3">
                <a class="btn btn-light border mx-2 px-3" href="{{route('groups.create')}}" role="button">+グループ作成</a>
            </div>
        </div>
        <div class="row my-2">
            @foreach($groups as $group)
            <div class="col-4">
                <div class="card">
                    <h5 class="card-header">{{$group->name}}</h5>
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            @foreach($group->users()->get() as $user)
                            <h5 class="card-title mx-1">{{$user->name}}</h5>
                            @endforeach
                        </div>
                        <a href="#" class="btn btn-outline-primary">編集</a>
                        <a href="#" class="btn btn-outline-primary">Todo作成</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection