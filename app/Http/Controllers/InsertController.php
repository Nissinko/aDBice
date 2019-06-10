<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicantsPost;
use App\Http\Requests\JobsPost;
use App\Job;
use App\Applicants;
use App\JobApp;
use App\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InsertController extends Controller
{
    public function confirm(JobsPost $request){
        $data = $request->all();

        return view('insert.confirm')->with($data);
    }

    public function store(Request $request){
        $job = new Job;
        $company = new Company;

        // カウントの情報を取得し、urlを作成する
        $newcount = DB::table('count')->value('count') + 1;
        $url = '/job/' . str_pad($newcount, 6, 0, STR_PAD_LEFT);
        $job->url = $url;

        $test = DB::table('company')->where('company', $request->company)->get();

        if(count($test) == 0){
            foreach (config('company_column') as $col){
                $company->$col = $request->$col;
            }
            $company->company_url = 'dummy';
            $company->save();

            $id = DB::table('company')->where('company', $request->company)->select('id')->get();
            $company_url = '/company/' . str_pad($id[0]->id, 6, 0, STR_PAD_LEFT);
            DB::table('company')->where('company', $request->company)
                ->update([
                    'company_url' => $company_url,
                ]);
        }

        foreach (config('job_column') as $col){
            $job->$col = $request->$col;
        }
        $date = new \DateTime();
        $job->day = $date->format('Y-m-d');

        // countのアップデート
        DB::table('count')->increment('count', 1);

        $job->save();

        return view('insert.finish');
    }

    public function rev_confirm(Request $request){
        $data = $request->all();

        return view('revise.confirm')->with($data);
    }

    public function rev_store(Request $request){
        $date = new \DateTime();
        $date = $date->format('Y-m-d');
        $update_array = array();

        foreach (config('job_column') as $col){
            $update_array[$col] = $request->$col;
        }
        $update_array['day'] = $date;

        DB::table('job')->where('url', $request->url)
            ->update($update_array);

        return view('revise.finish');
    }

    public function app_confirm(ApplicantsPost $request){
        $data = $request->all();

        return view('app_insert.confirm')->with($data);
    }

    public function app_store(Request $request){
        $applicants = new Applicants;

        foreach (config('app_column') as $column){
            $applicants->$column = $request->$column;
        }

        $applicants->url = '/dummy';
        $date = new \DateTime();
        $applicants->day = $date->format('Y-m-d');
        $applicants->gender = config('gender')[$request->gender];
        $applicants->prefecture = config('pref')[$request->prefecture];

        // countのアップデート

        $applicants->save();

        $id = DB::table('applicants')->where('name', $request->name)->select('id')->get();
        $url = '/users/' . str_pad($id[0]->id, 6, 0, STR_PAD_LEFT);

        DB::table('applicants')->where('name', $request->name)
            ->update([
                'url' => $url,
            ]);

        return view('app_insert.finish');
    }

    public function app_rev_confirm(Request $request){
        $data = $request->all();

        return view('app_revise.confirm')->with($data);
    }

    public function app_rev_store(Request $request){
        $date = new \DateTime();
        $date = $date->format('Y-m-d');
        $update_array = array();
        \Log::debug($request->job_class);

        foreach (config('app_column') as $col){
            $update_array[$col] = $request->$col;
        }
        $update_array['day'] = $date;
        $update_array['gender'] = config('gender')[$request->gender];
        $update_array['prefecture'] = config('pref')[$request->prefecture];

        DB::table('applicants')->where('url', $request->url)
            ->update($update_array);

        return view('app_revise.finish');
    }

    public function app_job_register(Request $request){
        $applicants = new Applicants;
        $job_app = new JobApp;
        $job = new Job;

        $data = $applicants->where('name', $request->name)->get();
        $redirected_url = $data[0]->url . '/selection';

        if ($request->job_url != ""){
            $piece = explode("/", $request->job_url);
            $job_url = "/job/" . end($piece);

            $check_job = $job->where('url', $job_url)->get();
            if (count($check_job) == 0){
                return abort(500, 'Job URL Error.');
            }

            $job_app->job_url = $job_url;
            $job_app->applicants_url = $data[0]->url;
            $job_app->status = 1;

            DB::table('statistics')->insert([
                'job_url' => $job_url,
                'applicants_url' => $data[0]->url,
                'before_status' => -1,
                'after_status' => 1
            ]);

            $job_app->save();

            return redirect($redirected_url);
        }
        else{
            $app_job_data = $job_app->where('applicants_url', $data[0]->url)->get();
            for ($i = 0; $i < count($app_job_data); $i++){
                $key = "status".$i;
                $id = $app_job_data[$i]->id;

                if ($request->$key != $app_job_data[$i]->status){
                    DB::table('job_app')->where('id', $id)
                        ->update([
                            'status' => $request->$key
                        ]);
                    DB::table('statistics')->insert([
                        'job_url' => $app_job_data[$i]->job_url,
                        'applicants_url' => $app_job_data[$i]->applicants_url,
                        'before_status' => $app_job_data[$i]->status,
                        'after_status' => $request->$key
                    ]);
                }
            }
            return redirect($redirected_url);
        }
    }

    public function memo_register(Request $request){
        $applicants = new Applicants;
        $job_app = new JobApp;
        $job = new Job;
        $memo = $request->memo;

        if ($request->tag == "user"){
            $data = $applicants->where('name', $request->name)->get();
            $target_url = $data[0]->url;
            $redirected_url = $target_url . '/selection';

            $memo_data = DB::table('memo')->where('target', $target_url)->get();

            if (count($memo_data) == 0){
                DB::table('memo')->insert([
                    'contents' => $memo,
                    'target' => $target_url
                ]);
            }
            else{
                DB::table('memo')->where('target', $target_url)->update([
                    'contents' => $memo
                ]);
            }

            return redirect($redirected_url);
        }
        if ($request->tag == "job"){
            $target_url = "/job/" . $request->name;
//            $data = $job->where('url', $target_url)->get();
            $redirected_url = "/job/" . $request->name . "/selection";

            $memo_data = DB::table('memo')->where('target', $target_url)->get();

            if (count($memo_data) == 0){
                DB::table('memo')->insert([
                    'contents' => $memo,
                    'target' => $target_url
                ]);
            }
            else{
                DB::table('memo')->where('target', $target_url)->update([
                    'contents' => $memo
                ]);
            }

            return redirect($redirected_url);
        }
    }
}
