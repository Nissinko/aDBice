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
        font-size: 15px;
    }

    .clickable{
        cursor : pointer;
    }

    .clickable:hover{
        background: #dae0e5;
    }

</style>

@section('main')
    <h1>企業一覧</h1>

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
    </script>

    <table border="1">
        <thead>
        <tr>
            <th>企業名</th>
            <th>現求人職種数</th>
            <th>書類提出数</th>
            <th>面接設定数<<th>内定数</th>
            <th>最新更新日</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($datas as $data)
            <tr data-href={{ $data["url"] }} class="clickable">
                <td width="15%">{{ $data["name"] }}</td>
                <td width="10%">{{ $data["job_num"] }}</td>
                <td width="10%">{{ $data["doc_submit"] }}</td>
                <td width="10%">{{ $data["interview"] }}</td>
                <td width="10%">{{ $data["offer"]  }}</td>
                <td width="10%">{{ $data["newdate"] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
