@extends('layouts.master')

<style>
    dl { width:430px; }
    dt { float:left; }
    dd { margin-left:0px; }
    dd { color: #636b6f; }
</style>

@section('main')
    <h1>求人票確認画面</h1>
    <p>入力内容を確認し、送信を推して下さい</p>

    <form action="{{ route('app_revise.finish') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="name" value="{{$name}}">
        <input type="hidden" name="url" value="{{$url}}">
        <input type="hidden" name="furigana" value="{{$furigana}}">
        <input type="hidden" name="gender" value="{{$gender}}">
        <input type="hidden" name="age" value="{{$age}}">
        <input type="hidden" name="prefecture" value="{{$prefecture}}">
        <input type="hidden" name="phone" value="{{$phone}}">
        <input type="hidden" name="company" value="{{$company}}">
        <input type="hidden" name="company_num" value="{{$company_num}}">
        <input type="hidden" name="education" value="{{$education}}">
        <input type="hidden" name="job_class" value="{{$job_class}}">
        <input type="hidden" name="gyoukai" value="{{$gyoukai}}">
        <input type="hidden" name="salary" value="{{$salary}}">
        <input type="hidden" name="hope_place" value="{{$hope_place}}">
        <input type="hidden" name="hope_job_class" value="{{$hope_job_class}}">
        <input type="hidden" name="hope_gyoukai" value="{{$hope_gyoukai}}">
        <input type="hidden" name="mail" value="{{$mail}}">
        <input type="hidden" name="education_detail" value="{{$education_detail}}">
        <input type="hidden" name="skill" value="{{$skill}}">
        <input type="hidden" name="shokumu_abst" value="{{$shokumu_abst}}">
        <input type="hidden" name="PR" value="{{$PR}}">
        <input type="hidden" name="motivation" value="{{$motivation}}">

        <dl>
            <dt>氏名（漢字）：</dt>
            <dd> {{$name}} </dd>
        </dl>
        <br>
        <dl>
            <dt>氏名（フリガナ）：</dt>
            <dd> {{$furigana}} </dd>
        </dl>
        <br>
        <dl>
            <dt>年齢：</dt>
            <dd> {{$age}} </dd>
        </dl>
        <br>
        <dl>
            <dt>都道府県：</dt>
            <dd>{{config('pref')[$prefecture]}}</dd>
        </dl>
        <br>
        <dl>
            <dt>性別：</dt>
            <dd>{{config('gender')[$gender]}}</dd>
        </dl>
        <br>
        <dl>
            <dt>電話番号：</dt>
            <dd> {{$phone}} </dd>
        </dl>
        <br>
        <dl>
            <dt>メールアドレス：</dt>
            <dd> {{$mail}} </dd>
        </dl>
        <br>
        <dl>
            <dt>現勤務会社：</dt>
            <dd> {{$company}} </dd>
        </dl>
        <br>
        <dl>
            <dt>経験社数：</dt>
            <dd> {{$company_num}} </dd>
        </dl>
        <br>
        <dl>
            <dt>学歴：</dt>
            <dd> {{$education}} </dd>
        </dl>
        <br>
        <dl>
            <dt>職種：</dt>
            <dd> {{$job_class}} </dd>
        </dl>
        <br>
        <dl>
            <dt>業界：</dt>
            <dd> {{$gyoukai}} </dd>
        </dl>
        <br>
        <dl>
            <dt>年収：</dt>
            <dd> {{$salary}} </dd>
        </dl>
        <br>
        <dl>
            <dt>希望勤務地：</dt>
            <dd> {{$hope_place}} </dd>
        </dl>
        <br>
        <dl>
            <dt>希望業種：</dt>
            <dd> {{$hope_gyoukai}} </dd>
        </dl>
        <br>
        <dl>
            <dt>希望職種：</dt>
            <dd> {{$hope_job_class}} </dd>
        </dl>
        <br>
        <dl>
            <dt>学校詳細情報：</dt>
            <dd>{{$education_detail}}</dd>
        </dl>
        <br>
        <dl>
            <dt>スキル/資格：</dt>
            <dd>{{$skill}}</dd>
        </dl>
        <br>
        <dl>
            <dt>職務概要：</dt>
            <dd>{{$shokumu_abst}}</dd>
        </dl>
        <br>
        <dl>
            <dt>自己PR：</dt>
            <dd>{{$PR}}</dd>
        </dl>
        <br>
        <dl>
            <dt>志望動機：</dt>
            <dd>{{$motivation}}</dd>
        </dl>
        <br>
        <div><input type="submit" name="button1" value="送信" /></div>
    </form>
@endsection
