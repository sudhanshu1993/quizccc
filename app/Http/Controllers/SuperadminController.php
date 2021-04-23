<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Student;
use App\category;
use App\Addquestion;
use App\Aexam;
use App\examsubject;
use response;
use Illuminate\Support\Facades\input;
use App\Http\Requests;

use Validator;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;


class SuperadminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:superadmin');
    }

    public function index()
    {
        $students_count = DB::table('users')->orderBy('created_at', 'DESC')->where('admin_id',Auth::user()->id)
                       ->get()->count();

        $exam_count = DB::table('exam')->orderBy('created_at', 'DESC')->where('admin_id',Auth::user()->id)
                          ->get()->count();              
        return view('superadmin',compact('students_count', 'exam_count'));
    }
    public function Logout(){
        auth()->logout();
    
        session()->flash('message', 'Some goodbye message');
    
        return redirect('superadmin/login');
      }
}
