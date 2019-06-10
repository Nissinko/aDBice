@extends('layouts.master')

<?php

function Alleviate($values, $maxlen){
    if (mb_strlen($values, 'UTF-8') <= $maxlen){
        return $values;
    }
    else{
        return mb_strimwidth($values, 0, 2*$maxlen,'...', 'utf8');
    }
}

?>

<style>
    table {
        border-collapse: collapse;
    }
    table th{
        color: #EEEEEE;
        background: #0033CC;
        padding: 10px;
    }

    table td{
        color: #444444;
        padding: 3px 10px;
        font-size: 12px;
    }

    .clickable{
        cursor : pointer;
    }

    .clickable:hover{
        background: #dae0e5;
    }

    input[type="text"]:focus,
    texture:focus {
        box-shadow: 0 0 7px #3498db;
        border: 1px solid #3498db;
    }
    input[type="text"] {
        width: 200px;
        height: 30px;
        font-size: 10pt;
    }

    input[type="button"]  {
        width: 40px;
        line-height: 1;
    }
    #freeword{
        margin-bottom: 10px;
    }

    #job_class{
        margin-right: 20px;
        width: 300px;
    }

    input[name="JobClassSearchScreen"]{
        width: 90px;
    }

    .inline-block {
        display: inline-block;      /* インラインブロック要素にする */
    }
    .inline-block2 {
        display: inline-block;      /* インラインブロック要素にする */
        margin-left: 100px;
        position: absolute;
    }

</style>

@section('main')
    <h1>求人一覧</h1>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        jQuery( function($) {
            $('tbody tr[data-href]').addClass('clickable').click( function() {
                window.location = $(this).attr('data-href');
            }).find('a').hover( function() {
                $(this).parents('tr').unbind('click');
            }, function() {
                $(this).parents('tr').click( function() {
                    window.location = $(this).attr('data-href');
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // ページが読み込まれたあとに実行される部分
            var obj = GetQueryString();
            if (obj['word']){
                document.getElementById('freeword').value = GetQueryString()['word'];
            }
            if (obj['job_class']){
                document.getElementById('job_class').value = GetQueryString()['job_class'];
            }
        });

        function OnButtonClick() {
            let word = document.getElementById("freeword").value;
            let job_class = document.getElementById("job_class").value;
            let obj = GetQueryString();
            if (word != ""){
                obj['word'] = word;
            }
            else{
                delete obj.word;
            }
            if (job_class != ""){
                obj['job_class'] = job_class;
            }
            else{
                delete obj.job_class;
            }
            document.location.href = MakeQueryString(obj);
        }

        function GetQueryString() {
            if (1 < document.location.search.length) {
                // 最初の1文字 (?記号) を除いた文字列を取得する
                var query = document.location.search.substring(1);

                // クエリの区切り記号 (&) で文字列を配列に分割する
                var parameters = query.split('&');

                var result = new Object();
                for (var i = 0; i < parameters.length; i++) {
                    // パラメータ名とパラメータ値に分割する
                    var element = parameters[i].split('=');

                    var paramName = decodeURIComponent(element[0]);
                    var paramValue = decodeURIComponent(element[1]);

                    // パラメータ名をキーとして連想配列に追加する
                    result[paramName] = decodeURIComponent(paramValue);
                }
                return result;
            }
            return new Object();
        }

        function MakeQueryString(obj){
            if (obj == null){
                return document.location.href;
            }
            else{
                let url = '?';
                for (let k in obj){
                    url += k + '=' + obj[k] + '&';
                }
                url = url.slice(0, -1);
                var now_url = document.location.href;
                var process_url = now_url.replace(/\?.*$/,"");
                return process_url + url;
            }
        }

        var w = ( screen.width-640 ) / 2;
        var h = ( screen.height-480 ) / 2;
        function disp(url){
            window.open(url, 'サブ検索画面', 'width=640,height=480'
                + ',left=' + w + ',top=' + h
            );
        }
    </script>

    <div class="inline-block">
        <form name="sort">
            <input type="text" id="freeword" placeholder="フリーワード">
            <br>
            <input type="text" name="job_class" id="job_class" placeholder="職種">
            <input type="button" value="表示" onclick="OnButtonClick()">
            <br>
            <input name="JobClassSearchScreen" type="button" value="検索画面起動"
                   onClick='disp("/job_class_search?hope=0")' />
        </form>
    </div>
    <div class="inline-block2">
        <a id="stop_link" href="/jobs?running=0">掲載停止中の案件を表示</a>
    </div>

    <table border="1">
        <thead>
            <tr>
                @foreach ($JobColumns as $col)
                    <th>{{ $col }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
        @foreach ($datas as $user)
            <tr data-href={{ $user->url }} class="clickable">
                <td width="10%">{{ $user->gyoukai }}</td>
                <td width="10%">{{ $user->job_class }}</td>
                <td width="14%">{{ $user->company }}</td>
                <td width="15%">{{ $user->title }}</td>
                <td width="14%">{{ Alleviate($user->necessary, 30) }}</td>
                {{--<td width="14%">{{ Alleviate($user->recommendation, 30) }}</td>--}}
                <td width="13%">{{ $user->salary_low }}万円~{{ $user->salary_high }}万円</td>
                <td width="14%">{{ Alleviate($user->contents, 30) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        {{$datas->appends($params)->links('vendor.pagination.bootstrap-4')}}
    </div>
@endsection
