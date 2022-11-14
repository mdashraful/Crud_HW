<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test() {
        $student = DB::select('select * from students where name=?', ['Md.Ashraful Islam']);

        dd($student);
    }
}
