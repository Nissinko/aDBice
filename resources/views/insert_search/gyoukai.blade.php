<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <style>
        html{
            font-family: 'Nunito', sans-serif;
        }
        h2{
            color: #3d4852;
            margin-top: 0px;
        }
        #big_area {
            box-sizing: border-box;
            /*position: fixed;*/
            top: 50px;
            z-index: 99;
            display: block;
            width: 240px;
            height: 100%;
            min-height: 100%;
            margin-right: 30px;
            float: left;
        }
        #big_area ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        #big_area table{
            width: 100%;
        }

        #big_area table tbody tr td {
            position: relative;
            box-sizing: border-box;
            border-bottom: 1px solid #e6eaef;
            width: 100%;
            height: 32px;
            /*text-indent: 48px;*/
            display: block;
            line-height: 32px;
            color: #3d4852;
            font-size: 15px;
            text-align: center;
            font-weight: bold;
        }

        #middle_area table tbody tr td {
            position: relative;
            box-sizing: border-box;
            border-bottom: 1px solid #e6eaef;
            width: 100%;
            height: 32px;
            /*text-indent: 48px;*/
            display: block;
            line-height: 26px;
            color: #1f6fb2;
            font-size: 15px;
            text-align: center;
            font-weight: bold;
        }
        .clickable{
            cursor : pointer;
        }
        .clickable:hover{
            background: #dae0e5;
        }
        #middle_area {
            box-sizing: border-box;
            /*position: fixed;*/
            top: 50px;
            z-index: 99;
            display: block;
            width: 100%;
            height: 100%;
            min-height: 100%;
            /*margin-right: 30px;*/
            margin-left: 100px;
            /*float: left;*/
        }

    </style>
    <!-- {{$php_json = json_encode(config('gyoukai'))}} -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        var parantExistanceFlag = true;

        var js_array = JSON.parse('<?php echo $php_json; ?>');
        var big_class = Object.keys(js_array).length;

        var param = '<?php echo $hope; ?>';

        function reset(){
            for (let j=0; j<big_class; j++){
                document.getElementById('middle' + j).style.display = "none";
            }
        }

        for (let i=0; i<big_class; i++){
            $(function(){
                $('#big' + i).addClass('clickable').on('click', function(){
                    reset();
                    $('#middle' + i).css("display", "block");
                });
            });
        }

        let i = 0;
        for (let key in js_array){
            let j = 0;
            for (let val of js_array[key]){
                $(document).on('click','#middle' + i + ' > tr:nth-child(' + (j+1) + ')' , function(){
                    if ( !window.opener || !Object.keys(window.opener).length ) {
                        window.alert('親画面が存在しません');
                        parantExistanceFlag = false;
                    }
                    if(parantExistanceFlag) {
                        if (param == 0){
                            window.opener.document.getElementById('gyoukai').value = key + " > " + val;
                        }
                        else{
                            window.opener.document.getElementById('hope_gyoukai').value = key + " > " + val;
                        }
                        window.close();
                    }
                });
                j++;
            }
            i++;
        }

    </script>
</head>
<body>
    <h2>業界を選択</h2>
    <div id = "big_area">
        <table>
            <tbody id="big_table">
                @foreach(array_keys(config('gyoukai')) as $i => $key)
                    <tr id={{"big".$i}} class="clickable">
                        <td>{{$key}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="middle_area">
        <div id="middle_table">
        @foreach(array_keys(config('gyoukai')) as $i => $key)
            <table>
                <tbody id={{"middle".$i}} style="display:none;">
                @foreach(config('gyoukai')[$key] as $j => $val)
                    <tr class="clickable">
                        <td>{{$val}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endforeach
        </div>
    </div>
</body>
</html>
