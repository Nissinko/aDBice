@extends('layouts.master')

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
    #search_name{
        margin-bottom: 20px;
    }

    select {
        width: 130px;
        height: 30px;
        font-size: 12px;
        margin-left: 20px;
        margin-right: 20px;
    }
    input[type="button"] {
        width: 40px;
        line-height: 1;
    }

</style>

@section('main')
    <h1>応募者一覧</h1>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
            if (obj['name']){
                document.getElementById('search_name').value = GetQueryString()['name'];
            }
            if (obj['term']){
                document.getElementById('term').value = GetQueryString()['term'];
            }
        });

        function OnButtonClick() {
            let search_name = document.getElementById("search_name").value;
            let term = document.getElementById("term").value;
            let obj = GetQueryString();
            if (search_name != ""){
                obj['name'] = search_name;
            }
            else{
                delete obj.name;
            }
            if (term != 0){
                obj['term'] = term;
            }
            else{
                delete obj.term;
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
    </script>
    <form name="sort">
        <input type="text" id="search_name" placeholder="名前を入力">
        <select id="term">
            <option value=0>期間を選択</option>
            <option value=1>今月</option>
            <option value=2>先月</option>
            <option value=3>過去3ヶ月</option>
        </select>
        <input type="button" value="表示" onclick="OnButtonClick()">
    </form>

    <table border="1">
        <thead>
        <tr>
            @foreach ($AppColumns as $col)
                <th>{{ $col }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        <!-- {{ $i = 0 }} -->
        @foreach ($datas as $user)
            <tr data-href={{ $user->url . "/selection" }} class="clickable">
                <td width="10%">{{ $user->name }}</td>
                <td width="10%">{{ $user->company }}</td>
                <td width="14%">{{ $user->job_class }}</td>
                <td width="5%">{{ $user->age }}</td>
                <td width="14%">{{ $user->education}}</td>
                <td width="10%">{{ $user->prefecture}}</td>
                <td width="10%">{{ $status_array[$i] }}</td>
                <td width="13%">{{ $user->day }}</td>
            </tr>
            <!-- {{ $i = $i + 1 }} -->
        @endforeach
        </tbody>
    </table>
    <div>
        {{$datas->appends($params)->links('vendor.pagination.bootstrap-4')}}
    </div>
@endsection
