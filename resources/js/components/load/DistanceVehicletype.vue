<template>
	<div class="card">		
		<div v-if="!hasDistance || !hasVehicleType" class = "alert alert-success" role="alert">
			Are you aware of the actual distance or vehicle type?  You may want to 
            <a href="" @click.prevent="updateDistanceModal"> Update</a>
		</div>	
        <div v-else>
            You may want to <a href="" @click.prevent="updateDistanceModal"> Change</a> values for distance or vehicle type
        </div>	
<!-- Modal -->   
                <div class="modal fade modal-lg" id="distanceVehicleModal" tabindex="-1" role="dialog" aria-labelledby="distanceVehicleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="distanceVehicleModalLabel">{{modalTitle}}</h4>
                            </div>
                            <form role="form"  @submit.prevent="updateDistanceVehicle">
                                <div class="modal-body">
                                    <p v-if="errors">
                                        <h6 class="text-danger"><strong>{{message}}</strong></h6>
                                    </p>

                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-road"></i></span> 
                                        </div>
                                        <input type="distance" class="form-control" v-model="distance" :class="{'is-invalid': errors.hasError('distance')}"   required>
                                        <label class="floating-label">Distance in Km</label>
                                         <span v-if="errors.hasError('distance')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('distance')}}</strong>
                                        </span>                                
                                    </div> 

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
                vehicleType: null,
                distance: null,
                hasVehicleType: false,
                hasDistance: false,
                editMode: false,
                modalTitle: '',
                title: '',
                submitTitle: '',
                trailers: {},
                message: '',
                errors: new Errors(),
            }
        },
        props: {
            freight: {
                type: Object,
              required: true
            },
        },

        methods:{          
            getVehicleTypeAndDistanceStatus(){
                if(this.freight.distance != null)
                {
                    this.hasDistance = true;            
                    this.distance = this.freight.distance;    
                }
            	if(this.freight.vehicle_type == null)
            	{
            		this.hasVehicleType = false;      		

            	}
                if(this.freight.vehicle_type !=null)
                {
                    this.hasVehicleType = true; 
                    this.vehicleType = this.freight.vehicle_type;          

                }                
                if(this.freight.distance == null)
                {
                    this.hasDistance = false;            

                } 
             

            }, 

            updateDistanceModal(){
                axios.get('/alltrailers').then((response)=>{
                this.trailers = response.data;
                });                 
                $('#distanceVehicleModal').modal('show');
                this.getVehicleTypeAndDistanceStatus();
                this.editMode = false;
                this.modalTitle ='Add Distance or Vehicle';
                this.title = 'Add Distance/Trailer';
                this.submitTitle = 'Update'; 
                this.errors = new Errors();
                this.message = '';     
            }, 

            updateDistanceVehicle(){
                axios.put('/loads/'+this.freight.slug+'/distance-trailer',{
                    vehicle_type: this.vehicleType,
                    distance: this.distance,
                }).then((response) =>{
                    window.location.href='/loads/'+this.freight.slug;
                    this.errors = new Errors();
                    this.message = '';                      
                    $('#distanceVehicleModal').modal('hide');
                });
            }, 
        },
		mounted(){
			this.getVehicleTypeAndDistanceStatus()	
		}        

    }	
</script>