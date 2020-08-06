<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">                    
                <form>
                    <div class="form-group">
                        <input v-model="searchTerm" type="text" class="form-control" name="search" placeholder="Search the user roles..." v-on:keyup="searchRole">                                    
                    </div>
                </form>                                                                                        
                    
                <p class="lead"><span class="badge badge-info">{{roles.length}}</span> <strong>records</strong> </p>
                <div class="role-container">
                    <div class="role-body" style="margin-top: -1.875em;">
                        <a href="" @click.prevent="createModal"><i class="fa fa-plus text-success"></i> Add a user role</a>
                    </div>
                  <div class="role"  v-for="role in roles">
                    <div class="role-body">
                       <p class="text-capitalize">
                            {{role.name}}
                            <span class="badge badge-default">{{role.names? role.names.length : 0}} - Users</span>
                             <span v-for="user in role.users"> <i class="fa fa-user"></i> {{user.surname}} </span> 
                        </p> 
                    </div> 
                    <div class="role-footer small">
                        <span class="fa fa-clock"> Created {{ role.created_at |myDate}}</span>
                        <a href="" @click.prevent="deleteRole(role.id, role)"><i class="fa fa-trash text-danger"></i></a>
                         <a href="" @click.prevent="editModal(role)"><i class="fa fa-edit text-info"></i></a>        
                    </div>
                  </div>
                </div>                
            </div>
<!-- Modal -->   
                <div class="modal fade modal-lg" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="roleModalLabel">{{modalTitle}} <span class="small"> - {{name}}</span></h4>
                            </div>
                            <form role="form"  @submit.prevent="editMode? updateRole(): createRole()">
                                <div class="modal-body">
                                        
                                        <div class="form-group">
                                            <label for="name">{{title}}</label>
                                            <input v-on:keydown="clearErrors()" type="text" name="name" v-model="name" class="form-control" :class="{'is-invalid': errors.hasError('name')}" value="" placeholder="Enter a name for the role">
                                            <span v-if="errors.hasError('name')" class="invalid-feedback" role="alert" style="display: block">
                                                <strong>{{errors.get('name')}}</strong>
                                            </span>                             
                                        </div> 
                                </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" type="submit">{{submitTitle}}</button>                                            
                                    </div>  
                            </form>                              
                        </div>
                     </div>
                </div>          
            <!-- end of modal --> 

        </div>

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
                editMode: false,
                id: '',
                roles: {},
                name: '',
                modalTitle: '',
                title: '',
                searchTerm: '',
                submitTitle: '',
                errors: new Errors(),
                message: '',   
            }
        },

        methods: {
                createRole(){

                    axios.post('/api/roles', {
                        name: this.name,
                    }).then((response)=>{
                        swal("Success! Role successfully added", {
                            icon: "success",
                        });
                        this.name = '';
                        this.errors= new Errors();
                        $('#roleModal').modal('hide');
                         Fire.$emit('AfterRoleWasCreated');                        
                    }).catch(e=> {
                        swal("Failure! Role creation failed", {
                            icon: "error",
                        });                        
                        this.errors.record(e.response.data.errors);
                        this.message = e.response.data.message + ' Role not created';
                        
                    });
                 }, 

                 loadRoles(){
                    axios.get('/api/roles').then((response)=>{
                        this.roles =response.data;
                    });
                 },

                 editModal(role)
                 {
                    $('#roleModal').modal('show');
                    this.editMode = true;
                    this.name = role.name;
                    this.id = role.id;
                    this.modalTitle ='Edit The Role';
                    this.title = 'Edit the Role';
                    this.submitTitle = 'Update Role';
                 },
                 createModal()
                 {
                    $('#roleModal').modal('show');
                    this.editMode = false;
                    this.modalTitle ='Create a Role';
                    this.name ='';
                    this.id = '';
                    this.title = 'Create a User-Role';
                    this.submitTitle = 'Create Role';
                 },
                 updateRole()
                 {
                    axios.put('/api/roles/'+ this.id, {
                        name: this.name
                    }).then((response)=>{
                        swal("Success! Role successfully updated", {
                            icon: "success",
                        }); 
                        this.name = '';
                        this.errors= new Errors();
                        $('#roleModal').modal('hide'); 
                        Fire.$emit('AfterRoleWasCreated');                              
                    }).catch(e=> {
                        swal("Failure! Role update failed", {
                            icon: "error",
                        });      
                        $('#roleModal').modal('show');                  
                        this.errors.record(e.response.data.errors);
                        this.message = e.response.data.message + ' Role not updated';
                        
                    });
                 },

                 deleteRole(id,role) {
                    swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to revert the role - " +role.name +"!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    }).then((willDelete) => {                        
                        if (willDelete) {
                            axios.delete('/api/roles/' + id, {
                               id: id, 
                            }).then((response)=>{
                                Fire.$emit('AfterRoleWasCreated');
                                swal("Success! Your record has been deleted!", {
                                 icon: "success",
                                });                                
                            });
                        } 
                        else {
                            swal("Your record is safe!");
                        }
                    });                      
                                                      
                 },

                 searchRole(){
                    axios.get('/api/role-search/'+ this.searchTerm, {
                    }).then((response) =>{
                        this.roles =response.data;
                    }).catch(e=> {
                        this.loadRoles();                        
                    });
                 },

                 clearErrors(){
                    this.errors= new Errors();
                 }

            },

        mounted(){
            this.loadRoles();
            Fire.$on('AfterRoleWasCreated', () => {this.loadRoles()});
        }
     
    }
</script>
<style>

.role-container {
    display: -webkit-flex;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
}

.role {
    width: 13em;
    height: 10em;
    margin: 1.5em 0  1.5em 0;
} 
.role-body {
   /* background-color: cornflowerblue; */
   background-color: #fff;
    width: 11.375em;
    height: 6.25em;
    margin: 0.625em;
    padding: 0.625em;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bolder;
    box-shadow: .104em .104em #222;
    border-radius: .3125em;
    color: #444;    
} 
.role-footer{
    font-weight: normal;
    color: #333;
}
   
</style>
               