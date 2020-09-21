<template>
	<div class="container">
		<div class="d-flex justify-content-center h-100">
            <div class="row">

                <h1 class="col-md-12">
                    <i class="fa fa-share-alt fa-3x"></i>
                    The Location for <small>{{user.organisation}}</small>
                </h1>

                <h2 class="col-md-12 pull-right">

                    <a v-if="buslocations" href="" @click.prevent="createModal">
                        <i class="fa fa-plus text-success"></i> 
                        Add Business Physical Location
                        <i v-if="loading" class="fa fa-spinner fa-pulse"></i>
                    </a>
                </h2>                
                <h2 class="col-md-12">
                    <span class="pull-right">
                        <a :href="'/dashboard/' + user.slug">
                            <i class="fa fa-chevron-left text-success"></i> 
                            Back
                            
                        </a>                            
                    </span>
                </h2>
                <div v-for="buslocation in buslocations" class="media col-md-4">
                    <span class="circle">{{buslocation.city.slice(0,1)}}</span>
                    <div class="media-body">
                        <p>
                           <i class="fa fa-institution"></i> {{buslocation.address}} 
                            <a href=""@click.prevent="editModal(buslocation)">
                                <i class="fa fa-edit"></i>
                                Edit 
                            </a>
                            <a href=""@click.prevent="deleteBuslocation(buslocation)">
                               <i class="fa fa-trash text-danger"></i> 
                               Delete
                                <i v-if="loading" class="fa fa-spinner fa-pulse"></i>
                            </a>                            
                                                                                <br>
                            <i class="fa fa-map-marker"></i> {{buslocation.city}}       <br>
                            <i class="fa fa-flag"></i> {{buslocation.country}} 
                        </p>
                    </div>
                </div>  

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
                                           <span class="input-group-text"><i class="fa fa-building"></i></span> 
                                        </div>
                                        <input type="tel" class="form-control" v-model="city"  :class="{'is-invalid': errors.hasError('city')}"  required>
                                        <label class="floating-label">City</label>
                                         <span v-if="errors.hasError('city')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('city')}}</strong>
                                        </span>                                
                                    </div>
                                    <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text"><i class="fa fa-flag text-danger"></i></span> 
                                    </div>
                                    <select class="form-control" v-model="country"  :class="{'is-invalid': errors.hasError('country')}"  required>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Congo, The Democratic Republic of the">Congo, The Democratic Republic of the</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                                    <label class="floating-label">Country</label>
                                     <span v-if="errors.hasError('country')" class="invalid-feedback" role="alert">
                                        <strong>{{errors.get('country')}}</strong>
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
                address: '',
                city: '',
                country: '',
                message: '',
                id:'',
                buslocations: {},
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
                this.loading = true; //the loading begin
                axios.post('/buslocations/'+ this.user.slug,{
                    address: this.address,
                    city: this.city,
                    country: this.country, 

                }).then((response) =>{ 
                //     window.location.href='/dashboard/'+this.user.slug; 
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
                }).finally(() => (this.loading = false)); // set loading to false when request finish;

            },

            editBuslocation(){
                this.loading = true; //the loading begin
                axios.put('/buslocations/'+ this.id,{
                    address: this.address,
                    city: this.city,
                    country: this.country,                   
                }).then((response) =>{ 
                 //   window.location.href='/dashboard/'+this.user.slug; 
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
                }).finally(() => (this.loading = false)); // set loading to false when request finish;
            },

            deleteBuslocation(buslocation){
                    this.loading = true, //the loading begin
                    Swal.fire({
                    title: "Are you sure?",
                    text: "Once Deleted, you will not be able to recover this  -- " + buslocation.address +" Location!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText:'Yes, delete it!',
                    cancelButtonText:'No, keep it',
                    }).then((willDelete) => {                        
                        if (willDelete.value) {                    
                            axios.delete('/buslocations/'+buslocation.id).then((response)=>{  
                            Fire.$emit('AfterBuslocationWasUpdated');                                                  
                            Swal.fire('Deleted!',
                            'Your business location was successfully deleted',
                            'success'
                            ); 
                           // window.location.href='/loads/create';                                
                        }).catch((e)=>{
                            this.errors.record(e.response.data.errors);
                            this.message = e.response.data.message;
                            Swal.fire("Failure! "+ this.message, {
                            icon: "error",
                        });                        
                    }).finally(() => (this.loading = false)); // set loading to false when request finish;
                        } 
                        else if(willDelete.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire('Cancelled',
                                        'Your business location is safe',
                                        'error'
                            )
                        }
                    }).finally(() => (this.loading = false)); // set loading to false when request finish;
                },

        },
        mounted(){
            this.loadBuslocations();
            Fire.$on('AfterBuslocationWasUpdated', () => {this.loadBuslocations()});
        }

    }	
</script>

