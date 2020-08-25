<template>
	<div class="card">
		<h6 v-if="errors">
            <span class="text-danger"><strong>{{message}}</strong></span>
        </h6>		
		<div class = "alert" :class="{'alert-danger': !isPublicVisible, 'alert-success': isPublicVisible}" role="alert">
			This consignment is currently {{!isPublicVisible? 'Not Published. Only admins can see it!' : 'published. All users can view it'}}
		</div>
		<button class ="btn btn-xs btn-light" type = "button" @click.prevent="updatePublicVisibility()"> 
			 {{!isPublicVisible? 'Publish' : 'Unpublish'}}
		</button>		
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
            freight: {
                type: Object,
              //required: true
            },
        },

        methods:{          
            getPublicVisibilityStatus(){
            	if(this.freight.public_visibility ==true)
            	{
            		this.isPublicVisible = true;       		

            	}
            	else{
            		this.isPublicVisible = false;
            	}

            },    

            getNewFreightValue()
            {
                axios.get('/loads/'+this.freight.slug+'/new-freight-value').then((response)=>{
                    this.freight = response.data;
                });
            },         
            updatePublicVisibility(){
                axios.put('/loads/'+ this.freight.slug+'/public-visibility',{
                	public_visibility: !this.isPublicVisible,
                    private_visibility: this.freight.private_visibility,
                }).then((response) =>{ 
                    Fire.$emit('AfterLoadWasUpdated');
                	this.message ='';
                	this.isPublicVisible = !this.isPublicVisible;

                   alert('Successfully Changed Consignment Visibility');                       
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' Consignment Published status not changed!';                    
                });;

            },

        },
		mounted(){
			this.getPublicVisibilityStatus();	
            Fire.$on('AfterLoadWasUpdated', () => {this.getNewFreightValue()});		
		}        

    }	
</script>