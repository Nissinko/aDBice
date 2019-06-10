@extends('layouts.master')

<style>
    select {
        width: 130px;
        height: 30px;
        font-size: 12px;
    }
    dt {
        font-size: 18px;
    }
    #first, #last {
        font-size: 18px;
        color: #e3342f;
    }
    #offer {
        color : dodgerblue;
    }
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    function mySubmit(formName, idname) {
        // month値を取得する
        var obj = document.getElementById(idname);
        var month = obj.value;

        // var f = document.forms[formName];
        //
        // f.method = 'GET'; // method(GET or POST)を設定する
        var month_url = null;
        if (month == 0){
            month_url = '/statistics';
        }
        else{
            month_url = '/statistics?month=' + month;
        }
        document.location.href = month_url; // submit する
    }
</script>

@section('main')
    <h1>統計情報</h1>
    月を選択して下さい。
    <form name="myForm">
        <select id="month">
                <option value=0>月を選択</option>
            @foreach($month_list as $month)
                <option value={{$month}}>{{substr((string) $month, 0, 4). "年" . substr((string) $month, 4, 6) . "月"}}</option>
            @endforeach
        </select>
        <input type="button" name="month" value="表示" onClick="mySubmit('myForm', 'month')" />
    </form>

    @if ($view)
        <h2>{{$send_month}}の結果</h2>
        <dl>
            <dt id="introduce">案件紹介数：{{ $introduce_count }}  (1人あたりの紹介数：{{ $introduce_per_person }}) </dt>
        </dl>
        <dl>
            <dt id="submit">書類提出数：{{ $submit_count }}  (提出率：{{ $submit_rate }}%) </dt>
        </dl>
        <dl>
            <dt id="first">一次面接設定数：{{ $first_interview_count }}  (書類通過率：{{ $pass_document_rate }}%) </dt>
        </dl>
        <dl>
            <dt id="last">最終面接設定数：{{ $last_interview_count }}</dt>
        </dl>
        <dl>
            <dt id="offer">内定数：{{ $offer_count }}</dt>
        </dl>
    @endif

@endsection
