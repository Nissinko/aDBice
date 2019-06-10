@extends('layouts.master')

<style>
    dl { width:430px; }
    dt { float:left; }
    dd { margin-left:150px; }
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

    select {
        width: 100px;
        height: 30px;
        font-size: 12px;
    }
    #age {
        width: 100px;
    }
    #company{
        width: 300px;
    }
    #education{
        width: 300px;
    }
    #gyoukai{
        width: 300px;
    }
    #job_class{
        width: 300px;
    }
    #hope_gyoukai{
        width: 300px;
    }
    #hope_job_class{
        width: 300px;
    }
    #salary{
        width: 100px;
    }
    #mail{
        width: 300px;
    }
    #company_num{
        width: 100px;
    }
    li{
        color: red;
    }
    @foreach(config('app_column') as $ac)
        @if(count($errors->get($ac)) > 0)
            #{{$ac}} {
                border: medium solid red;
            }
        @endif
    @endforeach

</style>
<script type ="text/javascript">
    var w = ( screen.width-640 ) / 2;
    var h = ( screen.height-480 ) / 2;
    function disp(url){
        window.open(url, 'サブ検索画面', 'width=640,height=480'
            + ',left=' + w + ',top=' + h
        );
    }

</script>
@section('main')
    <h1>応募者入力画面</h1>
    <p>応募者情報を入力して下さい</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('app_insert.confirm') }}" method="post">
        <dl>
            <dt>氏名（漢字）：</dt>
            <dd> <input type="text" name="name" value="{{ old('name') }}" id="name"> </dd>
        </dl>

        <dl>
            <dt>氏名（フリガナ）：</dt>
            <dd> <input type="text" name="furigana" value="{{ old('furigana') }}" id="furigana"> </dd>
        </dl>

        <dl>
            <dt>年齢：</dt>
            <dd> <input type="text" name="age" id="age" value="{{ old('age') }}"> </dd>
        </dl>

        <dl>
            <dt>都道府県：</dt>
                <dd>
                    <select name="prefecture">
                        @foreach(config('pref') as $index => $name)
                            <option value="{{ $index }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </dd>
        </dl>

        <dl>
            <dt>性別：</dt>
                <dd>
                    <select name="gender">
                        @foreach(config('gender') as $index => $name)
                            <option value="{{ $index }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </dd>
        </dl>

        <dl>
            <dt>電話番号：</dt>
            <dd> <input type="text" name="phone" value="{{ old('phone') }}" id="phone"> </dd>
        </dl>

        <dl>
            <dt>メールアドレス：</dt>
            <dd> <input type="text" name="mail" id="mail" value="{{ old('mail') }}"> </dd>
        </dl>

        <dl>
            <dt>現勤務会社：</dt>
            <dd> <input type="text" name="company" id="company" value="{{ old('company') }}"> </dd>
        </dl>

        <dl>
            <dt>経験社数：</dt>
            <dd> <input type="text" name="company_num" id="company_num" value="{{ old('company_num') }}"> </dd>
        </dl>

        <dl>
            <dt>学歴：</dt>
            <dd> <input type="text" name="education" id="education" value="{{ old('education') }}"> </dd>
        </dl>

        <dl>
            <dt>職種：</dt>
            <dd> <input type="text" name="job_class" id="job_class" value="{{ old('job_class') }}" >
            <input name="JobclassSearchScreen" type="button" value="検索画面起動"
                   onClick='disp("/job_class_search?hope=0")' />
            </dd>
        </dl>

        <dl>
            <dt>業界：</dt>
            <dd> <input type="text" name="gyoukai" id="gyoukai" value="{{ old('gyoukai') }}">
            <input name="GyoukaiSearchScreen" type="button" value="検索画面起動"
                   onClick='disp("/gyoukai_search?hope=0")' />
            </dd>
        </dl>

        <dl>
            <dt>年収：</dt>
            <dd> <input type="text" name="salary" id="salary" value="{{ old('salary') }}">万円 </dd>
        </dl>

        <dl>
            <dt>希望勤務地：</dt>
            <dd> <input type="text" name="hope_place" value="{{ old('hope_place') }}" id="hope_place"> </dd>
        </dl>

        <dl>
            <dt>希望業種：</dt>
            <dd> <input type="text" name="hope_gyoukai" value="{{ old('hope_gyoukai') }}" id="hope_gyoukai">
                <input name="HopeGyoukaiSearchScreen" type="button" value="検索画面起動"
                       onClick='disp("/gyoukai_search?hope=1")' />
            </dd>
        </dl>

        <dl>
            <dt>希望職種：</dt>
            <dd> <input type="text" name="hope_job_class" value="{{ old('hope_job_class') }}" id="hope_job_class">
                <input name="HopeJobclassSearchScreen" type="button" value="検索画面起動"
                       onClick='disp("/job_class_search?hope=1")' />
            </dd>
        </dl>

        <dl>
            <dt>学校詳細情報：</dt>
            <dd>
                <textarea name="education_detail" rows="8" cols="80">{{ old('education_detail') }}</textarea>
            </dd>
        </dl>

        <dl>
            <dt>スキル/資格：</dt>
            <dd>
                <textarea name="skill" rows="8" cols="80">{{ old('skill') }}</textarea>
            </dd>
        </dl>

        <dl>
            <dt>職務概要：</dt>
            <dd>
                <textarea name="shokumu_abst" rows="8" cols="80">{{ old('shokumu_abst') }}</textarea>
            </dd>
        </dl>

        <dl>
            <dt>自己PR：</dt>
            <dd>
                <textarea name="PR" rows="8" cols="80">{{ old('PR') }}</textarea>
            </dd>
        </dl>

        <dl>
            <dt>志望動機：</dt>
            <dd>
                <textarea name="motivation" rows="8" cols="80">{{ old('motivation') }}</textarea>
            </dd>
        </dl>

        <div><input type="submit" name="button1" value="登録" /></div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
@endsection
