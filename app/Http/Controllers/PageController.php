<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {

        return view('pages.index');
    }

    public function modules() {
        $data = array(
            'user_id' => '1',
            'modules' => ['CSM1', 'CSM2', 'CSM3']
        );
        return view('pages.modules')->with($data);
    }
}
