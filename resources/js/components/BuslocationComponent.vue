<template>
	<div class="container">
		<div class="d-flex justify-content-center h-100">
            <div>
                <p v-for="buslocation in buslocations">
                    {{buslocation.address}} {{buslocation.city}} {{buslocation.country}} <span v-for="datacapturer in buslocation.capturers"> Inserted by {{datacapturer.uzer.organisation}}</span>
                    <a href=""@click.prevent="editModal(buslocation)">Edit</a>
                    <a href=""@click.prevent="deleteBuslocation(buslocation)">Delete</a>
                </p>
                <a href="" @click.prevent="createModal"><i class="fa fa-plus text-success"></i> Add Physical Location</a>
            </div>

<!-- Modal -->   
                <div class="modal fade modal-lg" id="buslocationModal" tabindex="-1" role="dialog" aria-labelledby="buslocationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="buslocationModalLabel">{{modalTitle}} <span class="small"> - {{user.organisation}}</span></h4>
                            </div>
                            <form role="form"  @submit.prevent="editMode? editBuslocation(): addBuslocation()">
                                <div class="modal-body">
                                    <p v-if="errors">
                                        <h6 class="text-danger"><strong>{{message}}</strong></h6>
                                    </p>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-road"></i></span> 
                                        </div>
                                        <input type="text" class="form-control" v-model="address" :class="{'is-invalid': errors.hasError('address')}"  required>
                                        <label class="floating-label">Street Address</label>
                                         <span v-if="errors.hasError('address')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('address')}}</strong>
                                        </span>                                
                                    </div>                                                        
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-tower"></i></span> 
                                        </div>
                                        <input type="tel" class="form-control" v-model="city"  :class="{'is-invalid': errors.hasError('city')}"  required>
                                        <label class="floating-label">City</label>
                                         <span v-if="errors.hasError('city')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('city')}}</strong>
                                        </span>                                
                                    </div>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-flag"></i></span> 
                                        </div>
                                        <input type="text" class="form-control" v-model="country"  :class="{'is-invalid': errors.hasError('country')}"  required>
                                        <label class="floating-label">country</label>
                                         <span v-if="errors.hasError('country')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('country')}}</strong>
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
                address: '',
                city: '',
                country: '',
                message: '',
                id:'',
                buslocations: {},
                errors: new Errors(),
            }
        },
        props: [
                'user',
        ],

        methods:{
            createModal()
             {
                $('#buslocationModal').modal('show');
                this.editMode = false;
                this.modalTitle ='Add Location';
                this.title = 'Add a User';
                this.submitTitle = 'Add Location';
                this.address = '';
                this.city = '';
                this.country = '';    
                this.errors = new Errors();
                this.message = '';            
             },
             editModal(buslocation){
                $('#buslocationModal').modal('show');
                this.editMode = true;
                this.modalTitle ='Edit Location';
                this.title = 'Edit Location';
                this.submitTitle = 'Edit Location';
                this.address = buslocation.address;
                this.city = buslocation.city;
                this.country = buslocation.country;
                this.id =buslocation.id;
                this.errors = new Errors();
                this.message = '';                  
             },           
            loadBuslocations(){
                axios.get('/buslocations/' + this.user.slug, {
                }).then((response) => {
                    this.buslocations = response.data});
            },
            addBuslocation(){
                axios.post('/buslocations/'+ this.user.slug,{
                    address: this.address,
                    city: this.city,
                    country: this.country, 

                }).then((response) =>{ 
                     window.location.href='/dashboard/'+this.user.slug; 
                    this.message = '';
                    this.address= '';
                    this.city = '';
                    this.country =''; 
                    this.errors = new Errors(); 
                    Fire.$emit('AfterBuslocationWasUpdated');
                    $('#buslocationModal').modal('hide');                       
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' Location not updated!';                    
                });

            },

            editBuslocation(){
                axios.put('/buslocations/'+ this.id,{
                    address: this.address,
                    city: this.city,
                    country: this.country,                   
                }).then((response) =>{ 
                    window.location.href='/dashboard/'+this.user.slug; 
                    this.message = '';
                    this.address= '';
                    this.city = '';
                    this.country =''; 
                    this.errors = new Errors(); 
                    Fire.$emit('AfterBuslocationWasUpdated');
                    $('#buslocationModal').modal('hide');                       
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' Location not updated!';                    
                });
            },

            deleteBuslocation(buslocation){
                axios.delete('/buslocations/'+buslocation.id).then((response)=>{
                    window.location.href='/dashboard/'+this.user.slug; 
                    this.message = ''; 
                    this.errors = new Errors(); 
                    Fire.$emit('AfterBuslocationWasUpdated');
                    $('#buslocationModal').modal('hide');                     
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' Location not updated!';                    
                });
            },

        },
        mounted(){
            this.loadBuslocations();
            Fire.$on('AfterBuslocationWasUpdated', () => {this.loadBuslocations()});
        }

    }	
</script>

