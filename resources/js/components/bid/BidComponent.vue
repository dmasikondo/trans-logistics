<template>
    <div>
     
    <p>
        <a href=""@click.prevent="createBidModal">Bid</a>
    </p>   

<!-- Modal -->   
                <div class="modal fade modal-lg" id="bidModal" tabindex="-1" role="dialog" aria-labelledby="bidModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="bidModalLabel">{{modalTitle}}</h4>
                            </div>
                            <form role="form"  @submit.prevent="createShipmentBid">
                                <div class="modal-body">
                                    <p v-if="errors">
                                        <h6 class="text-danger"><strong>{{message}}</strong></h6>
                                    </p>

                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-truck"></i></span> 
                                        </div>
                                        <select class="form-control" id="vehicle" v-model="vehicleType" :class="{'is-invalid': errors.hasError('vehicle_type')}"  required>
                                            <option value="">Select Type of Trailer</option>
                                            <option v-for="vehicle in trailers" :value ="vehicle.name">{{vehicle.name}}</option>
                                        </select>
                                        <label class="floating-label">Select Trailer Type</label>
                                         <span v-if="errors.hasError('vehicle_type')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('vehicle_type')}}</strong>
                                        </span>                                
                                    </div> 

                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-calender"></i></span> 
                                        </div>
                                        <input type="date" class="form-control" v-model="date_available"  :class="{'is-invalid': errors.hasError('date_available')}" required>
                                        <label class="floating-label">Date of Availability</label>
                                         <span v-if="errors.hasError('date_available')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('date_available')}}</strong>
                                        </span>                                
                                    </div>
                                                                     

                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-road"></i></span> 
                                        </div>
                                        <input type="text" class="form-control" v-model="available_capacity" :class="{'is-invalid': errors.hasError('available_capacity')}"   required>
                                        <label class="floating-label">Required Price</label>
                                         <span v-if="errors.hasError('available_capacity')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('available_capacity')}}</strong>
                                        </span>                                
                                    </div> 

                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-road"></i></span> 
                                        </div>
                                        <input type="text" class="form-control" v-model="vehicle_location" :class="{'is-invalid': errors.hasError('vehicle_location')}"   required>
                                        <label class="floating-label">Current Vehicle Location</label>
                                         <span v-if="errors.hasError('vehicle_location')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('vehicle_location')}}</strong>
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
                price: '',
                date_available: null,
                available_capacity: '',
                trailer_type: '',
                vehicle_location: '',
                trailers: {},
                editMode: false,
                modalTitle: '',
                title: '',
                submitTitle: '',
                message: '',
                errors: new Errors(),
            }
        },
        props: {
            vehicle: {
                type: Object,
              required: true
            },
        },

        methods:{ 
                createBidModal()
                {
                    axios.get('/allcategories').then((response)=>{
                    this.categories = response.data;
                    });                      
                    $('#bidModal').show();
                    this.editMode = false;
                    this.modalTitle ='Make a bid';
                    this.title = 'Add bid';
                    this.submitTitle = 'Add bid';
                    this.price = '';            
                    this.available_date = null;
                    this.available_capacity = '';
                    this.trailer_type = '';
                    this.vehicle_location = '';   
                }, 
                createShipmentBid(){
                    axios.post('/bids/'+ this.freight.slug,{
                        price: this.price,
                        available_date: this.available_date,
                        available_capacity: this.available_capacity,
                        trailer_type: this.trailer_type,
                        vehicle_location: this.vehicle_location,

                    }).then((response) =>{ 
                       // window.location.href='/loads/'+freight.slug;
                        this.price = '';            
                        this.available_date = null;
                        this.available_capacity = '';
                        this.trailer_type = '';
                        this.vehicle_location = '';                      
                        this.message = '';
                        this.errors = new Errors();
                    }).catch((e)=>{
                            this.errors.record(e.response.data.errors);
                            this.message = e.response.data.message;
                     });         
                },        
                 deleteBid(){
                    Swal.fire({
                    title: "Are you sure?",
                    text: "Once Deleted, you will not be able to recover this -- " +this.vehicle.trailer_type +"!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText:'Yes, delete it!',
                    cancelButtonText:'No, keep it',
                    }).then((willDelete) => {                        
                        if (willDelete.value) {                    
                             axios.delete('/vehicles/'+ this.vehicle.slug, {
                            }).then((response) =>{                                                    
                            Swal.fire('Deleted!',
                            'Your vehicle was successfully deleted',
                            'success'
                            ); 
                           // window.location.href='/vehicles/create';                                
                        }).catch((e)=>{
                            this.errors.record(e.response.data.errors);
                            this.message = e.response.data.message;
                            Swal.fire("Failure! "+ this.message, {
                            icon: "error",
                        });                        
                    });
                        } 
                        else if(willDelete.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire('Cancelled',
                                        'Your vehicle is safe',
                                        'error'
                            )
                        }
                    });
                 },         

        },
        mounted(){
    
        }        

    }   
</script>