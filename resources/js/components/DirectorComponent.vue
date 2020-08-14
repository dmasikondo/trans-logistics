<template>
	<div class="container">
		<div class="d-flex justify-content-center h-100">
            <div>
                <p v-for="director in directors">
                    {{director.name}} {{director.phone}} {{director.address}} <span v-for="datacapturer in director.capturers"> Inserted by {{datacapturer.uzer.organisation}}</span>
                    <a href=""@click.prevent="editModal(director)">Edit</a>
                    <a href=""@click.prevent="deletedirector(director)">Delete</a>
                </p>
                <a href="" @click.prevent="createModal"><i class="fa fa-plus text-success"></i> Add a director</a>
            </div>

<!-- Modal -->   
                <div class="modal fade modal-lg" id="directorModal" tabindex="-1" role="dialog" aria-labelledby="directorModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="directorModalLabel">{{modalTitle}} <span class="small"> - {{user.organisation}}</span></h4>
                            </div>
                            <form role="form"  @submit.prevent="editMode? editdirector(): adddirector()">
                                <div class="modal-body">
                                    <p v-if="errors">
                                        <h6 class="text-danger"><strong>{{message}}</strong></h6>
                                    </p>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-user"></i></span> 
                                        </div>
                                        <input type="text" class="form-control" v-model="name" :class="{'is-invalid': errors.hasError('name')}"  required>
                                        <label class="floating-label">Director's name</label>
                                         <span v-if="errors.hasError('name')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('name')}}</strong>
                                        </span>                                
                                    </div>                                                        
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-phone"></i></span> 
                                        </div>
                                        <input type="tel" class="form-control" v-model="phone"  :class="{'is-invalid': errors.hasError('phone')}"  required>
                                        <label class="floating-label">Director's Phone Number</label>
                                         <span v-if="errors.hasError('phone')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('phone')}}</strong>
                                        </span>                                
                                    </div>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-address"></i></span> 
                                        </div>
                                        <input type="text" class="form-control" v-model="address"  :class="{'is-invalid': errors.hasError('address')}"  required>
                                        <label class="floating-label">Director's Address</label>
                                         <span v-if="errors.hasError('address')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('address')}}</strong>
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

    export default{
        data()
        {
            return{
                modalTitle: '',
                submitTitle: '',
                editMode: false,
                name: '',
                phone: '',
                address: '',
                message: '',
                id:'',
                directors: {},
                errors: new Errors(),
            }
        },
        props: [
                'user',
        ],

        methods:{
            createModal()
             {
                $('#directorModal').modal('show');
                this.editMode = false;
                this.modalTitle ='Add director';
                this.title = 'Add a User';
                this.submitTitle = 'Add director';
                this.name = '';
                this.phone = '';
                this.address = '';                
             },
             editModal(director){
                $('#directorModal').modal('show');
                this.editMode = true;
                this.modalTitle ='Edit director';
                this.title = 'Edit director';
                this.submitTitle = 'Edit director';
                this.name = director.name;
                this.phone = director.phone;
                this.address = director.address;
                this.id =director.id;
             },           
            loaddirectors(){
                axios.get('/directors/' + this.user.slug, {
                }).then((response) => {
                    this.directors = response.data});
            },
            adddirector(){
                axios.post('/directors/'+ this.user.slug,{
                    name: this.name,
                    phone: this.phone,
                    address: this.address, 

                }).then((response) =>{ 
                     window.location.href='/dashboard/'+this.user.slug; 
                    this.message = '';
                    this.name= '';
                    this.phone = '';
                    this.address =''; 
                    this.errors = new Errors(); 
                    Fire.$emit('AfterdirectorWasUpdated');
                    $('#directorModal').modal('hide');                       
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' directors not updated!';                    
                });

            },

            editdirector(){
                axios.put('/directors/'+ this.id,{
                    name: this.name,
                    phone: this.phone,
                    address: this.address,                   
                }).then((response) =>{ 
                    window.location.href='/dashboard/'+this.user.slug; 
                    this.message = '';
                    this.name= '';
                    this.phone = '';
                    this.address =''; 
                    this.errors = new Errors(); 
                    Fire.$emit('AfterdirectorWasUpdated');
                    $('#directorModal').modal('hide');                       
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' directors not updated!';                    
                });
            },

            deletedirector(director){
                axios.delete('/directors/'+director.id).then((response)=>{
                    window.location.href='/dashboard/'+this.user.slug; 
                    this.message = ''; 
                    this.errors = new Errors(); 
                    Fire.$emit('AfterdirectorWasUpdated');
                    $('#directorModal').modal('hide');                     
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' directors not updated!';                    
                });
            },

        },
        mounted(){
            this.loaddirectors();
            Fire.$on('AfterdirectorWasUpdated', () => {this.loaddirectors()});
        }

    }	
</script>

