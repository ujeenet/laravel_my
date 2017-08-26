@extends ('layouts.proman')

@section('content')

    {{--<style type="text/css">--}}
        {{--th {--}}
            {{--font-size: x-small;--}}
            {{--width: auto;--}}
        {{--}--}}
        {{--td {--}}
            {{--font-size: x-small;--}}
            {{--width: auto;--}}
        {{--}--}}
    {{--</style>--}}

    <h1>Project name: {{$project->title}}</h1>
    <h3>Project id: {{$project->id}}</h3>
    <div class="container-fluid">
        <div class="row pull-right">
            <br class="pull-right">Created:{{$project->created_at}}</br>
            <br class="pull-right">Updated:{{$project->updated_at}}</br>
        </div>
    </div>
    <checkpoints-list :pid="{{$project->id}}" inline-template>
        <div class="container-fluid">
            <div class="box">
                <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center text-sm">Priority</th>
                                <th class="text-center text-sm">Title</th>
                                <th class="text-center text-sm" style="width: 55px">Duration</th>
                                <th class="text-center text-sm">Start</th>
                                <th class="text-center text-sm">Finish</th>
                                <th class="text-center text-sm">Status</th>
                                <th class="text-center text-sm">TeamMate</th>
                                <th class="text-center text-sm">Options</th>
                            </tr>
                        </thead>
                    <form>
                            <tr v-for="(form, index) in forms">
                                <td class="text-center">@{{ form.priority }}</td>
                                <td>
                                    <input class="text-center form-control text-sm" v-model="form.title" name="title" id="title">
                                </td>
                                <td class="text-center">
                                    <input class="text-center form-control text-sm"  v-model="form.estimated_duration" name="estimated_duration" id="estimated_duration">
                                </td>
                                <td class="text-center text-sm">@{{ convertTime(form.start_date) }}</td>
                                <td class="text-center text-sm">@{{ convertTime(form.finish_date) }}</td>
                                <td class="text-center text-sm">
                                    <select class="form-control text-sm" v-model="form.status">
                                        <option value="on_hold">On hold</option>
                                        <option value="in_process">In process</option>
                                        <option value="done">Finished</option>
                                    </select>
                                </td>
                                <td class="text-center text-sm">
                                    <select class="form-control text-sm" v-model="form.resource_id">
                                        <option v-for="resource in resources" v-bind:value="resource.id">@{{ resource.name }}</option>
                                    </select>
                                </td>
                                <td class="text-center text-sm">
                                    <div class="button-group">
                                        <a class="btn btn-success btn-sm"  href="#" @click.prevent="dragUp(index ,form)">
                                            <i class="fa fa-arrow-up"></i></a>
                                        <a class="btn btn-success btn-sm"  href="#" @click.prevent="dragDown(index, form)">
                                            <i class="fa fa-arrow-down"></i></a>
                                    <a class="btn btn-danger btn-sm"  href="#" @click.prevent="checkpointDelete(index, form, form.id)">
                                        <i class="fa fa-close"></i></a>
                                    </div>
                            </tr>

                                <td class="text-center text-sm" colspan="10"><a href="#" class="btn btn-success btn-lg" href="#" @click.prevent="sendForms()">
                                        <i class="fa fa-refresh"></i>Refresh checkpoint list</a></td>
                            </tr>
                            <tr>
                                <td class="text-center text-sm" colspan="2">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input input class="text-center form-control" type="text" v-model="checkpoint.title">
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center text-sm"  class="from-group">
                                        <label>Duration</label>
                                        <input input class="text-center form-control" type="text" v-model="checkpoint.estimated_duration">
                                    </div>
                                </td>
                                <td class="text-center" colspan="2">
                                    <div class="form-group text-sm">
                                        <label>Status</label>
                                        <select class="text-center form-control text-sm" v-model="checkpoint.status">
                                            <option value="on_hold">On hold</option>
                                            <option value="in_process">In process</option>
                                            <option value="done">Finished</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="text-center text-sm"  colspan="2" >
                                    <div class="form-group">
                                        <label>Teammate</label>
                                    <select class="text-center form-control" v-model="checkpoint.resource_id">
                                        <option v-for="resource in resources" v-bind:value="resource.id">@{{ resource.name }}</option>
                                    </select>
                                    </div>
                                </td>
                                <td class="text-center "colspan="6">
                                    <a href="#" class="btn btn-lg btn-success text-sm" @click.prevent="addCheckpoint()">
                                        <i class="fa fa-plus-square"></i>Add new checkpoint</a>
                                </td>
                            </tr>
                    </form>
                </table>
            </div>
        </div>
    </checkpoints-list>
@endsection