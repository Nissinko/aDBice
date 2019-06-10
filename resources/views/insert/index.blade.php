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
        height: 30px;
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
    li{
        color: red;
    }
    @foreach(config('job_column') as $jc)
        @if(count($errors->get($jc)) > 0)
            #{{$jc}} {
                border: medium solid red;
            }
        @endif
    @endforeach

</style>
@section('main')
    <h1>求人票入力画面</h1>
    <p>求人情報を入力して下さい</p>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(function(){
            $('#company_search').on('click', function(){
                var company = $('#company').val();
                var request = $.ajax({
                    type: 'GET',
                    url: '/company/search/' + company,
                    cache: false,
                    dataType: 'json',
                    timeout: 3000
                });

                /* 成功時 */
                request.done(function(data){
                    if (Object.keys(data).length == 0){
                        alert("企業は未登録です。名称を確認して下さい。")
                    }
                    else{
                        $('#comment').text(data[0]["comment"]);
                        $('#representative').text(data[0]["representative"]);
                        $('#main_place').text(data[0]["main_place"]);
                        $('#branch').text(data[0]["branch"]);
                        $('#sales').text(data[0]["sales"]);
                        $('#abstract').text(data[0]["abstract"]);
                        $('#stock_open').text(data[0]["stock_open"]);
                        $('#inner_ratio').text(data[0]["inner_ratio"]);
                        $('#stockholder').text(data[0]["stockholder"]);
                        $('#url').text(data[0]["url"]);
                        console.log(data);

                        alert("取得に成功しました");
                    }
                });

                /* 失敗時 */
                request.fail(function(){
                    alert("通信に失敗しました");
                });
            });
        });

        var w = ( screen.width-640 ) / 2;
        var h = ( screen.height-480 ) / 2;
        function disp(url){
            window.open(url, 'サブ検索画面', 'width=640,height=480'
                + ',left=' + w + ',top=' + h
            );
        }
    </script>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('insert.confirm') }}" method="post">
        <h2>企業詳細</h2>
        <dl>
            <dt>企業名：</dt>
            <dd>
                <input type="text" name="company" id="company" value="{{ old('company') }}">
                <button type="button" id="company_search">企業検索</button>
            </dd>
        </dl>

        <dl>
            <dt>コメント：</dt>
            <dd> <textarea name="comment" rows="4" cols="80" id="comment">{{ old('comment') }}</textarea> </dd>
        </dl>

        <dl>
            <dt>代表：</dt>
            <dd> <input type="text" name="representative" id="representative" value="{{ old('representative') }}"> </dd>
        </dl>

        <dl>
            <dt>所在地：</dt>
            <dd> <input type="text" name="main_place" id="main_place" value="{{ old('main_place') }}"> </dd>
        </dl>

        <dl>
            <dt>支社：</dt>
            <dd> <textarea name="branch" rows="2" cols="80" id="branch">{{ old('branch') }}</textarea> </dd>
        </dl>

        <dl>
            <dt>売上高：</dt>
            <dd> <input type="text" name="sales" id="sales" value="{{ old('sales') }}"> </dd>
        </dl>

        <dl>
            <dt>事業概要：</dt>
            <dd> <textarea name="abstract" rows="8" cols="80" id="abstract">{{ old('abstract') }}</textarea> </dd>
        </dl>

        <dl>
            <dt>株式公開：</dt>
            <dd> <input type="text" name="stock_open" id="stock_open" value="{{ old('stock_open') }}"> </dd>
        </dl>

        <dl>
            <dt>外資比率：</dt>
            <dd> <input type="text" name="inner_ratio" id="inner_ratio" value="{{ old('inner_ratio') }}"> </dd>
        </dl>

        <dl>
            <dt>主な株主：</dt>
            <dd> <textarea name="stockholder" rows="2" cols="80" id="stockholder">{{ old('stockholder') }}</textarea> </dd>
        </dl>

        <dl>
            <dt>URL：</dt>
            <dd> <input type="text" name="url" id="url" value="{{ old('url') }}"> </dd>
        </dl>

        <h2>求人詳細</h2>

        <dl>
            <dt>業種分類：</dt>
            <dd> <input type="text" name="gyoukai" id="gyoukai" value="{{ old('gyoukai') }}">
                <input name="GyoukaiSearchScreen" type="button" value="検索画面起動"
                       onClick='disp("/gyoukai_search?hope=0")' />
            </dd>
        </dl>

        <dl>
            <dt>職種分類：</dt>
            <dd> <input type="text" name="job_class" id="job_class" value="{{ old('job_class') }}">
                <input name="JobclassSearchScreen" type="button" value="検索画面起動"
                       onClick='disp("/job_class_search?hope=0")' />
            </dd>
        </dl>

        <dl>
            <dt>求人内容：</dt>
            <dd> <input type="text" name="title" id="title" value="{{ old('title') }}"></dd>
        </dl>

        <dl>
            <dt>仕事内容：</dt>
            <dd>
                <textarea name="contents" rows="8" cols="80">{{ old('contents') }}</textarea>
            </dd>
        </dl>

        <dl>
            <dt>必要なスキル・経験：</dt>
            <dd>
                <textarea name="necessary" rows="6" cols="80" id="necessary">{{ old('necessary') }}</textarea>
            </dd>
        </dl>

        <dl>
            <dt>歓迎スキル：</dt>
            <dd>
                <textarea name="recommendation" rows="6" cols="80" id="recommendation">{{ old('recommendation') }}</textarea>
            </dd>
        </dl>

        <dl>
            <dt>勤務地：</dt>
            <dd> <input type="text" name="workplace" id="workplace" value="{{ old('workplace') }}"> </dd>
        </dl>

        <dl>
            <dt>給与：</dt>
            <dd>
                <input type="text" name="salary_low" id="salary_low" value="{{ old('salary_low') }}"> 万円 ~
                <input type="text" name="salary_high" id="salary_high" value="{{ old('salary_high') }}"> 万円
            </dd>
        </dl>

        <dl>
            <dt>賃金詳細：</dt>
            <dd> <textarea name="salary_detail" rows="4" cols="80">{{ old('salary_detail') }}</textarea> </dd>
        </dl>

        <dl>
            <dt>雇用形態：</dt>
            <dd> <input type="text" name="employment_status" value="{{ old('employment_status') }}"> </dd>
        </dl>

        <dl>
            <dt>試用期間：</dt>
            <dd> <input type="text" name="test_term" value="{{ old('test_term') }}"> </dd>
        </dl>

        <dl>
            <dt>勤務時間：</dt>
            <dd> <textarea name="working_time" rows="2" cols="80">{{ old('working_time') }}</textarea> </dd>
        </dl>

        <dl>
            <dt>残業：</dt>
            <dd> <input type="text" name="overtime" value="{{ old('overtime') }}"> </dd>
        </dl>

        <dl>
            <dt>残業手当：</dt>
            <dd> <textarea name="overtime_pay" rows="2" cols="80">{{ old('overtime_pay') }}</textarea> </dd>
        </dl>

        <dl>
            <dt>社会保険：</dt>
            <dd> <textarea name="insurance" rows="2" cols="80">{{ old('insurance') }}</textarea> </dd>
        </dl>

        <dl>
            <dt>福利厚生：</dt>
            <dd> <textarea name="welfare" rows="2" cols="80">{{ old('welfare') }}</textarea> </dd>
        </dl>

        <dl>
            <dt>休日：</dt>
            <dd> <textarea name="holiday" rows="2" cols="80">{{ old('holiday') }}</textarea> </dd>
        </dl>

        <dl>
            <dt>選考内容：</dt>
            <dd> <textarea name="selection_contents" rows="2" cols="80">{{ old('selection_contents') }}</textarea> </dd>
        </dl>

        <div><input type="submit" name="button1" value="登録" /></div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
@endsection
