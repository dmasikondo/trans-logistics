<template>
    <div>
     
    <p>
        <a href=""@click.prevent="userHasBid? deleteBid(): createBidModal()">{{userHasBid? 'UnBid': 'Bid'}} <span class="badge badge-primary">{{numberOfBids}}</span></a>
    </p>  
    <p v-for="bida in bidings">{{bida.available_capacity}}
                      Inserted by {{bida.bidder.organisation}}
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
                                        <select class="form-control" id="trailer_type" v-model="trailer_type" :class="{'is-invalid': errors.hasError('trailer_type')}"  required>
                                            <option value="">Select Type of Trailer</option>
                                            <option v-for="vehicle in trailers" :value ="vehicle.name">{{vehicle.name}}</option>
                                        </select>
                                        <label class="floating-label">Select Trailer Type</label>
                                         <span v-if="errors.hasError('trailer_type')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('trailer_type')}}</strong>
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
                                        <label class="floating-label">Available capacity (tonnes) </label>
                                         <span v-if="errors.hasError('available_capacity')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('available_capacity')}}</strong>
                                        </span>                                
                                    </div> 

                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-road"></i></span> 
                                        </div>
                                        <input type="text" class="form-control" v-model="price" :class="{'is-invalid': errors.hasError('price')}"   required>
                                        <label class="floating-label">Required Price <span class="small text-muted">{{load.carriage_rate}}</span></label>
                                         <span v-if="errors.hasError('price')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('price')}}</strong>
                                        </span>                                
                                    </div> 

                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-flag"></i></span> 
                                        </div>
                                        <select class="form-control" v-model="country_location"  :class="{'is-invalid': errors.hasError('country_location')}"  required>
                                            <option value="">Select Current Vehicle Location</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Congo, The Democratic Republic of the">Congo, The Democratic Republic of the</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                                        <label class="floating-label">Current Vehicle Location</label>
                                         <span v-if="errors.hasError('country_location')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('country_location')}}</strong>
                                        </span>                                
                                    </div>                                     

                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-road"></i></span> 
                                        </div>
                                        <input type="text" class="form-control" v-model="city_location" :class="{'is-invalid': errors.hasError('city_location')}"   required>
                                        <label class="floating-label">Current Vehicle's City Location</label>
                                         <span v-if="errors.hasError('city_location')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('city_location')}}</strong>
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
                userHasBid: false,
                price: '',
                date_available: null,
                available_capacity: '',
                trailer_type: '',
                country_location: '',
                city_location: '',
                trailers: {},
                editMode: false,
                modalTitle: '',
                title: '',
                submitTitle: '',
                numberOfBids: '',
                bidings: {},
                message: '',
                errors: new Errors(),
            }
        },
        props: {
            load: {
                type: Object,
              required: true
            },
        },

        methods:{ 
                getNumberofBids(){
                    axios.get('/bids/'+ this.load.slug+'/total-number').then((response)=>{
                        this.numberOfBids =response.data.numberOfBids;
                        this.bidings = response.data.bidings;
                        this.userHasBid = response.data.userHasBid;
                    });
                },

                createBidModal()
                {
                    axios.get('/alltrailers').then((response)=>{
                    this.trailers = response.data;
                    });                     
                    $('#bidModal').modal('show');
                    this.editMode = false;
                    this.modalTitle ='Make a bid for shipping '+this.load.name;
                    this.title = 'Add bid';
                    this.submitTitle = 'Add bid';
                    this.price = '';            
                    this.date_available = null;
                    this.available_capacity = '';
                    this.trailer_type = '';
                    this.country_location = '';   
                    this.city_location = '';   
                }, 
                createShipmentBid(){
                    axios.post('/bids/'+ this.load.slug,{
                        price: this.price,
                        date_available: this.date_available,
                        available_capacity: this.available_capacity,
                        trailer_type: this.trailer_type,
                        country_location: this.country_location,
                        country_location: this.country_location,
                        city_location: this.city_location,
                    }).then((response) =>{ 
                       // window.location.href='/loads/'+load.slug;
                        this.price = '';            
                        this.date_available = null;
                        this.available_capacity = '';
                        this.trailer_type = '';
                        this.country_location = '';                      
                        this.city_location = '';                      
                        this.message = '';
                        this.errors = new Errors();
                        $('#bidModal').modal('hide');
                        Fire.$emit('afterBidWasUpdated');
                    }).catch((e)=>{
                            this.errors.record(e.response.data.errors);
                            this.message = e.response.data.message;
                     });  
                            
                },        
                 deleteBid(){
                    Swal.fire({
                    title: "Are you sure?",
                    text: "Once Deleted, you will not be able to recover this bid for -- " +this.load.name +"!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText:'Yes, delete it!',
                    cancelButtonText:'No, keep it',
                    }).then((willDelete) => {                        
                        if (willDelete.value) {                    
                             axios.delete('/bids/'+ this.load.slug, {
                            }).then((response) =>{                                                    
                            Swal.fire('Deleted!',
                            'Your bid was successfully deleted',
                            'success'
                            ); 
                            Fire.$emit('afterBidWasUpdated');
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
                                        'Your bid is safe',
                                        'error'
                            )
                        }
                    });
                 },         

        },
        mounted(){
            this.getNumberofBids();
            Fire.$on('afterBidWasUpdated', ()=>{this.getNumberofBids()});
        }        

    }   
</script>