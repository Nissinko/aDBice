@extends('layouts.master')

@section('main')
<h1>応募者確認画面</h1>

<form action="{{ route('app_revise.finish') }}" method="post">
    <div class="alert alert-success" role="alert">データベースにデータを挿入しました！</div>
    <a href="/users">一覧画面に戻る</a>
</form>
@endsection
