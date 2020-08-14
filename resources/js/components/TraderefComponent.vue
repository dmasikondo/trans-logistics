<template>
	<div class="container">
		<div class="d-flex justify-content-center h-100">
            <div>
                <p v-for="traderef in traderefs">
                    {{traderef.name}} {{traderef.phone}} {{traderef.address}} <span v-for="datacapturer in traderef.capturers"> Inserted by {{datacapturer.uzer.organisation}}</span>
                    <a href=""@click.prevent="editModal(traderef)">Edit</a>
                    <a href=""@click.prevent="deletetraderef(traderef)">Delete</a>
                </p>
                <a href="" @click.prevent="createModal"><i class="fa fa-plus text-success"></i> Add a traderef</a>
            </div>

<!-- Modal -->   
                <div class="modal fade modal-lg" id="traderefModal" tabindex="-1" role="dialog" aria-labelledby="traderefModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="traderefModalLabel">{{modalTitle}} <span class="small"> - {{user.organisation}}</span></h4>
                            </div>
                            <form role="form"  @submit.prevent="editMode? edittraderef(): addtraderef()">
                                <div class="modal-body">
                                    <p v-if="errors">
                                        <h6 class="text-danger"><strong>{{message}}</strong></h6>
                                    </p>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-user"></i></span> 
                                        </div>
                                        <input type="text" class="form-control" v-model="name" :class="{'is-invalid': errors.hasError('name')}"  required>
                                        <label class="floating-label">traderef's name</label>
                                         <span v-if="errors.hasError('name')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('name')}}</strong>
                                        </span>                                
                                    </div>                                                        
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-phone"></i></span> 
                                        </div>
                                        <input type="tel" class="form-control" v-model="phone"  :class="{'is-invalid': errors.hasError('phone')}"  required>
                                        <label class="floating-label">traderef's Phone Number</label>
                                         <span v-if="errors.hasError('phone')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('phone')}}</strong>
                                        </span>                                
                                    </div>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-address"></i></span> 
                                        </div>
                                        <input type="text" class="form-control" v-model="address"  :class="{'is-invalid': errors.hasError('address')}"  required>
                                        <label class="floating-label">traderef's Address</label>
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
                traderefs: {},
                errors: new Errors(),
            }
        },
        props: [
                'user',
        ],

        methods:{
            createModal()
             {
                $('#traderefModal').modal('show');
                this.editMode = false;
                this.modalTitle ='Add traderef';
                this.title = 'Add a User';
                this.submitTitle = 'Add traderef';
                this.name = '';
                this.phone = '';
                this.address = '';                
             },
             editModal(traderef){
                $('#traderefModal').modal('show');
                this.editMode = true;
                this.modalTitle ='Edit traderef';
                this.title = 'Edit traderef';
                this.submitTitle = 'Edit traderef';
                this.name = traderef.name;
                this.phone = traderef.phone;
                this.address = traderef.address;
                this.id =traderef.id;
             },           
            loadtraderefs(){
                axios.get('/traderefs/' + this.user.slug, {
                }).then((response) => {
                    this.traderefs = response.data});
            },
            addtraderef(){
                axios.post('/traderefs/'+ this.user.slug,{
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
                    Fire.$emit('AftertraderefWasUpdated');
                    $('#traderefModal').modal('hide');                       
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' traderefs not updated!';                    
                });

            },

            edittraderef(){
                axios.put('/traderefs/'+ this.id,{
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
                    Fire.$emit('AftertraderefWasUpdated');
                    $('#traderefModal').modal('hide');                       
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' traderefs not updated!';                    
                });
            },

            deletetraderef(traderef){
                axios.delete('/traderefs/'+traderef.id).then((response)=>{
                    window.location.href='/dashboard/'+this.user.slug; 
                    this.message = ''; 
                    this.errors = new Errors(); 
                    Fire.$emit('AftertraderefWasUpdated');
                    $('#traderefModal').modal('hide');                     
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' traderefs not updated!';                    
                });
            },

        },
        mounted(){
            this.loadtraderefs();
            Fire.$on('AftertraderefWasUpdated', () => {this.loadtraderefs()});
        }

    }	
</script>

