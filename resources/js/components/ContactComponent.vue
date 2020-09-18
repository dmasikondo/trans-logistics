<template>
	<div class="container">
		<div class="d-flex justify-content-center h-100">
            <div class="row">

                <h1 class="col-md-12">
                    <i class="fa fa-share-alt fa-3x"></i>
                    The Contact Details 
                    <span class="pull-right">

                        <a href="" @click.prevent="createModal">
                            <i class="fa fa-plus text-success"></i> 
                            Add a Contact
                        </a>
                    </span>
                </h1>
                <div v-for="contact in contacts" class="media col-md-4">
                    <span class="circle">{{contact.person.slice(0,1)}}</span>
                    <div class="media-body">
                        <p>
                           <i class="fa fa-user"></i> {{contact.person}} 
                            <a href=""@click.prevent="editModal(contact)">
                                Edit
                                <i v-if="loading" class="fa fa-spinner fa-pulse"></i>
                            </a>
                            <a href=""@click.prevent="deleteContact(contact)">
                                Delete
                                <i v-if="loading" class="fa fa-spinner fa-pulse"></i>
                            </a>                            
                                                                                <br>
                            <i class="fa fa-phone"></i> {{contact.phone}}       <br>
                            <i class="fa fa-whatsapp"></i> {{contact.whatsapp}} 
                        </p>
                    </div>
                </div>  

            </div>

<!-- Modal -->   
                <div class="modal fade modal-lg" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="contactModalLabel">{{modalTitle}} <span class="small"> - {{user.organisation}}</span></h4>
                            </div>
                            <form role="form"  @submit.prevent="editMode? editContact(): addContact()">

                                <div class="modal-body">
                                    <p v-if="errors">
                                        <h6 class="text-danger"><strong>{{message}}</strong></h6>
                                    </p>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-user"></i></span> 
                                        </div>
                                        <input type="text" class="form-control" v-model="person" :class="{'is-invalid': errors.hasError('person')}"  required>
                                        <label class="floating-label">Contact Person</label>
                                         <span v-if="errors.hasError('person')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('person')}}</strong>
                                        </span>                                
                                    </div>                                                        
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-phone"></i></span> 
                                        </div>
                                        <input type="tel" class="form-control" v-model="phone"  :class="{'is-invalid': errors.hasError('phone')}"  required>
                                        <label class="floating-label">Contact Phone Number</label>
                                         <span v-if="errors.hasError('phone')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('phone')}}</strong>
                                        </span>                                
                                    </div>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-whatsapp"></i></span> 
                                        </div>
                                        <input type="text" class="form-control" v-model="whatsapp"  :class="{'is-invalid': errors.hasError('whatsapp')}" required>
                                        <label class="floating-label">WhatsApp Number</label>
                                         <span v-if="errors.hasError('whatsapp')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('whatsapp')}}</strong>
                                        </span>                                
                                    </div>                                          

                                </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" type="submit">
                                            {{submitTitle}}
                                            <i v-if="loading" class="fa fa-spinner fa-pulse"></i>
                                        </button>                                            
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
                person: '',
                phone: '',
                whatsapp: '',
                message: '',
                id:'',
                contacts: {},
                errors: new Errors(),
                loading: false,
            }
        },
        props: [
                'user',
        ],

        methods:{
            createModal()
             {
                $('#contactModal').modal('show');
                this.editMode = false;
                this.modalTitle ='Add Contact';
                this.title = 'Add a User';
                this.submitTitle = 'Add Contact';
                this.person = '';
                this.phone = '';
                this.whatsapp = '';                
             },
             editModal(contact){
                $('#contactModal').modal('show');
                this.editMode = true;
                this.modalTitle ='Edit Contact';
                this.title = 'Edit Contact';
                this.submitTitle = 'Edit Contact';
                this.person = contact.person;
                this.phone = contact.phone;
                this.whatsapp = contact.whatsapp;
                this.id =contact.id;
             },           
            loadContacts(){
                this.loading = true; //the loading begin
                axios.get('/contacts/' + this.user.slug, {
                }).then((response) => {
                    this.contacts = response.data
                }).finally(() => (this.loading = false)); // set loading to false when request finish
            },
            addContact(){
                this.loading = true; //the loading begin
                axios.post('/contacts/'+ this.user.slug,{
                    person: this.person,
                    phone: this.phone,
                    whatsapp: this.whatsapp, 

                }).then((response) =>{ 
                     window.location.href='/dashboard/'+this.user.slug; 
                    this.message = '';
                    this.person= '';
                    this.phone = '';
                    this.whatsapp =''; 
                    this.errors = new Errors(); 
                    Fire.$emit('AfterContactWasUpdated');
                    $('#contactModal').modal('hide');                       
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' Contacts not updated!';                    
                }).finally(() => (this.loading = false)); // set loading to false when request finish

            },

            editContact(){
                this.loading = true; //the loading begin
                axios.put('/contacts/'+ this.id,{
                    person: this.person,
                    phone: this.phone,
                    whatsapp: this.whatsapp,                   
                }).then((response) =>{ 
                    window.location.href='/dashboard/'+this.user.slug; 
                    this.message = '';
                    this.person= '';
                    this.phone = '';
                    this.whatsapp =''; 
                    this.errors = new Errors(); 
                    Fire.$emit('AfterContactWasUpdated');
                    $('#contactModal').modal('hide');                       
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' Contacts not updated!';                    
                }).finally(() => (this.loading = false)); // set loading to false when request finish
            },

            deleteContact(contact){
                this.loading = true; //the loading begin
                axios.delete('/contacts/'+contact.id).then((response)=>{
                    window.location.href='/dashboard/'+this.user.slug; 
                    this.message = ''; 
                    this.errors = new Errors(); 
                    Fire.$emit('AfterContactWasUpdated');
                    $('#contactModal').modal('hide');                     
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' Contacts not updated!';                    
                }).finally(() => (this.loading = false)); // set loading to false when request finish
            },

        },
        mounted(){
            this.loadContacts();
            Fire.$on('AfterContactWasUpdated', () => {this.loadContacts()});
        }

    }	
</script>

