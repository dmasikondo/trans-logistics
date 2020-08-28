<template>
	<div>
		<h6 v-if="errors">
            <span class="text-danger"><strong>{{message}}</strong></span>
        </h6>	

            <p  v-if="vehicle.public_visibility && vehicle.private_visibility" class="alert alert-info">This vehicle is currently published. All users can see it.
                <a href="" class="pull-right" @click.prevent="updatePublicVisibility">Unpublish</a>
            </p>
            <p v-if="!vehicle.public_visibility  && vehicle.private_visibility"  class="alert alert-danger">This vehicle is currently not public. Only admins can see it
                <a  href="" class="pull-right" @click.prevent="updatePublicVisibility">Publish</a>
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
                isPublicVisible: false,
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
            	if(this.vehicle.public_visibility ===true)
            	{
            		this.isPublicVisible = true;       		

            	}
            	if(this.vehicle.public_visibility ===false)
                {
            		this.isPublicVisible = false;
                }
            }, 

          /*  changeVisibilityState(){
                this.isPrivateVisible = !this.isPrivateVisible;
            }, */
            updatePublicVisibility(){
                axios.put('/vehicles/'+ this.vehicle.slug+'/public-visibility',{
                	//public_visibility: !this.isPublicVisible,
                    public_visibility: !this.vehicle.public_visibility,
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
            /*Fire.$on('afterVehicleWasUpdated', () => {
                this.changeVisibilityState();
            });	*/
            this.getPrivateVisibilityStatus();
		}        

    }	
</script>