@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <span>
                <a href="{{ route('mypage') }}">マイページ</a> > 会員情報の編集
            </span>

            <h2 class="mt-3 mb-3">会員情報の編集</h2>
            <hr>

            <form method="POST" action="{{ route('mypage') }}">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="name" class="text-md-left">氏名</label>
                    </div>
                    <div>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" autocomplete="name" autofocus placeholder="佐藤 太郎">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>氏名を入力してください。</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="email" class="text-md-left">メールアドレス</label>
                    </div>
                    <div>
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="email" autofocus placeholder="sato@taro.com">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>メールアドレスを入力してください。</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <br>

                <div>
                    <label for="code" class="text-md-left">会員コード</label>
                    <p>{{$user->code}}</p>
                </div>

                <hr>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-3 w-25">
                        保存
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection