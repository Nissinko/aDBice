@extends('layouts.master')

@section('main')
    <h1>求人票確認画面</h1>

    <form action="{{ route('revise.finish') }}" method="post">
        <div class="alert alert-success" role="alert">データベースにデータを挿入しました！</div>
        <a href="/jobs">一覧画面に戻る</a>
    </form>
@endsection
