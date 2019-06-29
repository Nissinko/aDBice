<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Job;
use App\Applicants;
use App\JobApp;
use App\Tableinfo;
use App\Appinfo;
use App\Company;
use App\Http\Controllers\EachjobController;
use App\Http\Controllers\SearchControler;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

Route::get('/', function () {
    return view('welcome');
});

// 権限ユーザーのみ
Route::group(['middleware' => ['auth', 'can:admin-higher']], function () {

    Route::get('/jobs', function(Request $request){
        $word = $request->input('word');
        $job_class = $request->input('job_class');
        $running = $request->input('running', 1);
        $query = Job::query();
        $datas = $query
            ->where(function($q) use ($word) {
                $q->where('company', 'LIKE', "%$word%")
                    ->orwhere('necessary', 'LIKE', "%$word%")
                    ->orwhere('contents', 'LIKE', "%$word%")
                    ->orwhere('recommendation', 'LIKE', "%$word%");
        })
            ->where('job_class', 'LIKE', "%$job_class%")
            ->where('running', $running)
            ->paginate(10);

        $params = array();
        if ($word){
            $params['word'] = $word;
        }
        if ($job_class){
            $params['job_class'] = $job_class;
        }

        return view('job', [
            'datas'=>$datas,
            'JobColumns'=>Tableinfo::$JobColumns,
            'params'=>$params
        ]);
    });

    Route::get('/company', function(){
        $company = Company::all();
        $job = new Job;
        $job_app = new JobApp;

        $datas = array();

        foreach ($company as $com){
            $data = array();
            $name = $com->company;
            $data['name'] = $name;
            $data['url'] = $com->company_url;
            $com_job = $job->where('company', $name)->where('running', 1)->get();
            $data['newdate'] = $job->where('company', $name)->max('day');
            $data['job_num'] = count($com_job);

            $data['doc_submit'] = 0;
            $data['interview'] = 0;
            $data['offer'] = 0;

            foreach ($com_job as $cj){
                $job_url = $cj->url;
                $data['doc_submit'] += count($job_app->where('job_url', $job_url)->where('status', '>=', 2)->get());
                $data['interview'] += count($job_app->where('job_url', $job_url)->where('status', '>=', 3)->get());
                $data['offer'] += count($job_app->where('job_url', $job_url)->where('status', '>=', 6)->get());
            }

            array_push($datas, $data);
        }

        return view('company', [
            'datas'=>$datas
        ]);
    });

    Route::get('/company/{num}', function($num){
        $url = '/company/' . $num;
        $company = new Company;
        $job = new Job;
        $job_app = new JobApp;
        $com = $company->where('company_url', $url)->get();
        $name = $com[0]->company;

        $send = $job->where('company', $name)->get();

        $status_array = array();
        $num_to_status = array('選考落ち', '応募意思確認中', '推薦結果待ち', '一次面接結果待ち', '二次面接結果待ち', '最終面接結果待ち', '内定');

        foreach ($send as $user){
            $url = $user->url;
            if (count($job_app->where('job_url', $url)->get()) == 0){
                array_push($status_array, '未応募');
            }
            else{
                $num = $job_app->where('job_url', $url)->max('status');
                if ($num >= 0){
                    $status = $num_to_status[$num];
                }
                else{
                    $status = '辞退';
                }
                array_push($status_array, $status);
            }
        }

        return view('companyjob', [
            'send'=>$send,
            'name'=>$name,
            'status_array'=>$status_array
        ]);
    });

    Route::get('/insert', function(){
        return view('insert.index');
    });

    Route::post('/insert/confirm', [
        'uses' => 'InsertController@confirm',
        'as' => 'insert.confirm'
    ]);

    Route::post('/insert/finish', [
        'uses' => 'InsertController@store',
        'as' => 'insert.finish'
    ]);

    Route::get('/job/{num}', function($num){
        $url = '/job/' . $num;
        $job = new Job;
        $company = new Company;
        $data = $job->where('url', $url)->get();
        $send = $data[0];
        $comdata = $company->where('company', $send->company)->get();
        return view('eachjob', [
            'send'=>$send,
            'company'=>$comdata[0],
            'num'=>$num
        ]);
    });

    Route::get('/job/{num}/delete', function($num){
        $url = '/job/' . $num;
        $job = new Job;
        $data = $job->where('url', $url)->delete();
        return view('delete.delete');
    });

    Route::get('/job/{num}/stop', function($num){
        $url = '/job/' . $num;
        $job = new Job;
        $job->where('url', $url)->update(['running' => 0]);
        return redirect($url);
    });

    Route::get('/job/{num}/open', function($num){
        $url = '/job/' . $num;
        $job = new Job;
        $job->where('url', $url)->update(['running' => 1]);
        return redirect($url);
    });

    Route::get('/job/{num}/revise', function($num){
        $url = '/job/' . $num;
        $job = new Job;
        $data = $job->where('url', $url)->get();
        $send = $data[0];
        return view('revise.index', [
            'send'=>$send
        ]);
    });

    Route::get('/users/{num}/revise', function($num){
        $url = '/users/' . $num;
        $applicants = new Applicants;
        $data = $applicants->where('url', $url)->get();
        $send = $data[0];
        return view('app_revise.index', [
            'send'=>$send
        ]);
    });

    Route::get('/users/{num}/delete', function($num){
        $url = '/users/' . $num;
        $applicants = new Applicants;
        $data = $applicants->where('url', $url)->delete();
        DB::table('jobapp')->where('applicants_url', $url)->delete();
        return view('delete.delete');
    });

    Route::post('/revise/confirm', [
        'uses' => 'InsertController@rev_confirm',
        'as' => 'revise.confirm'
    ]);

    Route::post('/revise/finish', [
        'uses' => 'InsertController@rev_store',
        'as' => 'revise.finish'
    ]);

    Route::post('/app_revise/confirm', [
        'uses' => 'InsertController@app_rev_confirm',
        'as' => 'app_revise.confirm'
    ]);

    Route::post('/app_revise/finish', [
        'uses' => 'InsertController@app_rev_store',
        'as' => 'app_revise.finish'
    ]);

    Route::get('/users', function(Request $request){
        $name = $request->input('name');
        $query = Applicants::query();
        $term = $request->input('term');
        $startDate = new DateTime('2019-02-01');
        $endDate = new DateTime();

        $params = array();
        if ($name){
            $params['name'] = $name;
        }
        if ($term){
            $params['term'] = $term;
        }

        if ($term == 1){
            $startDate = new DateTime('first day of this month');
        }
        elseif ($term == 2){
            $startDate = new DateTime('first day of last month');
            $endDate = new DateTime('last day of last month');
        }
        elseif ($term == 3){
            $startmonthdate = new DateTime('first day of this month');
            $startDate = $startmonthdate->modify('-3 months');
        }

        $datas = $query
            ->where('name', 'LIKE', "%$name%")
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $job_app = new JobApp;

        $status_array = array();
        $num_to_status = array('選考落ち', '応募意思確認中', '推薦結果待ち', '一次面接結果待ち', '二次面接結果待ち', '最終面接結果待ち', '内定');

        foreach ($datas as $user){
            $url = $user->url;
            if (count($job_app->where('applicants_url', $url)->get()) == 0){
                array_push($status_array, '未応募');
            }
            else{
                $num = $job_app->where('applicants_url', $url)->max('status');
                if ($num >= 0){
                    $status = $num_to_status[$num];
                }
                else{
                    $status = '辞退';
                }
                array_push($status_array, $status);
            }
        }

        return view('applicants', [
            'datas'=>$datas,
            'AppColumns'=>Appinfo::$AppColumns,
            'status_array'=>$status_array,
            'params'=>$params
        ]);
    });

    Route::get('/app_insert', function(){
        return view('app_insert.index');
    });

    Route::post('/app_insert/confirm', [
        'uses' => 'InsertController@app_confirm',
        'as' => 'app_insert.confirm'
    ]);

    Route::post('/app_insert/finish', [
        'uses' => 'InsertController@app_store',
        'as' => 'app_insert.finish'
    ]);

    Route::post('/app_job/register', [
        'uses' => 'InsertController@app_job_register',
        'as' => 'app_job.register'
    ]);

    Route::get('/users/{num}', function($num){
        $url = '/users/' . $num;
        $applicants = new Applicants;
        $job_app = new JobApp;
        $data = $applicants->where('url', $url)->get();
        $send = $data[0];
        $status = $job_app->where('applicants_url', $url)->max('status');

        return view('eachapp', [
            'send'=>$send,
            'status'=>$status
        ]);
    });

    Route::get('/users/{num}/selection', function($num){
        $url = '/users/' . $num;
        $job_app = new JobApp;
        $jobdb = new Job;
        $applicants = new Applicants;
        $datas = $job_app->where('applicants_url', $url)->get();
        $name = $applicants->where('url', $url)->get();
        $send = array();
        foreach ($datas as $job) {
            $job_url = $job->job_url;
            $jobdata = $jobdb->where('url', $job_url)->get();
            array_push($send, array(
                "status" => $job->status,
                "jobdata" => $jobdata[0],
                "date" => $job->updated_at->format('Y-m-d')
            ));
        }

        $tmp = DB::table('memo')->where('target', $url)->get();
        if (count($tmp) != 0){
            $memo = $tmp[0]->contents;
        }
        else{
            $memo = null;
        }

        return view('appjob', [
            'send'=>$send,
            'name'=>$name[0]->name,
            'url'=>$url,
            'memo'=>$memo
        ]);
    });

    Route::get('/job/{num}/selection', function($num){
        $url = '/job/' . $num;
        $job_app = new JobApp;
        $jobdb = new Job;
        $applicants = new Applicants;
        $datas = $job_app->where('job_url', $url)->get();
//        $name = $jobdb->where('url', $url)->get();
        $send = array();
        foreach ($datas as $user) {
            $user_url = $user->applicants_url;
            $userdata = $applicants->where('url', $user_url)->get();
            array_push($send, array(
                "status" => $user->status,
                "userdata" => $userdata[0],
                "date" => $user->updated_at->format('Y-m-d')
            ));
        }

        $tmp = DB::table('memo')->where('target', $url)->get();
        if (count($tmp) != 0){
            $memo = $tmp[0]->contents;
        }
        else{
            $memo = null;
        }

        return view('jobapp', [
            'send'=>$send,
            'num'=>$num,
            'memo'=>$memo
        ]);
    });

    Route::get('/company/search/{name}', 'SearchControler@getCompanyByName');

    // CSVダウンロード
    Route::get('/job/{num}/csv', function($num) {
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'. $num . '.csv"',
        );

        return new StreamedResponse(
            function () use ($num){
                $url = '/job/' . $num;
                $tocsv = DB::table('job')
                    ->leftjoin('company', 'job.company', '=', 'company.company')
                    ->where('job.url', $url)->get()->toArray();

                $stream = fopen('php://output', 'w');
                foreach ($tocsv as $t) {
                    fputcsv($stream, (array)$t);
                }
            },200,
            $headers
        );
    });

    Route::get('/gyoukai_search', function(Request $request){
        return view('insert_search.gyoukai', ['hope' => $request->hope]);
    });

    Route::get('/job_class_search', function(Request $request){
        return view('insert_search.job_class', ['hope' => $request->hope]);
    });

    Route::get('/statistics', function(Request $request){
        $req_month = $request->input('month');
        $data_start = new DateTime('2019-02-01'); // リリース日
        $month_list = [];

        while ($data_start < new DateTime()){
            array_push($month_list, $data_start->format('Ym'));
            $data_start->modify('+1 months');
        }

        if ($req_month == null){
            return view('stats', ['month'=>'None', 'view'=>false, 'month_list'=>$month_list]);
        }
        else{
            $month = substr((string) $req_month, 4, 6);
            $year = substr((string) $req_month, 0, 4);
            $date_string = $year . "-" . $month . "-01";
            $send_month = $year . "年" . $month . "月";
            $init_date = new DateTime($date_string);
            $last_date = clone $init_date;
            $last_date->modify('+1 months');
            // 紹介案件数
            $introduce_count = DB::table('statistics')->where('updated_at', '>=', $init_date)->where('updated_at', '<', $last_date)
                ->where('after_status', 1)->count();
            $introduce_raw = DB::table('statistics')->where('updated_at', '>', $init_date)->where('updated_at', '<', $last_date)
                ->where('after_status', 1)->select('applicants_url')->distinct()->get();
            $introduce_person = count($introduce_raw);

            $introduce_per_person = $introduce_person == 0 ? 0.0 : $introduce_count / $introduce_person;
            $introduce_per_person = round($introduce_per_person, 2);

            // 書類提出数
            $submit_count = DB::table('statistics')->where('updated_at', '>', $init_date)->where('updated_at', '<', $last_date)
                ->where('after_status', 2)->count();
            $submit_rate = $introduce_count == 0 ? 0.0 : round($submit_count*100.0 / $introduce_count);

            // 一次面接設定数
            $first_interview_count = DB::table('statistics')->where('updated_at', '>', $init_date)->where('updated_at', '<', $last_date)
                ->where('after_status', 3)->count();
            $pass_document_rate = $submit_count == 0 ? 0.0 : round($first_interview_count*100.0 / $submit_count);

            //最終面接設定数
            $last_interview_count = DB::table('statistics')->where('updated_at', '>', $init_date)->where('updated_at', '<', $last_date)
                ->where('after_status', 5)->count();

            // 内定数
            $offer_count = DB::table('statistics')->where('updated_at', '>', $init_date)->where('updated_at', '<', $last_date)
                ->where('after_status', 6)->count();

            return view('stats', ['send_month'=>$send_month,
                'view'=>true, 'month_list'=>$month_list,
                'introduce_count'=>$introduce_count,
                'introduce_person'=>$introduce_person,
                'introduce_per_person'=>$introduce_per_person,
                'submit_count'=>$submit_count,
                'submit_rate'=>$submit_rate,
                'first_interview_count'=>$first_interview_count,
                'pass_document_rate'=>$pass_document_rate,
                'last_interview_count'=>$last_interview_count,
                'offer_count'=>$offer_count]);
        }
    });

    Route::post('/memo/register', [
        'uses' => 'InsertController@memo_register',
        'as' => 'memo.register'
    ]);

    // PDFのアップロード
    Route::get('/job/{num}/upload', function($num){
        return view('upload', ['num'=>$num]);
    });
    Route::post('/upload', [
        'uses' => 'UploadController@store',
        'as' => 'job.upload'
    ]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
