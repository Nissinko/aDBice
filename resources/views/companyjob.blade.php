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

    #run_0 td{
        color: #c6c8ca;
    }

    .clickable{
        cursor : pointer;
    }

    .clickable:hover{
        background: #dae0e5;
    }

</style>

@section('main')
    <h1>{{$name}}の求人一覧</h1>

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
            <th>業界</th>
            <th>職種分類</th>
            <th>求人内容</th>
            <th>必須条件</th>
            <th>年収</th>
            <th>業務内容</th>
            <th>選考状況</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($send as $index=>$job)
            <tr id={{"run_" . $job->running}} data-href={{ $job->url }} class="clickable">
                <td width="10%">{{ $job->gyoukai }}</td>
                <td width="10%">{{ $job->job_class }}</td>
                <td width="15%">{{ $job->title }}</td>
                <td width="14%">{{ Alleviate($job->necessary, 30) }}</td>
                {{--<td width="14%">{{ Alleviate($user->recommendation, 30) }}</td>--}}
                <td width="13%">{{ $job->salary_low }}万円~{{ $job->salary_high }}万円</td>
                <td width="14%">{{ Alleviate($job->contents, 30) }}</td>
                <td width="14%">{{ $status_array[$index] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
