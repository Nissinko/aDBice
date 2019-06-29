@extends('layouts.master')

@section('main')
    <h1>求人番号{{$num}}の求人票アップロード</h1>
    <form method="POST" action={{route('job.upload')}} enctype="multipart/form-data">

        {{ csrf_field() }}

        <input type="file" id="file" name="file" class="form-control">
        <input type="hidden" name="num" value={{$num}} >

        <button type="submit" onclick="alert('アップロードに成功しました！')">アップロード</button>

    </form>
@endsection
