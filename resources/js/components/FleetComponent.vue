<template>
	<div class="container">
		<div class="d-flex justify-content-center h-100">

            <div class="row">

                <h1 class="col-md-12">
                    <i class="fa fa-share-alt fa-3x"></i>
                    The Fleet Details for <small>{{user.organisation}}</small>
                </h1>

                <h2 class="col-md-12 pull-right">

                    <a  v-if="!fleets.length" href="" @click.prevent="createModal">
                        <i class="fa fa-plus text-success"></i> 
                        Add Fleet Information
                    </a>
                </h2>                
                <h2 class="col-md-12">
                    <span class="pull-right">
                        <a :href="'/dashboard/' + user.slug">
                            <i class="fa fa-chevron-left text-success"></i> 
                            Back
                        </a>                            
                    </span>
                </h2>
                <div v-for="fleet in fleets" class="media col-md-4">
                    <span class="circle">T</span>
                    <div class="media-body">
                        <p>
                           <i class="fa fa-bus fa-x2"></i> {{fleet.number_of_horses}} horses <br>
                           <i class="fa fa-truck fa-x2"></i> {{fleet.number_of_trailers}} trailers -

                           <span v-for="trailer in fleet.trailers"> {{trailer.name}} </span> 

                        </p>
                        <p class="text-right">
                            <a href=""@click.prevent="editModal(fleet)">
                                <i class="fa fa-edit"></i>
                                Edit
                            </a>
                            <a href=""@click.prevent="deletefleet(fleet)">
                                <i class="fa fa-trash text-danger"></i> 
                                Delete
                                <i v-if="loading" class="fa fa-spinner fa-pulse"></i>
                            </a>                            
                        </p>
                    </div>
                </div>  

            </div>

<!-- Modal -->   
                <div class="modal fade modal-lg" id="fleetModal" tabindex="-1" role="dialog" aria-labelledby="fleetModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="fleetModalLabel">{{modalTitle}} <span class="small"> - {{user.organisation}}</span></h4>
                            </div>
                            <form role="form"  @submit.prevent="editMode? editfleet(): addfleet()">
                                <div class="modal-body">
                                    <p v-if="errors">
                                        <h6 class="text-danger"><strong>{{message}}</strong></h6>
                                    </p>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-truck"></i></span> 
                                        </div>
                                        <input type="number" class="form-control" v-model="number_of_horses" :class="{'is-invalid': errors.hasError('number_of_horses')}"  required>
                                        <label class="floating-label">Number of horses</label>
                                         <span v-if="errors.hasError('number_of_horses')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('number_of_horses')}}</strong>
                                        </span>                                
                                    </div>                                                        
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-trailer"></i></span> 
                                        </div>
                                        <input type="tel" class="form-control" v-model="number_of_trailers"  :class="{'is-invalid': errors.hasError('number_of_trailers')}"  required>
                                        <label class="floating-label">Number of trailers</label>
                                         <span v-if="errors.hasError('number_of_trailers')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('number_of_trailers')}}</strong>
                                        </span>                                
                                    </div>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-flag"></i></span> 
                                        </div>
                                        <select v-model="trailer_type" name="trailer_type[]" class="form-control" :class="{'is-invalid': errors.hasError('trailer_type')}" id="trailer_type" multiple="multiple">
                                            <option></option>
                                            <option v-for="trailer in trailers" :value="trailer.id">{{trailer.name}}</option>
                                        </select>                                            
                                        <label class="floating-label">Trailer Type</label>
                                         <span v-if="errors.hasError('trailer_type')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('country')}}</strong>
                                        </span>                                
                                    </div>  

                                </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" type="submit">
                                            {{submitTitle}}
                                            <i v-if="loading" class="fa fa-spinner fa-pulse"></i>
                                        </button>                                            
                                    </div>  
                            </form>                              
                        </div>
                     </div>
                </div>          
            <!-- end of modal -->                 
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
                modalTitle: '',
                submitTitle: '',
                editMode: false,
                number_of_horses: '',
                number_of_trailers: '',
                trailers:{},
                trailer_type: [],
                message: '',
                id:'',
                fleets: {},
                errors: new Errors(),
                loading: false,
            }
        },
        props: [
                'user',
        ],

        methods:{
            createModal()
             {
                axios.get('/alltrailers').then((response)=>{
                this.trailers = response.data;
                });                 
                $('#fleetModal').modal('show');
                this.editMode = false;
                this.modalTitle ='Add Fleet Information';
                this.title = 'Add fleet';
                this.submitTitle = 'Add Fleet';
                this.number_of_horses = '';
                this.number_of_trailers = '';
                this.trailer_type = [];    
                this.errors = new Errors();
                this.message = '';            
             },
             editModal(fleet){
                axios.get('/alltrailers').then((response)=>{
                this.trailers = response.data;
                });                 
                $('#fleetModal').modal('show');
                this.editMode = true;
                this.modalTitle ='Edit Fleet Information';
                this.title = 'Edit Fleet';
                this.submitTitle = 'Edit Fleet';
                this.number_of_horses = fleet.number_of_horses;
                this.number_of_trailers = fleet.number_of_trailers;
                this.id =fleet.id;
                this.errors = new Errors();
                this.message = '';                  
             },           
            loadfleets(){
                axios.get('/fleets/' + this.user.slug, {
                }).then((response) => {
                    this.fleets = response.data});
            },
            addfleet(){
                this.loading = true; //the loading begin
                axios.post('/fleets/'+ this.user.slug,{
                    number_of_horses: this.number_of_horses,
                    number_of_trailers: this.number_of_trailers,
                    trailer_type: this.trailer_type, 

                }).then((response) =>{ 
                  //   window.location.href='/dashboard/'+this.user.slug; 
                    this.loading = false;
                    this.message = '';
                    this.number_of_horses= '';
                    this.number_of_trailers = '';
                    this.errors = new Errors(); 
                    Fire.$emit('AfterFleetWasUpdated');
                    $('#fleetModal').modal('hide');                       
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' Location not updated!';                    
                });

            },

            editfleet(){
                axios.put('/fleets/'+ this.id,{
                    number_of_horses: this.number_of_horses,
                    number_of_trailers: this.number_of_trailers,
                     trailer_type: this.trailer_type,                   
                }).then((response) =>{ 
                  //  window.location.href='/dashboard/'+this.user.slug; 
                    this.loading = false;
                    this.message = '';
                    this.number_of_horses= '';
                    this.number_of_trailers = '';
                    this.errors = new Errors(); 
                    Fire.$emit('AfterFleetWasUpdated');
                    $('#fleetModal').modal('hide');                       
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' Location not updated!';                    
                });
            },

            deletefleet(fleet){
                this.loading = true; //the loading begin
                Swal.fire({
                    title: "Are you sure?",
                    text: "Once Deleted, you will not be able to recover this fleet information",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText:'Yes, delete it!',
                    cancelButtonText:'No, keep it',
                    }).then((willDelete) => {                        
                        if (willDelete.value) {                    
                        axios.delete('/fleets/'+fleet.id).then((response)=>{
            //            window.location.href='/dashboard/'+this.user.slug; 
                        this.message = ''; 
                        this.errors = new Errors(); 
                    Fire.$emit('AfterFleetWasUpdated');
                    this.loading = false;
                    $('#fleetModal').modal('hide');                              
                        }).catch((e)=>{
                            this.errors.record(e.response.data.errors);
                            this.message = e.response.data.message;
                            Swal.fire("Failure! "+ this.message, {
                            icon: "error",
                        });                        
                    }).finally(() => (this.loading = false)); // set loading to false when request finish
                        } 
                        else if(willDelete.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire('Cancelled',
                                        'Your director is safe',
                                        'error'
                            )
                        }
                    }).finally(() => (this.loading = false)); // set loading to false when request finish;

            },

        },
        mounted(){
            this.loadfleets();
            Fire.$on('AfterFleetWasUpdated', () => {this.loadfleets()});
        }

    }	
</script>

