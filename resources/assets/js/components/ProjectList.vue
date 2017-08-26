<script>
    export default {
        props: ['listbystatus']
        ,
        data: function () {
            return {
                project: {
                    title: "",
                    status: "",
                    estimated_duration: "",
                    resource_id: "",
                    priority:"",
                },
                resources:[],
                status:"",
                forms: {
                }
            }
        },
        methods:{
            getProjects: function (link){
                axios.get(link).then(function(response){
                    console.log(link);
                    this.forms = response.data;
                }.bind(this)).catch(function(errors){
                    console.log(errors);
                });
            },
            prevPage: function () {
                if (this.forms.prev_page_url !=null) {
                    this.getProjects(this.forms.prev_page_url);
                }
                },
            nextPage: function () {
                if (this.forms.next_page_url !=null) {
                    this.getProjects(this.forms.next_page_url);
                }
                },
            getPage: function (num){
                this.getProjects("http://laravel.my/project/listall/"+this.listbystatus+"?page="+num);
                },
            getResourceList: function () {
                axios.get('/resource/listall').then(function(response){
                    this.resources = response.data;
                }.bind(this)).catch(function (errors) {
                    console.log(errors);
                });
            },
            updateProject: function(pid){
                axios.post('/project/update/'+ pid, )
            },
            deleteProject: function (id ,form, checkpointid){
                axios.delete('/project/delete/'+form.id).then(function(response)
                {
                    this.forms.splice(id, 1);
                    this.forms.forEach(function(item, i, arr)
                    {
                        item.priority=i+1;
                    });
                    this.sendForms();
                }.bind(this));

            },
            sendForms: function () {
                axios.post('/checkpoint/update', {forms:this.forms}).then(function()
                {
                    this.estimateDates();

                }.bind(this)).catch(function(errors){
                    console.log(errors);
                });

            },
            addProject: function () {
                axios.post("/project/create", { "checkpoint": this.project}).then(function(response)
                {
                    this.forms.push({
                        'id': response.data.id,
                        'title': response.data.title,
                        'estimated_duration': response.data.estimated_duration,
                        'status': response.data.status,
                        'project_id': response.data.project_id,
                        'created_at': response.data.created_at,
                        'updated_at': response.data.updated_at,
                        'resource_id': response.data.resource_id,
                    });
                    this.forms.forEach(function(item, i, arr){
                        item.priority=i+1;
                    });
                    this.estimateDates();
                }.bind(this));
            },
            estimateDates: function () {
                axios.get('/checkpoint/estimate/' + this.pid).then(function (response) {

                    this.forms = response.data;
                    this.forms.sort(function (a, b) {
                        return a.priority - b.priority;
                    });
                }.bind(this)).catch(function (errors) {
                    console.log(errors);
                });
            },
            convertTime:function (timestamp){

                var d = new Date(timestamp*1000);

                var curr_date = d.getDate();

                var curr_month = d.getMonth() + 1;

                var curr_year = d.getFullYear();

                return (curr_year + "-" + curr_month + "-" + curr_date);

            }
        },
        created: function (){
            this.getProjects("/project/listall/"+this.listbystatus);
            this.getResourceList();
        }
    }
</script>