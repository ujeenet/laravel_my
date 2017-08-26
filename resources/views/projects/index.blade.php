@extends('layouts.proman')

@section('content')
    <projects-list :listbystatus="{{$status}}" inline-template>
        <div>
        <div class="container-fluid">
            <div class="box">
                <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Num.</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Duration</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Start</th>
                                    <th class="text-center">Finish</th>
                                    <th class="text-center">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="form in forms.data">
                                    <td>  @{{form.id}} </td>
                                    <td>
                                        <a :href="'/checkpoint/index/'+form.id" >@{{form.title}}</a>
                                    </td>
                                    <td>
                                        <select class="form-control text-sm" v-model="form.status">
                                            <option value="on_hold">On hold</option>
                                            <option value="in_process">In process</option>
                                            <option value="done">Finished</option>
                                        </select>
                                    </td>
                                    <td> @{{form.duration}} </td>
                                    <td> @{{form.type}} </td>
                                    <td>
                                        <input type="date" v-model="form.starts_at">
                                    </td>
                                    <td> @{{ form.finish }} </td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-primary" @click.prevent="projectUpdate(form.id)"><i class="fa fa-refresh"></i></a>
                                        <a href="#" class="btn btn-danger" @click.prevent="projectDelete(form.id)"><i class="fa fa-close"></i></a>
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
                </div>
    </projects-list>
@endsection