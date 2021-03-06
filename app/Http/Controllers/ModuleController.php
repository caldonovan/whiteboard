<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module;
use App\ModuleUser;
use DB;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = Module::orderBy('code', 'asc')->paginate(6);
        return view('modules.index')->with('modules', $modules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // TODO: Make sure only authenticated users have the ability to modify modules.
        return view('modules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'description' => 'required'
        ]);

        $module = new Module;
        $module->title = $request->input('code');
        $module->description = $request->input('description');
        $module->save();

        return redirect('/modules')->with('success', 'Module Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $module = Module::find($id);
        //$module_users = DB::table('module_user')->where('module_id', $id)->get()->toArray();
        //dd($module_users);
        //$users = DB::table('users')->where('user_id', '')->value('name');
        //dd($users);
        return view('modules.show')->with('module', $module);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module = Module::find($id);
        return view('modules.edit')->with('module', $module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // * This ensures the user actually writes something.
        $this->validate($request, [
            'code' => 'required',
            'description' => 'required'
        ]);

        // * Create the new post and save to the database
        $module = Module::find($id);
        $module->code = $request->input('code');
        $module->description = $request->input('description');
        $module->save();

        return redirect('/modules')->with('success', 'Module Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $module = Module::find($id);
        $module->delete();

        return redirect('/modules')->with('success', 'Module Removed');
    }
}
