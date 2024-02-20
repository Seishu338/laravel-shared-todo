@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-10 offset-1">
            <span>
                <a href="{{ route('mypage') }}">マイページ</a> > グループ
            </span>

            <h2 class="mt-3 mb-3">グループ</h2>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-10 offset-1">
            @if($flag ==0)
            <div class="row my-2">
                <h3 class="my-3">現在、グループに所属していません。</h3>
            </div>
            @else
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
                            <div class="d-flex justify-content-end">
                                <form action="{{ route('mypage.groups.destroy', $group) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-danger mx-1">削除</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endsection