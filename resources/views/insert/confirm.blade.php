@extends('layouts.master')

<style>
    dl { width:700px; }
    dt { float:left; }
    dd { margin-left:0px; }
    dd { color: #636b6f; }
</style>

@section('main')
    <h1>求人票確認画面</h1>
    <p>入力内容を確認し、送信を推して下さい</p>

    <form action="{{ route('insert.finish') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @foreach (config('company_column') as $col)
            <input type="hidden" name={{$col}} value="{{$$col}}">
        @endforeach

        @foreach (config('job_column') as $col)
            <input type="hidden" name={{$col}} value="{{$$col}}">
        @endforeach

        <h2>企業詳細</h2>
        <dl>
            <dt>企業名：</dt>
            <dd> {{ $company }} </dd>
        </dl>
        <br>
        <dl>
            <dt>コメント：</dt>
            <dd> {{ $comment }} </dd>
        </dl>
        <br>
        <dl>
            <dt>代表：</dt>
            <dd> {{ $representative }} </dd>
        </dl>
        <br>
        <dl>
            <dt>所在地：</dt>
            <dd> {{$main_place}} </dd>
        </dl>
        <br>
        <dl>
            <dt>支社：</dt>
            <dd> {{$branch}} </dd>
        </dl>
        <br>
        <dl>
            <dt>売上高：</dt>
            <dd> {{$sales}} </dd>
        </dl>
        <br>
        <dl>
            <dt>事業概要：</dt>
            <dd> {{$abstract}} </dd>
        </dl>
        <br>
        <dl>
            <dt>株式公開：</dt>
            <dd> {{$stock_open}} </dd>
        </dl>
        <br>
        <dl>
            <dt>外資比率：</dt>
            <dd> {{$inner_ratio}} </dd>
        </dl>
        <br>
        <dl>
            <dt>主な株主：</dt>
            <dd> {{$stockholder}} </dd>
        </dl>
        <br>
        <dl>
            <dt>URL：</dt>
            <dd> {{$url}} </dd>
        </dl>
        <br>
        <h2>求人詳細</h2>

        <dl>
            <dt>業種分類：</dt>
            <dd> {{$gyoukai}} </dd>
        </dl>
        <br>
        <dl>
            <dt>職種分類：</dt>
            <dd> {{$job_class}} </dd>
        </dl>
        <br>
        <dl>
            <dt>求人内容：</dt>
            <dd> {{$title}} </dd>
        </dl>
        <br>
        <dl>
            <dt>仕事内容：</dt>
            <dd>
                {{$contents}}
            </dd>
        </dl>
        <br>
        <dl>
            <dt>必要なスキル・経験：</dt>
            <dd>
                {{$necessary}}
            </dd>
        </dl>
        <br>
        <dl>
            <dt>歓迎スキル：</dt>
            <dd>
                {{$recommendation}}
            </dd>
        </dl>
        <br>
        <dl>
            <dt>勤務地：</dt>
            <dd> {{$workplace}} </dd>
        </dl>
        <br>
        <dl>
            <dt>給与：</dt>
            <dd>
                {{$salary_low}} 万円 ~
                {{$salary_high}} 万円
            </dd>
        </dl>
        <br>
        <dl>
            <dt>賃金詳細：</dt>
            <dd> {{$salary_detail}} </dd>
        </dl>
        <br>
        <dl>
            <dt>雇用形態：</dt>
            <dd> {{$employment_status}} </dd>
        </dl>
        <br>
        <dl>
            <dt>試用期間：</dt>
            <dd> {{$test_term}} </dd>
        </dl>
        <br>
        <dl>
            <dt>勤務時間：</dt>
            <dd> {{$working_time}} </dd>
        </dl>
        <br>
        <dl>
            <dt>残業：</dt>
            <dd> {{$overtime}} </dd>
        </dl>
        <br>
        <dl>
            <dt>残業手当：</dt>
            <dd> {{$overtime_pay}} </dd>
        </dl>
        <br>
        <dl>
            <dt>社会保険：</dt>
            <dd> {{$insurance}} </dd>
        </dl>
        <br>
        <dl>
            <dt>福利厚生：</dt>
            <dd> {{$welfare}} </dd>
        </dl>
        <br>
        <dl>
            <dt>休日：</dt>
            <dd> {{$holiday}} </dd>
        </dl>
        <br>
        <dl>
            <dt>選考内容：</dt>
            <dd> {{$selection_contents}} </dd>
        </dl>
        <br>

        <div><input type="submit" name="button1" value="送信" /></div>
    </form>
@endsection
