@extends ('layouts.proman')

@section('content')

                                                  {{--Project details--}}


    <div class="container-fluid">
        <h3>Project id: {{$project->id}} Project name: {{$project->title}}</h3>

        <div class="row pull-right">
            <br class="pull-right"> Created: {{$project->created_at}}</br>
            <br class="pull-right"> Updated: {{$project->updated_at}}</br>
            <br class="pull-right"> Started: {{$project->starts_at}}</br>
        </div>
    </div>

                                                {{--Actrive Checkpoints List--}}

    <checkpoints-list :pid="{{$project->id}}" inline-template>
        <div class="container-fluid">
            <div class="box">
                <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 50px;">Priority</th>
                                <th>Title</th>
                                <th style="width: 50px;">Duration</th>
                                <th>Start</th>
                                <th>Finish</th>
                                <th style="width: 120px;">Status</th>
                                <th style="width: 200px;">TeamMate</th>
                                <th style="width: 150px">Options</th>
                            </tr>
                        </thead>
                    <form>
                            <tr v-for="(form, index) in forms">
                                <td class="text-center">@{{ form.priority }}</td>
                                <td>
                                    <input class="form-control"  v-model="form.title" name="title" id="title">
                                </td>
                                <td>
                                    <input class="form-control"  v-model="form.estimated_duration" name="estimated_duration" id="estimated_duration">
                                </td>
                                <td>@{{ convertTime(form.start_date) }}</td>
                                <td>@{{ convertTime(form.finish_date) }}</td>
                                <td>
                                    <select class="form-control" v-model="form.status">
                                        <option value="on_hold">On hold</option>
                                        <option value="in_process">In process</option>
                                        <option value="done">Finished</option>
                                    </select>
                                </td>
                                <td >
                                    <select class="form-control" v-model="form.resource_id">
                                        <option v-for="resource in resources" v-bind:value="resource.id">@{{ resource.name }}</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="button-group">
                                        <a class="btn btn-success btn-xs"  href="#" @click.prevent="dragUp(index ,form)">
                                            <i class="fa fa-arrow-up"></i></a>
                                        <a class="btn btn-success btn-xs"  href="#" @click.prevent="dragDown(index, form)">
                                            <i class="fa fa-arrow-down"></i></a>
                                    <a class="btn btn-primary btn-xs"  href="#" @click.prevent="checkpointUpdate(index, form, form.id)">
                                        <i class="fa fa-refresh"></i></a>
                                    <a class="btn btn-danger btn-xs"  href="#" @click.prevent="checkpointDelete(index, form, form.id)">
                                        <i class="fa fa-close"></i></a>
                                    </div>
                            </tr>
                                <td colspan="8"><a href="#" class="btn btn-success btn-lg" href="#" @click.prevent="sendForms()">
                                        <i class="fa fa-refresh"></i>Refresh checkpoint list</a></td>
                            </tr>
                            <tr>

                                <td colspan="2">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input class="form-control" type="text" v-model="checkpoint.title">
                                    </div>
                                </td>
                                <td>
                                    <div  class="from-group">
                                        <label>Duration</label>
                                        <input  class="form-control" type="text" v-model="checkpoint.estimated_duration">
                                    </div>
                                </td>
                                <td c colspan="2">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="text-center form-control text-sm" v-model="checkpoint.status">
                                            <option value="on_hold">On hold</option>
                                            <option value="in_process">In process</option>
                                            <option value="done">Finished</option>
                                        </select>
                                    </div>
                                </td>
                                <td  colspan="2" >
                                    <div class="form-group">
                                        <label>Teammate</label>
                                    <select class="text-center form-control" v-model="checkpoint.resource_id">
                                        <option v-for="resource in resources" v-bind:value="resource.id">@{{ resource.name }}</option>
                                    </select>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-lg btn-success text-sm" @click.prevent="addCheckpoint()">
                                        Add new <br> checkpoint</a>
                                </td>
                            </tr>

                    </form>
                </table>

                                                        {{--Checkpoints On hold List--}}

            </div>
                <div class="container-fluid>">
                    <div class="box box-primary collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Checkpoints On Hold </h3>
                            <div class="box-tools pull-right">
                                <a class="btn btn-primary btn-sm" data-widget="collapse">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table trable-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th style="width: 50px;">Duration</th>
                                    <th>Started</th>
                                    <th>Finished</th>
                                    <th>Status</th>
                                    <th style="width: 200px;">TeamMate</th>
                                    <th style="width: 150px">Options</th>
                                </tr>

                                </thead>
                                <tbody>
                                    <tr v-for="(form, index) in formsOnhold">
                                        <td>@{{ form.title }}</td>
                                        <td>@{{ form.duration }}</td>
                                        <th>@{{ form.start_date }}</th>
                                        <th>
                                            <select class="form-control" v-model="form.status">
                                                <option value="on_hold">On hold</option>
                                                <option value="in_process">In process</option>
                                                <option value="done">Finished</option>
                                            </select>
                                        </th>
                                        <td>@{{ form.finish_date }}</td>
                                        <td>@{{ form.resource_id }}</td>
                                        <td>Options</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                                            {{--Checkpoints DoneList--}}

            <div class="container-fluid>">
                <div class="box box-primary collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Checkpoints Done</h3>
                        <div class="box-tools pull-right">
                            <a class="btn btn-primary btn-sm" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table trable-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th style="width: 50px;">Duration</th>
                                <th>Started</th>
                                <th>Finished</th>
                                <th>Status</th>
                                <th style="width: 200px;">TeamMate</th>
                                <th style="width: 150px">Options</th>
                            </tr>

                            </thead>
                            <tbody>
                            <tr v-for="(form, index) in formsDone">
                                <td>@{{ form.title }}</td>
                                <td>@{{ form.duration }}</td>
                                <th>@{{ form.start_date }}</th>
                                <th>
                                    <select class="form-control" v-model="form.status">
                                        <option value="on_hold">On hold</option>
                                        <option value="in_process">In process</option>
                                        <option value="done">Finished</option>
                                    </select>
                                </th>
                                <td>@{{ form.finish_date }}</td>
                                <td>@{{ form.resource_id }}</td>
                                <td>Options</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </checkpoints-list>
@endsection