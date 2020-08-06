<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form>
                    <div class="form-group">
                        <input v-model="searchTerm" type="text" class="form-control" name="search" placeholder="Search the users by surname, name or email..." v-on:keyup="searchUser">                                    
                    </div>
                </form>  
                <p class="lead"><span class="badge badge-info">{{users.length}}</span> <strong>records</strong> </p>              
                        <table  class="table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Surname</th>
                                    <th>Names</th>
                                    <th>Email</th>
                                    <th>Sex</th>
                                    <th colspan="2">Approved On</th>
                                    <th>Modify</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users">
                                    <td>1</td>
                                    <td>{{user.surname}}</td>
                                    <td>{{user.names}}</td>
                                    <td>{{user.email}}</td>
                                    <td>{{user.sex}}</td>
                                    <td colspan="2" v-if="user.approved_at">
                                        Activated By {{user.approver.surname}} {{user.approved_at |myDate}}
                                        <a href="" @click.prevent="userApproveAccountModal(user)"><i class="fa fa-edit text-info"> Edit User-Roles</i></a> 
                                    </td>
                                    <td colspan="2" v-if="!user.approved_at">
                                         <a href="" @click.prevent="userApproveAccountModal(user)"><i class="fa fa-edit text-info"> Activate Account</i></a> 
                                                                                
                                    </td> 
                                    <td>
                                            <span v-for="role in user.roles" class="fa fa-user">{{role.name}}</span>                                          
                                            <a v-if="!user.suspended_at" href @click.prevent="suspendUser(user)">
                                                <i class="fa fa-remove text-danger"> Suspend User</i>
                                            </a>
                                            <a v-if="user.suspended_at" href @click.prevent="ReactivateUserSupendedAccount(user)">
                                                <i class="fa fa-ok text-success"> Reactivate Account</i>
                                            </a>                                            
                                            <a v-if="!user.isDeleted" href @click.prevent="DeleteUser(user)">
                                                <i class="fa fa-trash text-danger"> Delete Account</i>
                                            </a> 
                                    </td>
                                </tr>
                            </tbody>
                        </table>
            </div>
        </div>
<!-- Modal -->
        <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title float-left" id="myModalLabel">{{title}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <form @submit.prevent="approveUserAccount(currentUser.slug)">
              <div class="modal-body">
                <div class="form-group">
                    <label for="name[]">{{title}} <span class="small" v-for="role in currentUser.roles">{{role.name}} </span></label>                    
                    <select v-model="name" name="name[]" class="form-control" :class="{'is-invalid': errors.hasError('name')}" id="roles" multiple="multiple">
                            <option></option>
                            <option v-for="jobTitle in jobTitles" :value="jobTitle.id"><span v-model="selection">{{jobTitle.name}}</span></option>
                        </select>
                    <span v-if="errors.hasError('name')" class="invalid-feedback" role="alert" style="display: block">
                        <strong>{{errors.get('name')}}</strong>
                        </span>
                                               
                </div>
            </div>       
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add User</button> 
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div> 
<!-- End of Modal -->               
    </div>
</template>

<script>
   class Errors{
        constructor(){
            this.errors = {};
        }
        get(field){
            if(this.errors[field]){
               return this.errors[field][0];
            }
        }
        hasError(field)
        {
             if(this.errors[field]){
              return true;
            } 
            else{
                return false;
            } 
        }
        clear(field){
           delete this.errors[field];
        }

        record(errors){
            this.errors = errors;
        }

    }
    export default {
        data()
        {
            return{
                selection: [],
                title: '',
                slug: '',
                message: '',
                name: [],
                searchTerm: '',
                approvalMode: false,
                deleteMode: false,
                suspendMode: false,
                jobTitles: {},
                currentUser: [],
                users: {},
                errors: new Errors(),
            }
        },

        methods: {
                loadUsers(){
                    axios.get('/api/users').then((response)=>{
                    this.users = response.data;
                    });
                 },
                 userApproveAccountModal(user){
                    axios.get('/api/allroles').then((response)=>{
                    this.jobTitles = response.data;
                    });  
                    this.currentUser = user;                  
                    this.title ='Select Job Title(s)';
                    this.slug = user.slug;
                    this.errors = new Errors();
                    approvalMode: true;
                    deleteMode: false;
                    suspendMode: false;
                    $('#userModal').modal('show');

                 },
                 approveUserAccount(slug)  {
                     this.errors= new Errors();
                    axios.patch('/api/approve-user/'+ slug, {
                        name: this.name,
                    }).then((response)=>{
                        $('#userModal').modal('hide');
                        this.name = [];
                        swal("Success! "+response.data, { 
                            icon: "success",
                        });
                        Fire.$emit('AfterUserWasUpdated');
                    }).catch((e)=>{
                        this.errors.record(e.response.data.errors);
                        this.message = e.response.data.message;
                        swal("Failure! "+ this.message, {
                            icon: "error",
                        });
                    });
                 }, 

                 suspendUser(user){
                    swal({
                    title: "Are you sure?",
                    text: "Once suspended, " + user.surname + " will not be able to view most of the resources!" ,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    }).then((willSuspend) => {                        
                        if (willSuspend) {                    
                    axios.patch('/api/suspend-user/'+ user.slug, {
                    }).then((response) =>{
                        Fire.$emit('AfterUserWasUpdated');
                        swal("Success! " +response.data, {
                         icon: "success",
                        });                                
                    }).catch((e)=>{
                        this.errors.record(e.response.data.errors);
                        this.message = e.response.data.message;
                        swal("Failure! "+ this.message, {
                            icon: "error",
                        });                        
                    });
                        } 
                        else {
                            swal("The User is safe!");
                        }
                    });
                 },
                 ReactivateUserSupendedAccount(user){
                    swal({
                    title: "Are you sure?",
                    text: "Once Reactivate, " + user.surname + " will be enabled to view resources previously deprived of!" ,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    }).then((willSuspend) => {                        
                        if (willSuspend) {                    
                    axios.patch('/api/reactivate-user/'+ user.slug, {
                    }).then((response) =>{
                        Fire.$emit('AfterUserWasUpdated');
                        swal("Success! " +response.data, {
                         icon: "success",
                        });                                
                    }).catch((e)=>{
                        this.errors.record(e.response.data.errors);
                        this.message = e.response.data.message;
                        swal("Failure! "+ this.message, {
                            icon: "error",
                        });                        
                    });
                        } 
                        else {
                            swal("The User is safe!");
                        }
                    });
                 },
                 DeleteUser(user){
                    swal({
                    title: "Are you sure?",
                    text: "Once Deleted, you will not be able to revert the user -- " +user.surname +"!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    }).then((willDelete) => {                        
                        if (willDelete) {                    
                    axios.delete('/api/users/'+ user.id, {
                    }).then((response) =>{
                        Fire.$emit('AfterUserWasUpdated');
                        swal("Success! " +response.data, {
                         icon: "success",
                        });                                
                    }).catch((e)=>{
                        this.errors.record(e.response.data.errors);
                        this.message = e.response.data.message;
                        swal("Failure! "+ this.message, {
                            icon: "error",
                        });                        
                    });
                        } 
                        else {
                            swal("The User is safe!");
                        }
                    });
                 },
                 searchUser(){
                    axios.get('/api/user-search/'+ this.searchTerm, {                        
                    }).then((response) =>{
                        this.users = response.data;
                    }).catch(e=> {
                        this.loadUsers();                        
                    });
                 },

                 clearErrors(){
                    this.errors= new Errors();
                 },                              
            },

        mounted(){
            this.loadUsers();
            Fire.$on('AfterUserWasUpdated', () => {this.loadUsers()});
        }
     
    }
</script>