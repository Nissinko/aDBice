<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>求人票入力画面</title>
    <style>
        html{
            font-family: 'Nunito', sans-serif;
        }

        header {
            background: linear-gradient(90deg, #1f6fb2, #98e1b7);
            height: 60px;
            top : 0;
            left: 0;
            width: 100%;
            position:fixed;
        }
        header a{
            margin-left: 30px;
            text-align: left;
            margin-top: 8px;
            color: rgb(255,255,255);
            /*font-weight: 900;*/
            font-size: 35px;
            text-decoration: none;
        }
        #main_container{
            margin-top: 70px;
            /*font-family: "YuGothic","Yu Gothic","Meiryo","ヒラギノ角ゴ","sans-serif";*/
            /*font-family: 'Nunito', sans-serif;*/
            margin-left: 210px;

        }
        #manager_area_l {
            box-sizing: border-box;
            position: fixed;
            top: 60px;
            z-index: 99;
            display: block;
            width: 180px;
            height: 100%;
            min-height: 100%;
            margin-right: 30px;
            border-right: 1px solid #d7dada;
            border-left: 0px solid #d7dada;
            background: #f5f7f9;
            float: left;
        }

        #manager_area_l ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        #manager_area_l ul li {
            position: relative;
            box-sizing: border-box;
            border-bottom: 1px solid #e6eaef;
            width: 100%;
            height: 64px;
            /*text-indent: 48px;*/
            display: block;
            line-height: 64px;
            color: #ffffff;
            font-size: 18px;
            text-align: center;
            font-weight: bold;
        }

        #manager_area_l ul li a {
            text-align: center;
            text-decoration: none;
            color: #3d4852;
        }

        #manager_area_l ul li a:visited {
            color: #3d4852;
        }

        h1 {
            color: #444444;
            font-size: 30px;
        }

        input[type="submit"]{
            font-size: 16px;
            height: 30px;
        }

        /*paginatestyle*/
        .pagination{display:-webkit-box;display:-ms-flexbox;display:flex;padding-left:0;list-style:none;border-radius:.25rem}
        .page-link{position:relative;display:block;padding:.5rem .75rem;margin-left:-1px;line-height:1.25;color:#3490dc;background-color:#fff;border:1px solid #dee2e6}
        .page-link:hover{z-index:2;color:#1d68a7;text-decoration:none;background-color:#e9ecef;border-color:#dee2e6}
        .page-link:focus{z-index:2;outline:0;-webkit-box-shadow:0 0 0 .2rem rgba(52,144,220,.25);box-shadow:0 0 0 .2rem rgba(52,144,220,.25)}
        .page-link:not(:disabled):not(.disabled){cursor:pointer}
        .page-item:first-child .page-link{margin-left:0;border-top-left-radius:.25rem;border-bottom-left-radius:.25rem}
        .page-item:last-child .page-link{border-top-right-radius:.25rem;border-bottom-right-radius:.25rem}
        .page-item.active .page-link{z-index:1;color:#fff;background-color:#3490dc;border-color:#3490dc}
        .page-item.disabled .page-link{color:#6c757d;pointer-events:none;cursor:auto;background-color:#fff;border-color:#dee2e6}
        .pagination-lg .page-link{padding:.75rem 1.5rem;font-size:1.125rem;line-height:1.5}
        .pagination-lg .page-item:first-child .page-link{border-top-left-radius:.3rem;border-bottom-left-radius:.3rem}
        .pagination-lg .page-item:last-child .page-link{border-top-right-radius:.3rem;border-bottom-right-radius:.3rem}
        .pagination-sm .page-link{padding:.25rem .5rem;font-size:.7875rem;line-height:1.5}
        .pagination-sm .page-item:first-child .page-link{border-top-left-radius:.2rem;border-bottom-left-radius:.2rem}
        .pagination-sm .page-item:last-child .page-link{border-top-right-radius:.2rem;border-bottom-right-radius:.2rem}

        @yield('css_append')
    </style>
</head>
<body>
<header>
    <a href="/">aDBice Agent</a>
</header>

    <div id="manager_area">
        <nav id="manager_area_l">
            <ul>
                {{--<li class="manager_area_top">--}}
                    {{--<a href="/">トップ</a>--}}
                {{--</li>--}}
                <li class="manager_area_job">
                    <a href="/jobs">求人一覧</a>
                </li>
                <li class="manager_area_company">
                    <a href="/company">企業一覧</a>
                </li>
                <li class="manager_area_insert">
                    <a href="/insert">求人情報の入力</a>
                </li>
                <li class="manager_area_user">
                    <a href="/users">応募者一覧</a>
                </li>
                <li class="manager_area_user">
                    <a href="/app_insert">応募者情報の入力</a>
                </li>
                <li class="manager_area_stats">
                    <a href="/statistics">統計情報</a>
                </li>
            </ul>
        </nav>
    </div>
    <div id="main_container">
        @yield('main')
    </div>
</body>
</html>
