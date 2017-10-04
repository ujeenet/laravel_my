@extends('layouts.proman')

@section('content')

    <projects-list :listbystatus="{{$status}}" inline-template>
        <div>
        <div class="container-fluid">
            <div class="box">
                <table class="table table-striped table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>Num.</th>
                                    <th style="width: 30%;">Title</th>
                                    <th>Status</th>
                                    <th>Duration</th>
                                    <th>Type</th>
                                    <th>Start</th>
                                    <th>Finish</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(form, index) in forms.data">
                                    <td>  @{{form.id}} </td>
                                    <td>
                                        <a :href="'/checkpoint/index/'+form.id" >@{{form.title}}</a>
                                    </td>
                                    <td style="width: 120px;">
                                        <select class="form-control text-sm" v-model="form.status">
                                            <option value="on_hold">On hold</option>
                                            <option value="in_process">In process</option>
                                            <option value="done">Finished</option>
                                        </select>
                                    </td>
                                    <td> @{{form.duration}} </td>
                                    <td> @{{form.type}} </td>
                                    <td style="width: 100px;">
                                        <input class="form-control" type="date" v-model="form.starts_at">
                                    </td>
                                    <td> @{{ form.finish }} </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-primary btn-sm" @click.prevent="updateProject(form.id, form.status)"><i class="fa fa-refresh"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm" @click.prevent="discardProject(form.id , index)"><i class="fa fa-close"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                </table>
            </div>
                </div>
                    <div class="text-center">
                            <ul class="pagination pagination-sm">
                                <li> <a href="#" @click.prevent="prevPage()">Prev</a></li>
                                <li v-for="num in forms.last_page"><a href="#" @click.prevent="getPage(num)">@{{ num }}</a></li>
                                <li> <a href="#" @click.prevent="nextPage()">Next</a></li>
                            </ul>
                    </div>
            <div class="container-fluid">
                                                                {{--COLLAPSED BOX--}}
                    <div class="box box-primary collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{__('Add Project')}}</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn box-tool btn-primary" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                                                                {{--COLLAPSED BOX-DATA--}}
                            <form>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="project.title">Project title</label>
                                            <input class="text form-control" v-model="project.title">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="project.status">Status</label>
                                            <select class="form-control" v-model="project.status">
                                                <option selected value="in_process">In process</option>
                                                <option value="on_hold">On hold </option>
                                                <option value="done">Done</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="project.type">Type</label>
                                            <select class="form-control" v-model="project.type">
                                                 <option selected value="new">New equipment</option>
                                                 <option value="experimental">Experimental</option>
                                                 <option value="upgrade">Upgrade</option>
                                                 <option value="fix">Fix</option>
                                                 <option value="schedule">Schedule</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="project.starts_at">Project Starts</label>
                                            <input class="form-control" type="date" v-model="project.starts_at">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="container-fluid">
                                                <div class="form-group">
                                                    <label for="project.description">Project Description</label>
                                                    <textarea class="text form-control" v-model="project.description"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" >
                                        <div class="text-center" >
                                            <a type="button" class="btn btn-primary btn-lg "  @click.prevent="addProject()">Add Project</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            {{--COLLAPSED BOX-DATA - END--}}
                        </div>
                      </div>
                    </div>

                    <div class="container-fluid">
                            <div class="box box-primary collapsed-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Projects Onhold</h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn box-tool btn-primary" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                        </div>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Num.</th>
                                            <th>Title</th>
                                            <th style="width: 30%;">Status</th>
                                            <th>Duration</th>
                                            <th>Type</th>
                                            <th>Start</th>
                                            <th>Finish</th>
                                            <th>Options</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(form, index) in formsOnhold">
                                            <td>  @{{form.id}} </td>
                                            <td>
                                                <a :href="'/checkpoint/index/'+form.id" >@{{form.title}}</a>
                                            </td>
                                            <td style="width: 120px;">
                                                <select class="form-control text-sm" v-model="form.status">
                                                    <option value="on_hold">On hold</option>
                                                    <option value="in_process">In process</option>
                                                    <option value="done">Finished</option>
                                                </select>
                                            </td>
                                            <td> @{{form.duration}} </td>
                                            <td> @{{form.type}} </td>
                                            <td style="width: 100px;">
                                                <input class="form-control" type="date" v-model="form.starts_at">
                                            </td>
                                            <td> @{{ form.finish }} </td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-primary btn-sm" @click.prevent="updateProject(form.id, form.status)"><i class="fa fa-refresh"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" @click.prevent="deleteProject(form.id , index)"><i class="fa fa-close"></i></a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                    <div class="container-fluid">
                            <div class="box box-primary collapsed-box">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Finished Projects</h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn box-tool btn-primary" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                            </div>
                                     </div>
                                    <div class="box-body">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Num.</th>
                                                <th style="width: 30%;">Title</th>
                                                <th>Status</th>
                                                <th>Duration</th>
                                                <th>Type</th>
                                                <th>Start</th>
                                                <th>Finish</th>
                                                <th>Options</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(form, index) in formsDone">
                                                <td>  @{{form.id}} </td>
                                                <td>
                                                    <a :href="'/checkpoint/index/'+form.id" >@{{form.title}}</a>
                                                </td>
                                                <td style="width: 120px;">
                                                    <select class="form-control text-sm" v-model="form.status">
                                                        <option value="in_process">In process</option>
                                                        <option value="on_hold">On hold</option>
                                                        <option value="done">Finished</option>
                                                    </select>
                                                </td>
                                                <td> @{{form.duration}} </td>
                                                <td> @{{form.type}} </td>
                                                <td style="width: 100px;">
                                                    <input class="form-control" type="date" v-model="form.starts_at">
                                                </td>
                                                <td> @{{ form.finish }} </td>
                                                <td class="text-center">
                                                    <a href="#" class="btn btn-primary btn-sm" @click.prevent="updateProject(form.id, form.status)"><i class="fa fa-refresh"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm" @click.prevent="deleteProject(form.id , index)"><i class="fa fa-close"></i></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                            </div>
                    </div>
            @if (Auth::user()->is_admin == 'admin')
            <div class="container-fluid">
                <div class="box box-primary collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Discarded Projects</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn box-tool btn-primary" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Num.</th>
                                <th style="width: 30%;">Title</th>
                                <th>Status</th>
                                <th>Duration</th>
                                <th>Type</th>
                                <th>Start</th>
                                <th>Finish</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(form, index) in formsDiscard">
                                <td>  @{{form.id}} </td>
                                <td>
                                    <a :href="'/checkpoint/index/'+form.id" >@{{form.title}}</a>
                                </td>
                                <td style="width: 120px;">
                                    <select class="form-control text-sm" v-model="form.status">
                                        <option value="in_process">In process</option>
                                        <option value="on_hold">On hold</option>
                                        <option value="done">Finished</option>
                                        <option value="discard">Discarded</option>
                                    </select>
                                </td>
                                <td> @{{form.duration}} </td>
                                <td> @{{form.type}} </td>
                                <td style="width: 100px;">
                                    <input class="form-control" type="date" v-model="form.starts_at">
                                </td>
                                <td> @{{ form.finish }} </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-primary btn-sm" @click.prevent="updateProject(form.id, form.status)"><i class="fa fa-refresh"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm" @click.prevent="deleteProject(form.id , index)"><i class="fa fa-close"></i></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </projects-list>
@endsection