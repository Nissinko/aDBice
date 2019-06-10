<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job';
    // protected $fillable = ['gyoukai', 'class', 'company', 'necessary', 'recommendation', 'salary', 'contents'];
}

class Applicants extends Model
{
    protected $table = 'applicants';
}

class JobApp extends Model
{
    protected $table = 'job_app';
}

class Company extends Model
{
    protected $table = 'company';
}

class Tableinfo
{
    public static $JobColumns = ['業界', '職種分類', '企業名', '職種', '必須条件', '年収', '業務内容'];
}

class Appinfo
{
    public static $AppColumns = ['氏名', '所属企業', '職種', '年齢', '学歴', '都道府県', '選考状況', '登録日'];
}

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

