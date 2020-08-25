<template>
	<div>
		<h6 v-if="errors">
            <span class="text-danger"><strong>{{message}}</strong></span>
        </h6>		
		<div  v-if="!freight.is_published" class = "alert" :class="{'alert-danger': !isPrivateVisible, 'alert-success': isPrivateVisible}" role="alert">
			Your consignment is currently {{!isPrivateVisible? 'private. Only you can see it!' : 'public. It is available to Transpartner Logistics for moderation and listing'}}
		</div>
		<button  v-if="!freight.is_published" class ="btn btn-xs btn-light" type = "button" @click.prevent="updatePrivateVisibility()"> 
			 {{!isPrivateVisible? 'Avail it for listing' : 'Unlist Consignment'}}
		</button>
		<p  v-if="freight.is_published" class="alert alert-info">The consignment was submitted for moderation and listing</p>		
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
        props: [
                'freight',
        ],

        methods:{
          
            getPrivateVisibilityStatus(){
            	if(this.freight.private_visibility ==true)
            	{
            		this.isPrivateVisible = true;       		

            	}
            	else{
            		this.isPrivateVisible = false;
            	}

            },             
            updatePrivateVisibility(){
                axios.put('/loads/'+ this.freight.slug+'/private-visibility',{
                	private_visibility: !this.isPrivateVisible,
                	'is_published': this.freight.is_published,
                }).then((response) =>{ 
                	this.message ='';
                	this.isPrivateVisible = !this.isPrivateVisible;
                   alert('Successfully Changed Consignment Visibility');                       
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' Consignment Visibility not updated!';                    
                });;

            },

        },
		mounted(){
			this.getPrivateVisibilityStatus();			
		}        

    }	
</script>