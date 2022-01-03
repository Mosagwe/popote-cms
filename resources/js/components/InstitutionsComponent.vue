<template>

    <div class="card card-success card-outline">
        <div class="card-header">
            <h3 class="card-title">Service Charter Institutions</h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                    <li class="nav-item mr-1">
                        <button class="btn btn-success" @click="createMode"><i class="fas fa-plus-circle"></i>Add New
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
                    <th>Institution Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th style="min-width: 100px;">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="institution in institutions">
                    <td>{{ institution.id }}</td>
                    <td>{{ institution.name }}</td>
                    <td>{{ institution.created_at | myDate }}</td>
                    <td>{{ institution.updated_at | myDate }}</td>
                    <td>
                        <a href="" class="btn btn-sm btn-warning" @click.prevent="editInstitution(institution)"><i
                            class="fa fa-edit"></i> </a>
                        <a href="" class="btn btn-sm btn-danger" @click.prevent="deleteInstitution(institution)"><i
                            class="fa fa-trash"></i> </a>
                    </td>
                </tr>
                </tbody>
            </table>
            <loading :loading="loading"></loading>

            <!--modal -->
            <div class="modal fade" id="createInstitution" tabindex="-1" role="dialog"
                 aria-labelledby="ceateInstitutionModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createInstitutionModalLabel" v-show="!editMode">Create
                                Institution</h5>
                            <h5 class="modal-title" id="createInstitutionModalLabel" v-show="editMode">Update
                                Institution</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Institution Name</label>
                                    <input type="text" name="name" v-model="form.name" id="name" class="form-control">
                                    <div v-if="form.errors.has('name')" v-html="form.errors.get('name')"></div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <b-button variant="success" v-if="!dis" disabled>
                                    <b-spinner small></b-spinner>
                                    {{ action }}
                                </b-button>
                                <button type="button" v-if="dis" class="btn btn-primary" v-show="!editMode" @click.prevent="save">
                                    Save changes
                                </button>
                                <button type="button" v-if="dis" class="btn btn-primary" v-show="editMode" @click.prevent="update">
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
    name: "InstitutionsComponent",
    data() {
        return {
            institutions: null,
            editMode: false,
            action:'',
            dis:true,
            loading:false,

            form: new Form({
                'name': '',
                'id':''
            }),

        }
    },
    methods: {
        getInstitutions() {
            this.loading=true;
            axios.get('/api/institutions').then((response) => {
                this.loading=false;
                this.institutions = response.data.data;
            }).catch(() => {
                this.$toastr.e('Cannot load Institutions', 'Error');
            })
        },
        createMode() {
            this.editMode = false;
            $('#createInstitution').modal('show');

        },
        editInstitution(institution) {
            this.editMode = true;
            this.form.reset();
            this.form.fill(institution);
            $('#createInstitution').modal('show');



        },
        deleteInstitution(institution) {

        },
        update() {
            this.action='Updating record ...';
            this.dis=false;
            this.form.put('/api/institutions/'+this.form.id).then((response)=>{
                this.dis=true;
                this.$toastr.s('Update is successful','Success');
                Fire.$emit('loadInstitutions');
                $('#createInstitution').modal('hide');
                this.form.reset();

            }).catch(()=>{
                this.dis=true;
                this.$toastr.e('Cannot update the information, try again', 'Error');
            });

        },
        save() {
            this.action='Creating record ...';
            this.dis=false;
            this.form.post('/api/institutions').then((response) => {
                this.dis=true;
                toast.fire({
                    icon: 'success',
                    title: 'Record save successfully'
                });
                Fire.$emit('loadInstitutions');
                $('#createInstitution').modal('hide');
                this.form.reset();
            }).catch(() => {
                this.$toastr.e('Cannot save record, try again!', 'Error');
                this.dis=true;
            });
        }

    },
    created() {
        this.getInstitutions();
        Fire.$on('loadInstitutions',()=>{
            this.getInstitutions();
        })
    }

}
</script>

<style scoped>

</style>
