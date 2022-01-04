<template>
    <div class="card card-success card-outline">
        <div class="card-header">
            <h3 class="card-title">Service Charter List</h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                    <li class="nav-item mr-1">
                        <button class="btn btn-success" @click="createMode"><i class="fas fa-plus-circle fa-fw"></i>Add New
                        </button>
                    </li>
                </ul>
            </div>

        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr class="bg-success">
                    <th>#</th>
                    <th>Institution</th>
                    <th>Service</th>
                    <th>Requirements</th>
                    <th>Cost</th>
                    <th>Timeline</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th style="min-width: 100px;">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="servicecharter in servicecharters">
                    <td>{{ servicecharter.id }}</td>
                    <td>{{ servicecharter.scinstitution.name }}</td>
                    <td>{{ servicecharter.service }}</td>
                    <td>{{ servicecharter.requirements }}</td>
                    <td>{{ servicecharter.cost }}</td>
                    <td>{{ servicecharter.timeline }}</td>
                    <td>{{ servicecharter.created_at | myDate}}</td>
                    <td>{{ servicecharter.updated_at | myDate}}</td>
                    <td>
                        <a href="" class="btn btn-sm btn-warning" @click.prevent="editServiceCharter(servicecharter)"><i
                            class="fa fa-edit fa-fw"></i> </a>
                        <a href="" class="btn btn-sm btn-danger" @click.prevent="deleteServiceCharter(servicecharter.id)"><i
                            class="fa fa-trash fa-fw"></i> </a>
                    </td>
                </tr>
                </tbody>
            </table>
            <loading :loading="loading"></loading>

            <!--modal -->
            <div class="modal fade" id="createServiceCharter" tabindex="-1" role="dialog"
                 aria-labelledby="ceateServiceCharterModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createServiceCharterModalLabel" v-show="!editMode">Create
                                Service Charter</h5>
                            <h5 class="modal-title" id="createServiceCharterModalLabel" v-show="editMode">Update
                                Service Charter </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editMode ? update() : save()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Institution</label>
                                    <select name="scinstitution_id" id="scinstitution_id" v-model="form.scinstitution_id" class="form-control"
                                            :class="{'is-invalid':form.errors.has('scinstitution_id')}">
                                        <option value="" disabled>Please select the institution</option>
                                        <option v-for="scinstitution in scinstitutions" :value="scinstitution.id">{{ scinstitution.name }}</option>
                                    </select>
                                    <div v-if="form.errors.has('scinstitution_id')" v-html="form.errors.get('scinstitution_id')"></div>
                                </div>
                                <div class="form-group">
                                    <label>Service</label>
                                    <input type="text" name="service" v-model="form.service" id="service"
                                           class="form-control" :class="{'is-invalid':form.errors.has('service')}">
                                    <div v-if="form.errors.has('service')" v-html="form.errors.get('service')"/>
                                </div>
                                <div class="form-group">
                                    <label>Requirements</label>
                                    <input type="text" name="requirements" v-model="form.requirements" id="requirements"
                                           class="form-control" :class="{'is-invalid':form.errors.has('requirements')}">
                                    <div v-if="form.errors.has('requirements')" v-html="form.errors.get('requirements')"/>
                                </div>
                                <div class="form-group">
                                    <label>Cost</label>
                                    <input type="text" name="cost" v-model="form.cost" id="cost"
                                           class="form-control" :class="{'is-invalid':form.errors.has('cost')}">
                                    <div v-if="form.errors.has('cost')" v-html="form.errors.get('cost')"/>
                                </div>
                                <div class="form-group">
                                    <label>Timeline</label>
                                    <input type="text" name="timeline" v-model="form.timeline" id="timeline"
                                           class="form-control" :class="{'is-invalid':form.errors.has('timeline')}">
                                    <div v-if="form.errors.has('timeline')" v-html="form.errors.get('timeline')"/>
                                </div>

                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <b-button variant="success" v-if="!dis" disabled>
                                    <b-spinner small></b-spinner>
                                    {{ action }}
                                </b-button>
                                <button type="submit" v-if="dis" class="btn btn-primary" v-show="!editMode" >
                                    Save changes
                                </button>
                                <button type="submit" v-if="dis" class="btn btn-primary" v-show="editMode" >
                                    Update changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end modal -->
        </div>
    </div>
</template>
<script>
export default {
    name: "ServiceCharterComponent",

    data() {
        return {
            servicecharters: null,
            scinstitutions:null,
            editMode: false,
            action:'',
            dis:true,
            loading:false,

            form: new Form({
                id:'',
                service: '',
                scinstitution_id: '',
                requirements: '',
                cost: '',
                timeline:'',
            }),

        }
    },
    methods: {
        createMode() {
            this.editMode = false;
            this.form.reset();
            $('#createServiceCharter').modal('show');
            this.form.clear();
        },
        getServiceCharters() {
            this.loading=true;
            axios.get('/api/servicecharters').then((response) => {
                this.loading=false;
                this.servicecharters = response.data.data;
            }).catch(() => {
                this.$toastr.e('Cannot load Service Charter', 'Error');
            })
        },
        getInstitutions() {
            axios.get('/api/institutions').then((response) => {
                this.scinstitutions = response.data.data;
            }).catch(() => {
                this.$toastr.e('Cannot load Institutions', 'Error');
            })
        },

        editServiceCharter(servicecharter) {
            this.editMode = true;
            this.form.reset();
            this.form.fill(servicecharter);
            $('#createServiceCharter').modal('show');
        },
        deleteServiceCharter(id) {
            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                   // this.$Progress.start();
                    this.form.delete('/api/servicecharters/'+id).then((response)=>{
                        swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        Fire.$emit('loadData');
                        //this.$Progress.finish();
                    }).catch(()=>{
                        toast.fire({
                            icon:'error',
                            title:'Oops... Something went wrong, try again!,'
                        });
                        //this.$Progress.fail();
                    })

                }
            })

        },
        update() {
           // this.$Progress.start()
            this.action='Updating record ...';
            this.dis=false;
            this.form.put('/api/servicecharters/'+this.form.id).then((response)=>{
                this.dis=true;
                this.$toastr.s('Update is successful','Success');
                Fire.$emit('loadData');
                $('#createServiceCharter').modal('hide');
                this.form.reset();
                //this.$Progress.finish()

            }).catch(()=>{
                this.dis=true;
                this.$toastr.e('Cannot update the information, try again', 'Error');
                //this.$Progress.fail()
            });

        },
        save() {
            //this.$Progress.start()
            this.action='Creating record ...';
            this.dis=false;
            this.form.post('/api/servicecharters').then((response) => {
               // this.$Progress.finish()
                this.dis=true;
                toast.fire({
                    icon: 'success',
                    title: 'Record save successfully'
                });
                Fire.$emit('loadData');
                $('#createServiceCharter').modal('hide');
                this.form.reset();
            }).catch(() => {
                this.$toastr.e('Cannot save record, try again!', 'Error');
                this.dis=true;
                //this.$Progress.fail()
            });
        }

    },
    created() {
        this.getServiceCharters();
        this.getInstitutions();
        Fire.$on('loadData',()=>{
            this.getServiceCharters();
        })
    }
}
</script>
