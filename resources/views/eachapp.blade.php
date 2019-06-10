@extends('layouts.master')

<style>
    table {
        border-collapse: collapse;
        border-style: none;
    }

    table td{
        color: #444444;
        padding: 10px 10px;
        border-left-style: none;
        border-right-style: none;
    }

    table tr td:nth-child(1) {
        width: 20%;
        font-size: 18px;
        font-weight: bold;
    }
    table tr td:nth-child(2) {
        width: 70%;
    }
    a {
        font-size: 18px;
    }
    #revise{
        margin-right: 100px;
    }
    p.right{
        text-align: right;
        margin-right: 200px;
    }
</style>

@section('main')
    <h1>応募者詳細</h1>
    {{--<p class="right">--}}
        {{--<a href={{ $send->url . "/selection" }}>選考中求人を管理する</a>--}}
    {{--</p>--}}
    <table border="1">
        <tr>
            <td>氏名（漢字）：</td>
            <td> {{$send->name}} </td>
        </tr>

        <tr>
            <td>氏名（フリガナ）：</td>
            <td> {{$send->furigana}} </td>
        </tr>

        <tr>
            <td>年齢：</td>
            <td> {{$send->age}} </td>
        </tr>

        <tr>
            <td>都道府県：</td>
            <td>{{$send->prefecture}}</td>
        </tr>

        <tr>
            <td>性別：</td>
            <td>{{$send->gender}}</td>
        </tr>

        <tr>
            <td>電話番号：</td>
            <td> {{$send->phone}} </td>
        </tr>

        <tr>
            <td>メールアドレス：</td>
            <td> {{$send->mail}} </td>
        </tr>

        <tr>
            <td>現勤務会社：</td>
            <td> {{$send->company}} </td>
        </tr>

        <tr>
            <td>経験社数：</td>
            <td> {{$send->company_num}} </td>
        </tr>

        <tr>
            <td>学歴：</td>
            <td> {{$send->education}} </td>
        </tr>

        <tr>
            <td>職種：</td>
            <td> {{$send->job_class}} </td>
        </tr>

        <tr>
            <td>業界：</td>
            <td> {{$send->gyoukai}} </td>
        </tr>

        <tr>
            <td>年収：</td>
            <td> {{$send->salary}} </td>
        </tr>

        <tr>
            <td>希望勤務地：</td>
            <td> {{$send->hope_place}} </td>
        </tr>

        <tr>
            <td>希望業種：</td>
            <td> {{$send->hope_gyoukai}} </td>
        </tr>

        <tr>
            <td>希望職種：</td>
            <td> {{$send->hope_job_class}} </td>
        </tr>

        <tr>
            <td>学校詳細情報：</td>
            <td>{{$send->education_detail}}</td>
        </tr>

        <tr>
            <td>スキル/資格：</td>
            <td>{{$send->skill}}</td>
        </tr>

        <tr>
            <td>職務概要：</td>
            <td>{{$send->shokumu_abst}}</td>
        </tr>

        <tr>
            <td>自己PR：</td>
            <td>{{$send->PR}}</td>
        </tr>

        <tr>
            <td>志望動機：</td>
            <td>{{$send->motivation}}</td>
        </tr>
    </table>
    <a id="revise" href={{ $send->url . "/revise" }}>応募者情報を修正する</a>

    <a onclick="return confirm('データを削除します。宜しいですか？')" href={{ $send->url . "/delete" }} >応募者情報を削除する</a>
@endsection
