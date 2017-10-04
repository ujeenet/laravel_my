@extends('layouts.proman')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if (Auth::check())
                        <h4 class="text-center text-aqua"><a href="/profile">Hello Awesome {{ Auth::user()->profile->name}}. Nice to see you!!!</a></h4>
                    @else
                     <h4 class="text-center">You are not logged in!</h4>
                      <h1 class="text-center">  <a href="/login">Please login using your e-mail and password</a></h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if(Auth::check())

    <div class="form-group has-error">
        <div class="container-fluid well">
            <div class="row">
                <div class="col-md-12">
                    <div class="container">
                        <div class="col-md-4 ">
                            <h3 class="text-aqua text-center">My Team Projects</h3>
                            <ul class="well">
                                <div  class="form-group ">
                                    <a  href="/project/index/0">
                                        <li class="btn btn-default" style="width: 200px;">
                                            All Projects
                                        </li>
                                    </a>
                                    <strong class="pull-right">{{$all}}</strong>
                                </div>
                                <div class="form-group">
                                    <a href="/project/listall/1">
                                        <li class="btn btn-default" style="width: 200px;">
                                             Active Projects
                                        </li>
                                    </a>
                                    <strong class="pull-right">{{$active}}</strong>
                                </div>
                                <div class="form-group">
                                    <a href="/project/listall/2">
                                        <li class="btn btn-default" style="width: 200px;">
                                            Projects Pending
                                        </li>
                                    </a>
                                    <strong class="pull-right">{{$on_hold}}</strong>
                                </div>
                                <div class="form-group">
                                    <a  href="/project/listall/3">
                                    <li class="btn btn-default"  style="width: 200px;">
                                            Projects Finished
                                        </li>
                                    </a>
                                    <strong class="pull-right">{{$done}}</strong>
                                </div>
                            </ul>
                    </div>
                    <div class="col-md-4">
                        <h3 class="text-aqua text-center"><a href="/resource/index">My Great Team</a></h3>
                        <ul class="messages-menu">
                            @foreach($resources as $resource)

                            <li>
                                <a href="resource/{id}">{{$resource->name}} {{$resource->middlename}} {{$resource->lastname}} </a>
                            </li>

                                @endforeach
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h3 class="text-aqua text-center"><a href="calendar/list">Today is</h3>
                        <ul>
<li>
    day and date
</li>
                        <li>
                full date
                        </li>
closest critical tasks to check
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
