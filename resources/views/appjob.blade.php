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
    input[type="text"]:focus,
    texture:focus {
        box-shadow: 0 0 7px #3498db;
        border: 1px solid #3498db;
    }
    input[type="text"] {
        width: 300px;
        height: 25px;
        font-size: 10pt;
        /*margin-top: 30px;*/
    }
    div {
        margin-top: 10px;
    }
    h2 {
        color: #444444;
        font-size: 23px;
    }

    select {
        width: 130px;
        height: 30px;
        font-size: 12px;
    }
    textarea{
        font-size: 10pt;
    }

    /*.clickable{*/
        /*cursor : pointer;*/
    /*}*/

    /*.clickable:hover{*/
        /*background: #dae0e5;*/
    /*}*/

    p.right{
        /*text-align: right;*/
        /*margin-right: 200px;*/
        font-size: 20px;
    }

</style>

@section('main')
    <h1>{{ $name }}さんの応募中求人</h1>
    <table border="1">
        <thead>
        <tr>
            <th>企業名</th>
            <th>職種名</th>
            <th>求める能力・スキル</th>
            <th>年収</th>
            <th>ステータス</th>
            <th>選考結果日</th>
        </tr>
        </thead>
        <tbody>
        <form action="{{ route('app_job.register') }}" method="post">
        <!-- {{ $i = 0 }} -->
        @foreach ($send as $job)
            <tr>
                <td width="10%">{{ $job['jobdata']->company }}</td>
                <td width="10%">{{ $job['jobdata']->job_class }}</td>
                <td width="20%">{{ $job['jobdata']->necessary }}</td>
                <td width="10%">{{ $job['jobdata']->salary_low }}万円~{{ $job['jobdata']->salary_high }}万円</td>
                <td width="10%">
                    <select name={{ "status".$i }}>
                        <option value=1 {{ $job['status'] == 1 ? 'selected' : "" }}>応募意思確認中</option>
                        <option value=2 {{ $job['status'] == 2 ? 'selected' : "" }}>推薦結果待ち</option>
                        <option value=3 {{ $job['status'] == 3 ? 'selected' : "" }}>一次面接結果待ち</option>
                        <option value=4 {{ $job['status'] == 4 ? 'selected' : "" }}>二次面接結果待ち</option>
                        <option value=5 {{ $job['status'] == 5 ? 'selected' : "" }}>最終面接結果待ち</option>
                        <option value=6 {{ $job['status'] == 6 ? 'selected' : "" }}>内定</option>
                        <option value=0 {{ $job['status'] == 0 ? 'selected' : "" }}>選考落ち</option>
                        <option value=-1 {{ $job['status'] == -1 ? 'selected' : "" }}>辞退</option>
                    </select>
                </td>
                <td width="14%">{{ $job['date'] }}</td>
            </tr>
        <!-- {{ $i = $i + 1 }} -->
        @endforeach
        </tbody>
    </table>

    <h2>応募求人の登録・修正</h2>
        <input type="text" name="job_url" placeholder="登録求人のURLを入力して下さい。"/>
        <input type="hidden" name="name" value="{{ $name }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div><input type="submit" name="button1" value="登録" onClick="alert('登録しました！');" /></div>
    </form>
    <p class="right">
        <a href={{ $url }}>応募者詳細</a>
    </p>
    <form id="form_memo" action="{{route('memo.register')}}" method="post">
        <textarea id="memo" name="memo" cols="100" rows="8" maxlength="100" placeholder="メモ">{{$memo}}</textarea>
        <input type="hidden" name="name" value="{{ $name }}">
        <input type="hidden" name="tag" value="user">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div>
            <input type="submit" name="button2" value="更新" onClick="alert('メモを更新しました！');">
        </div>
    </form>


@endsection
