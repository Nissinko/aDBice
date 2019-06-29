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
    #watch{
        margin-right: 100px;
    }
    #revise, #stop{
        margin-right: 100px;
    }
    #selection{
        margin-right: 200px;
    }
    h3{
        color: red;
    }
</style>

@section('main')
    <h1>求人詳細</h1>
    @if ($send->running == 0)
        <h3>掲載停止中</h3>
    @endif
    {{--<a id="csv" href={{ $send->url . "/csv" }}>求人票をダウンロードする</a>--}}
    <a id="watch" href={{"/storage/job_" . $num . ".pdf"}}>求人票PDFを閲覧する</a>
    <a id="selection" href={{ $send->url . "/selection" }}>応募者を管理する</a>
    <a id="upload" href={{ $send->url . "/upload" }}>PDFアップロード</a>
    <h2>企業詳細</h2>
    <table border="1">
        <tr>
            <td>企業名：</td>
            <td> {{ $send->company }} </td>
        </tr>
        <tr>
            <td>コメント：</td>
            <td> {{ $company->comment }} </td>
        </tr>
        <tr>
            <td>代表：</td>
            <td> {{ $company->representative }} </td>
        </tr>
        <tr>
            <td>所在地：</td>
            <td> {{$company->main_place}} </td>
        </tr>
        <tr>
            <td>支社：</td>
            <td> {{$company->branch}} </td>
        </tr>
        <tr>
            <td>売上高：</td>
            <td> {{$company->sales}} </td>
        </tr>
        <tr>
            <td>事業概要：</td>
            <td> {{$company->abstract}} </td>
        </tr>
        <tr>
            <td>株式公開：</td>
            <td> {{$company->stock_open}} </td>
        </tr>
        <tr>
            <td>外資比率：</td>
            <td> {{$company->inner_ratio}} </td>
        </tr>
        <tr>
            <td>主な株主：</td>
            <td> {{$company->stockholder}} </td>
        </tr>
        <tr>
            <td>URL：</td>
            <td> {{$company->url}} </td>
        </tr>
    </table>

    <table border="1">
        <h2>求人詳細</h2>

        <tr>
            <td>業種分類：</td>
            <td> {{$send->gyoukai}} </td>
        </tr>

        <tr>
            <td>職種分類：</td>
            <td> {{$send->job_class}} </td>
        </tr>

        <tr>
            <td>求人内容：</td>
            <td> {{$send->title}} </td>
        </tr>

        <tr>
            <td>必要なスキル・経験：</td>
            <td>
                {{$send->necessary}}
            </td>
        </tr>

        <tr>
            <td>歓迎スキル：</td>
            <td>
                {{$send->recommendation}}
            </td>
        </tr>

        <tr>
            <td>勤務地：</td>
            <td> {{$send->workplace}} </td>
        </tr>

        <tr>
            <td>給与：</td>
            <td>
                {{$send->salary_low}} 万円 ~
                {{$send->salary_high}} 万円
            </td>
        </tr>

        <tr>
            <td>仕事内容：</td>
            <td>
                {{$send->contents}}
            </td>
        </tr>

        <tr>
            <td>雇用形態：</td>
            <td> {{$send->employment_status}} </td>
        </tr>

        <tr>
            <td>試用期間：</td>
            <td> {{$send->test_term}} </td>
        </tr>

        <tr>
            <td>賃金詳細：</td>
            <td> {{$send->salary_detail}} </td>
        </tr>

        <tr>
            <td>勤務時間：</td>
            <td> {{$send->working_time}} </td>
        </tr>

        <tr>
            <td>残業：</td>
            <td> {{$send->overtime}} </td>
        </tr>

        <tr>
            <td>残業手当：</td>
            <td> {{$send->overtime_pay}} </td>
        </tr>

        <tr>
            <td>社会保険：</td>
            <td> {{$send->insurance}} </td>
        </tr>

        <tr>
            <td>福利厚生：</td>
            <td> {{$send->welfare}} </td>
        </tr>

        <tr>
            <td>休日：</td>
            <td> {{$send->holiday}} </td>
        </tr>

        <tr>
            <td>選考内容：</td>
            <td> {{$send->selection_contents}} </td>
        </tr>

    </table>
    <a id="revise" href={{ $send->url . "/revise" }}>求人票を修正する</a>
    @if ($send->running == 1)
        <a id="stop" onclick="return confirm('掲載を停止します。宜しいですか？')" href={{ $send->url . "/stop" }} >求人票を掲載停止する</a>
    @else
        <a id="stop" onclick="return confirm('掲載を再開します。宜しいですか？')" href={{ $send->url . "/open" }} >求人票を掲載再開する</a>
    @endif
    <a onclick="return confirm('データを削除します。宜しいですか？')" href={{ $send->url . "/delete" }} >求人票を削除する</a>
@endsection
