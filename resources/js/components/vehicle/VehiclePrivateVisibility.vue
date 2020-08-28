<template>
	<div>
		<h6 v-if="errors">
            <span class="text-danger"><strong>{{message}}</strong></span>
        </h6>	

            <p v-if="vehicle.private_visibility" class="alert alert-success">This vehicle is available to Transpartner Logistics for moderation and listing
                <a v-if="vehicle.private_visibility && !vehicle.is_published" href="" class="pull-right"  @click.prevent="updatePrivateVisibility()">Make private</a>
            </p>
            <p v-if="!vehicle.private_visibility" class="alert alert-warning">This vehicle is private. Only you can see it
                <a href="" class="pull-right" @click.prevent="updatePrivateVisibility()">Avail for Listing</a>
            </p>	
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
                isPrivateVisible: false,
                message: '',
                errors: new Errors(),
            }
        },
        props: {
            vehicle:{
                type: Object,
                required: true,
            }

        },               
       

        methods:{
          
            getPrivateVisibilityStatus(){
            	if(this.vehicle.private_visibility ==true)
            	{
            		this.isPrivateVisible = true;       		

            	}
            	else{
            		this.isPrivateVisible = false;
            	}

            }, 

          /*  changeVisibilityState(){
                this.isPrivateVisible = !this.isPrivateVisible;
            }, */
            updatePrivateVisibility(){
                axios.put('/vehicles/'+ this.vehicle.slug+'/private-visibility',{
                	private_visibility: !this.isPrivateVisible,
                	'is_published': this.vehicle.is_published,
                }).then((response) =>{ 
                	this.message ='';
                	//this.isPrivateVisible = !this.isPrivateVisible;
                   // Fire.$emit('afterVehicleWasUpdated');
                  // alert('Successfully Changed Vehicle Visibility'); 
                  window.location.href='/vehicles/'+this.vehicle.slug;                      
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' Vehicle Visibility not updated!';                    
                });;

            },

        },
		mounted(){	
            Fire.$on('afterVehicleWasUpdated', () => {
                this.changeVisibilityState();
            });	
            this.getPrivateVisibilityStatus();
		}        

    }	
</script>