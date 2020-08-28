<template>
	<div>
	 <h6 v-if="errors">
        <span class="text-danger"><strong>{{message}}</strong></span>
    </h6> 
    <p>
        <a href=""@click.prevent=deleteVehicle()><span class="fa fa-trash text-danger"></span> Delete</a>
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
                 deleteVehicle(){
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