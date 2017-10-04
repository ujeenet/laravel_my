@extends('layouts.proman')

@section('content')


    <div class="container-fluid well col-md-6 col-md-offset-3">
        <h1 class="text-center text-aqua well"> Your Profile Info</h1>
         <form method="post" action="/profile/update/{{Auth::id()}}">

             {{ csrf_field() }}

                    <div class="form-group">

                        <label for="name">Your Name</label>
                        <input id="name" name="name" type="text" class="form-control" value="{{Auth::user()->profile->name}}">

                    </div>

                    <div class="form-group">
                        <label for="middlename">Your Middlename</label>
                        <input id="middlename" name="middlename" type="text" class="form-control" value="{{Auth::user()->profile->middlename}}">
                    </div>

                    <div class="form-group">
                        <label for="lastname">Your Lastname</label>
                        <input id="lastname" name="lastname" type="text" class="form-control" value="{{Auth::user()->profile->lastname}}">
                    </div>

                    <div class="form-group">
                        <label for="title">Your Title</label>
                        <input id="title" name="title" type="text"  class="form-control" value="{{Auth::user()->profile->title}}">
                    </div>

                    <button type="submit" class="btn btn-success"> Update Profile Info </button>

            </div>
        </form>

    </div>






@endsection
