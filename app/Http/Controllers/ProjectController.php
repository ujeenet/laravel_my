<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $status=null )
    {
        $view = view ('projects.index', compact('status'));

        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $data=$request->project;

        $project=Project::create([
           'user_id'=> Auth::id(),
           'title'=>$data['title'],
            'description'=>$data['description'],
           'type'=>$data['type'],
           'status'=>$data['status'],
           'starts_at'=>$data['starts_at'],

           ]);
       if ($project){
           return "success";
       }else{
           return "go to hell bitch";
       };

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */    public function listall ($parameter = 0)
    {

        if ($parameter == 0)
        {
            $projects = Auth::user()->projects()->orderBy('created_at', 'ASC')->paginate(5);
        }
        elseif ($parameter == 1)
        {
           $projects = Auth::user()->projects()->where('status','in_process')->orderBy('created_at', 'ASC')->paginate(10);
        }
        elseif ($parameter == 2)
        {
           $projects = Auth::user()->projects()->where('status','on_hold')->orderBy('created_at', 'ASC')->paginate(10);
        }
        elseif ($parameter == 3)
        {
           $projects = Auth::user()->projects()->where('status','done')->orderBy('created_at', 'ASC')->paginate(10);
        }

      return $projects;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        echo $id;

        if ($destroy = Project::destroy($id)) {

            return "Project Successfully Deleted";
        }else{
            return "Project Was not Deleted";
        }

    }
}
