<template>
	<div>
	 <h6 v-if="errors">
        <span class="text-danger"><strong>{{message}}</strong></span>
    </h6> 
    <p>
        <a href=""@click.prevent=deleteFreight()>
            <span class="fa fa-trash text-danger"></span> Delete
            <i v-if="loading" class="fa fa-spinner fa-pulse"></i>
        </a>
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
                loading: false,
            }
        },
        props: {
            freight: {
                type: Object,
              required: true
            },
        },

        methods:{          
                 deleteFreight(){
                    this.loading = true, //the loading begin
                    Swal.fire({
                    title: "Are you sure?",
                    text: "Once Deleted, you will not be able to recover this consignment -- " +this.freight.name +"!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText:'Yes, delete it!',
                    cancelButtonText:'No, keep it',
                    }).then((willDelete) => {                        
                        if (willDelete.value) {                    
                             axios.delete('/loads/'+ this.freight.slug, {
                            }).then((response) =>{                                                    
                            Swal.fire('Deleted!',
                            'Your consignment was successfully deleted',
                            'success'
                            ); 
                            window.location.href='/loads/create';                                
                        }).catch((e)=>{
                            this.errors.record(e.response.data.errors);
                            this.message = e.response.data.message;
                            Swal.fire("Failure! "+ this.message, {
                            icon: "error",
                        });                        
                    }).finally(() => (this.loading = false)); // set loading to false when request finish;
                        } 
                        else if(willDelete.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire('Cancelled',
                                        'Your consignment is safe',
                                        'error'
                            )
                        }
                    }).finally(() => (this.loading = false)); // set loading to false when request finish;
                 },         

        },
		mounted(){
	
		}        

    }	
</script>