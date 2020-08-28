<template>
	<div class="container">
		<div class="d-flex justify-content-center h-100">    


            <form role="form"  @submit.prevent="editMode? editVehicle() : addVehicle()">
                    <p v-if="errors">
                        <h6 class="text-danger"><strong>{{message}}</strong></h6>
                    </p>

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fa fa-truck"></i></span> 
                        </div>
                        <select class="form-control" id="trailer_type" v-model="trailer_type" :class="{'is-invalid': errors.hasError('trailer_type')}"  required>
                            <option value="">Select Trailer Type</option>
                             :class="{'is-invalid': errors.hasError('address')}"
                            <option v-for="trailer_type in trailers" :value ="trailer_type.name">{{trailer_type.name}}</option>
                                                                    </select>
                        <label class="floating-label">Select Trailer Type</label>
                         <span v-if="errors.hasError('trailer_type')" class="invalid-feedback" role="alert">
                            <strong>{{errors.get('trailer_type')}}</strong>
                        </span>                                
                    </div>

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fa fa-flag"></i></span> 
                        </div>
                        <select class="form-control" v-model="load_type"  :class="{'is-invalid': errors.hasError('load_type')}"  required>
                            <option value="LTL">Less Than Truck Load (LTL)</option>
                            <option value="FTL">Full Truck Load (FTL)</option>
                        </select>
                        <label class="floating-label">Required Load Type</label>
                         <span v-if="errors.hasError('load_type')" class="invalid-feedback" role="alert">
                            <strong>{{errors.get('load_type')}}</strong>
                        </span>                                
                    </div>


                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fa fa-trailer"></i></span> 
                        </div>
                        <input type="text" class="form-control" v-model="capacity"  :class="{'is-invalid': errors.hasError('capacity')}"  required>
                        <label class="floating-label">Available Capacity</label>
                         <span v-if="errors.hasError('capacity')" class="invalid-feedback" role="alert">
                            <strong>{{errors.get('capacity')}}</strong>
                        </span>                                
                    </div>

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fa fa-flag"></i></span> 
                        </div>
                        <select class="form-control" v-model="country_from"  :class="{'is-invalid': errors.hasError('country_from')}"  required>
                            <option value="Botswana">Botswana</option>
                            <option value="Congo, The Democratic Republic of the">Congo, The Democratic Republic of the</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="South Africa">South Africa</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                        </select>
                        <label class="floating-label">Country From</label>
                         <span v-if="errors.hasError('country_from')" class="invalid-feedback" role="alert">
                            <strong>{{errors.get('country_from')}}</strong>
                        </span>                                
                    </div> 

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fa fa-tower"></i></span> 
                        </div>
                        <input type="text" class="form-control" v-model="city_from"  :class="{'is-invalid': errors.hasError('city_from')}"  required>
                        <label class="floating-label">City From</label>
                         <span v-if="errors.hasError('city_from')" class="invalid-feedback" role="alert">
                            <strong>{{errors.get('city_from')}}</strong>
                        </span>                                
                    </div>  

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fa fa-flag"></i></span> 
                        </div>
                        <select type="tel" class="form-control" v-model="country_to"  :class="{'is-invalid': errors.hasError('country_to')}"  required>
                            <option value="Botswana">Botswana</option>
                            <option value="Congo, The Democratic Republic of the">Congo, The Democratic Republic of the</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="South Africa">South Africa</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                        </select>
                        <label class="floating-label">Destination Country</label>
                         <span v-if="errors.hasError('country_to')" class="invalid-feedback" role="alert">
                            <strong>{{errors.get('country_to')}}</strong>
                        </span>                                
                    </div> 

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fa fa-tower"></i></span> 
                        </div>
                        <input type="text" class="form-control" v-model="city_to"  :class="{'is-invalid': errors.hasError('city_to')}"  required>
                        <label class="floating-label">Destination City</label>
                         <span v-if="errors.hasError('city_to')" class="invalid-feedback" role="alert">
                            <strong>{{errors.get('city_to')}}</strong>
                        </span>                                
                    </div> 

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fa fa-road"></i></span> 
                        </div>
                        <input type="text" class="form-control" v-model="route"  :class="{'is-invalid': errors.hasError('route')}" >
                        <label class="floating-label">Preferred Route (optional)</label>
                         <span v-if="errors.hasError('route')" class="invalid-feedback" role="alert">
                            <strong>{{errors.get('route')}}</strong>
                        </span>                                
                    </div> 
                      
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fa fa-calender"></i></span> 
                        </div>
                        <input type="date" class="form-control" v-model="available_date"  :class="{'is-invalid': errors.hasError('available_date')}"  required>
                        <label class="floating-label">Availability date</label>
                         <span v-if="errors.hasError('available_date')" class="invalid-feedback" role="alert">
                            <strong>{{errors.get('available_date')}}</strong>
                        </span>                                
                    </div>  

                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fa fa-calender"></i></span> 
                        </div>
                        <textarea class="form-control" v-model="more_details"  :class="{'is-invalid': errors.hasError('more_details')}"></textarea>
                        <label class="floating-label">More Details (optional)</label>
                         <span v-if="errors.hasError('more_details')" class="invalid-feedback" role="alert">
                            <strong>{{errors.get('more_details')}}</strong>
                        </span>                                
                    </div>                     

                    <div class="form-group">
                        <button class="btn btn-primary form-control" type="submit">Upload Vehicle</button>                                            
                    </div>  
            </form>                              

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
                capacity: '',  
                trailer_type: '',
                route: '',
                available_date: null,
                city_from: '',         
                city_to: '',         
                country_from: '',
                country_to: '',
                load_type: '',
                more_details: '',
                trailers:{},
                message: '',
                slug:'',
                loads: {},
                errors: new Errors(),
            }
        },
        props: {
             editMode:{
                type: Boolean,
                required: true,
             },
             vehicle:{
                type: Object,
                required: false,
             }                  
        },

        computed:{
       
        },

        methods:{

            editTheVehicle(){
                if(this.editMode){
                    this.capacity = this.vehicle.capacity;
                    this.trailer_type = this.vehicle.trailer_type;
                    this.route = this.vehicle.route;
                    this.capacity = this.vehicle.capacity;
                    this.city_to = this.vehicle.city_to;
                    this.city_from = this.vehicle.city_from;
                    this.country_from = this.vehicle.country_from;
                    this.country_to = this.vehicle.country_to;
                    this.load_type = this.vehicle.load_type;
                    this.available_date = moment(this.vehicle.available_date).format('YYYY-MM-DD');
                    this.more_details = this.vehicle.more_details;
                }

            },
    
            showTrailers()
             {
                axios.get('/alltrailers').then((response)=>{
                this.trailers = response.data;
                });                 
            },
            addVehicle(){
                axios.post('/vehicles',{
                        capacity: this.capacity,
                        trailer_type: this.trailer_type,
                        route: this.route,
                        available_date: this.available_date,
                        city_from: this.city_from,
                        city_to: this.city_to,
                        country_from: this.country_from,
                        country_to: this.country_to,
                        load_type: this.load_type,
                        more_details: this.more_details,
                }).then((response) =>{ 
                    window.location.href='/vehicles/'+response.data;
                    this.capacity ='';
                    this.trailer_type ='';
                    this.route ='';
                    this.available_date ='';
                    this.city_from ='';
                    this.city_to ='';
                    this.country_from ='';
                    this.country_to ='';
                    this.load_type ='';
                    this.more_details = '';
                    this.message = '';
                    this.errors = new Errors();                      
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' Vehicle not uploaded!';                    
                });

            },

            editVehicle(){
                axios.put('/vehicles/'+this.vehicle.slug,{
                    capacity: this.capacity,
                    trailer_type: this.trailer_type,
                    route: this.route,
                    available_date: this.available_date,
                    city_from: this.city_from,
                    city_to: this.city_to,
                    country_from: this.country_from,
                    country_to: this.country_to,
                    load_type: this.load_type,
                    more_details: this.more_details,
                }).then((response) =>{ 
                    window.location.href='/vehicles/'+this.vehicle.slug;                  
                    this.message = '';
                    this.errors = new Errors();                      
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' Vehicle not uploaded!';                    
                });
            },

          /*  deleteload(load){
                axios.delete('/loads/'+load.slug).then((response)=>{
                    window.location.href='/dashboard/'+this.user.slug; 
                    this.message = ''; 
                    this.errors = new Errors(); 
                    Fire.$emit('AfterloadWasUpdated');
                    $('#loadModal').modal('hide');                     
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' Consignment not deleted!';                    
                });
            },*/

        },
        mounted(){
            this.showTrailers();
            this.editTheVehicle();
          //  Fire.$on('AfterloadWasUpdated', () => {this.loadloads()});
        }

    }	
</script>

