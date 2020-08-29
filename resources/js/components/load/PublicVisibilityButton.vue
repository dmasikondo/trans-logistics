<template>
    <div>
        <h6 v-if="errors">
            <span class="text-danger"><strong>{{message}}</strong></span>
        </h6>   

            <p  v-if="load.public_visibility && load.private_visibility" class="alert alert-info">This consignment is currently published. All users can see it.
                <a href="" class="pull-right" @click.prevent="updatePublicVisibility">Unpublish</a>
            </p>
            <p v-if="!load.public_visibility  && load.private_visibility"  class="alert alert-danger">This consignment is currently not public. Only admins can see it
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
            load:{
                type: Object,
                required: true,
            }

        },               
       

        methods:{
          
            getPrivateVisibilityStatus(){
                if(this.load.public_visibility ===true)
                {
                    this.isPublicVisible = true;            

                }
                if(this.load.public_visibility ===false)
                {
                    this.isPublicVisible = false;
                }
            }, 

          /*  changeVisibilityState(){
                this.isPrivateVisible = !this.isPrivateVisible;
            }, */
            updatePublicVisibility(){
                axios.put('/loads/'+ this.load.slug+'/public-visibility',{
                    //public_visibility: !this.isPublicVisible,
                    public_visibility: !this.load.public_visibility,
                }).then((response) =>{ 
                    this.message ='';
                    //this.isPrivateVisible = !this.isPrivateVisible;
                   // Fire.$emit('afterloadWasUpdated');
                  // alert('Successfully Changed load Visibility'); 
                  window.location.href='/loads/'+this.load.slug;                      
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' load Visibility not updated!';                    
                });;

            },

        },
        mounted(){  
            /*Fire.$on('afterloadWasUpdated', () => {
                this.changeVisibilityState();
            }); */
            this.getPrivateVisibilityStatus();
        }        

    }   
</script>