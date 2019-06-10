@extends('layouts.master')

<style>
    dl { width:430px; }
    dt { float:left; }
    dd { margin-left:130px; }
    input[type="text"]:focus,
    texture:focus {
        box-shadow: 0 0 7px #3498db;
        border: 1px solid #3498db;
    }
    input[type="text"] {
        width: 200px;
        height: 25px;
        font-size: 10pt;
    }
    textarea{
        font-size: 10pt;
    }
    #company{
        width: 300px;
    }
    #main_place{
        width: 300px;
    }
    #gyoukai{
        width: 300px;
    }
    #job_class{
        width: 300px;
    }
    #workplace{
        width: 300px;
    }
    #sales{
        width: 300px;
    }
    #stock_open{
        width: 300px;
    }
    #stockholder{
        width: 300px;
    }
    #inner_ratio{
        width: 300px;
    }
    #title{
        width: 300px;
    }
    #salary_low{
        width: 100px;
    }
    #salary_high{
        width: 100px;
    }
    #url{
        width: 400px;
    }

</style>
<script type="text/javascript">
    var w = ( screen.width-640 ) / 2;
    var h = ( screen.height-480 ) / 2;
    function disp(url){
        window.open(url, 'サブ検索画面', 'width=640,height=480'
            + ',left=' + w + ',top=' + h
        );
    }
</script>
@section('main')
    <h1>求人票入力画面</h1>
    <p>求人情報を入力して下さい</p>

    <form action="{{ route('revise.confirm') }}" method="post">
        <dl>
            <dt>企業名：</dt>
            <dd> <input type="text" name="company" id="company" value={{$send->company}} /> </dd>
        </dl>

        <dl>
            <dt>コメント：</dt>
            <dd> <textarea name="comment" rows="4" cols="80">{{$send->comment}}</textarea> </dd>
        </dl>

        <dl>
            <dt>代表：</dt>
            <dd> <input type="text" name="representative" id="representative" value={{$send->representative}} > </dd>
        </dl>

        <dl>
            <dt>所在地：</dt>
            <dd> <input type="text" name="main_place" id="main_place" value={{$send->main_place}} > </dd>
        </dl>

        <dl>
            <dt>支社：</dt>
            <dd> <textarea name="branch" rows="2" cols="80">{{$send->branch}}</textarea> </dd>
        </dl>

        <dl>
            <dt>売上高：</dt>
            <dd> <input type="text" name="sales" id="sales" value={{$send->sales}} > </dd>
        </dl>

        <dl>
            <dt>事業概要：</dt>
            <dd> <textarea name="abstract" rows="8" cols="80" id="abstract">{{$send->abstract}}</textarea> </dd>
        </dl>

        <dl>
            <dt>株式公開：</dt>
            <dd> <input type="text" name="stock_open" id="stock_open" value={{$send->stock_open}} > </dd>
        </dl>

        <dl>
            <dt>外資比率：</dt>
            <dd> <input type="text" name="inner_ratio" id="inner_ratio" value={{$send->inner_ratio}} > </dd>
        </dl>

        <dl>
            <dt>主な株主：</dt>
            <dd> <textarea name="stockholder" rows="2" cols="80" id="stockholder">{{$send->stockholder}}</textarea> </dd>
        </dl>

        <dl>
            <dt>URL：</dt>
            <dd> <input type="text" name="url" id="url" value={{$send->company_url}} > </dd>
        </dl>

        <h2>求人詳細</h2>

        <dl>
            <dt>業種分類：</dt>
            <dd> <input type="text" name="gyoukai" id="gyoukai" value={{$send->gyoukai}} >
                <input name="GyoukaiSearchScreen" type="button" value="検索画面起動"
                       onClick='disp("/gyoukai_search?hope=0")' />
            </dd>
        </dl>

        <dl>
            <dt>職種分類：</dt>
            <dd> <input type="text" name="job_class" id="job_class" value={{$send->job_class}} >
                <input name="JobclassSearchScreen" type="button" value="検索画面起動"
                       onClick='disp("/job_class_search?hope=0")' />
            </dd>
        </dl>

        <dl>
            <dt>求人内容：</dt>
            <dd> <input type="text" name="title" id="title" value={{$send->title}} > </dd>
        </dl>

        <dl>
            <dt>仕事内容：</dt>
            <dd>
                <textarea name="contents" rows="8" cols="80">{{$send->contents}}</textarea>
            </dd>
        </dl>

        <dl>
            <dt>必要なスキル・経験：</dt>
            <dd>
                <textarea name="necessary" rows="6" cols="80" id="necessary">{{$send->necessary}}</textarea>
            </dd>
        </dl>

        <dl>
            <dt>歓迎スキル：</dt>
            <dd>
                <textarea name="recommendation" rows="6" cols="80">{{$send->recommendation}}</textarea>
            </dd>
        </dl>

        <dl>
            <dt>勤務地：</dt>
            <dd> <input type="text" name="workplace" id="workplace" value={{$send->workplace}} > </dd>
        </dl>

        <dl>
            <dt>給与：</dt>
            <dd>
                <input type="text" name="salary_low" id="salary_low" value={{$send->salary_low}} > 万円 ~
                <input type="text" name="salary_high" id="salary_high" value={{$send->salary_high}} > 万円
            </dd>
        </dl>

        <dl>
            <dt>賃金詳細：</dt>
            <dd> <textarea name="salary_detail" rows="4" cols="80">{{$send->salary_detail}}</textarea> </dd>
        </dl>

        <dl>
            <dt>雇用形態：</dt>
            <dd> <input type="text" name="employment_status" value={{$send->employment_status}} > </dd>
        </dl>

        <dl>
            <dt>試用期間：</dt>
            <dd> <input type="text" name="test_term" value={{$send->test_term}} > </dd>
        </dl>

        <dl>
            <dt>勤務時間：</dt>
            <dd> <textarea name="working_time" rows="2" cols="80">{{$send->working_time}}</textarea> </dd>
        </dl>

        <dl>
            <dt>残業：</dt>
            <dd> <input type="text" name="overtime" value={{$send->overtime}} > </dd>
        </dl>

        <dl>
            <dt>残業手当：</dt>
            <dd> <textarea name="overtime_pay" rows="2" cols="80">{{$send->overtime_pay}}</textarea> </dd>
        </dl>

        <dl>
            <dt>社会保険：</dt>
            <dd> <textarea name="insurance" rows="2" cols="80">{{$send->insurance}}</textarea> </dd>
        </dl>

        <dl>
            <dt>福利厚生：</dt>
            <dd> <textarea name="welfare" rows="2" cols="80">{{$send->welfare}}</textarea> </dd>
        </dl>

        <dl>
            <dt>休日：</dt>
            <dd> <textarea name="holiday" rows="2" cols="80">{{$send->holiday}}</textarea> </dd>
        </dl>

        <dl>
            <dt>選考内容：</dt>
            <dd> <textarea name="selection_contents" rows="2" cols="80">{{$send->selection_contents}}</textarea> </dd>
        </dl>

        <div><input type="submit" name="button1" value="登録" /></div>
        <input type="hidden" name="url" value="{{ $send->url }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
@endsection
