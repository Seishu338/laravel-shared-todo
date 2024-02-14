@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center mt-3">
    <div clasa="row">
        <div class="col-10 text-center">
            <h2>マイページ</h2>
        </div>
        <hr>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="card-title">会員情報編集</h3>
                        <p class="card-text my-1">アカウント情報の編集</p>
                    </div>
                    <div class="card-footer text-center py-0">
                        <a href="{{route('mypage.edit')}}" class="btn">編集</a>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h3 class="card-title">パスワード変更</h3>
                        <p class="card-text my-1">パスワードを変更します</p>
                    </div>
                    <div class="card-footer text-center py-0">
                        <a href="{{route('mypage.edit_password')}}" class="btn">変更</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection