@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    グループ作成
                </div>
                <div class="card-body">
                    <form action="{{route('groups.store')}}" method="POST">
                        @csrf
                        <div class="form-group row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">メンバー1</label>
                            <div class="col-md-6">
                                <input type="text" name="ids[]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">メンバー2</label>
                            <div class="col-md-6">
                                <input type="text" name="ids[]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">メンバー3</label>
                            <div class="col-md-6">
                                <input type="text" name="ids[]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">メンバー4</label>
                            <div class="col-md-6">
                                <input type="text" name="ids[]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-block">作成</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection