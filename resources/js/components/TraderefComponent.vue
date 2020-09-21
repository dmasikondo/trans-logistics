<template>
	<div class="container">
		<div class="d-flex justify-content-center h-100">

            <div class="row">

                <h1 class="col-md-12">
                    <i class="fa fa-share-alt fa-3x"></i>
                    The Trade References for <small>{{user.organisation}}</small>
                </h1>

                <h2 class="col-md-12 pull-right">

                    <a href="" @click.prevent="createModal">
                        <i class="fa fa-plus text-success"></i> 
                        Add a Trade Reference
                        <i v-if="loading" class="fa fa-spinner fa-pulse"></i>
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
                <div v-for="traderef in traderefs" class="media col-md-4">
                    <span class="circle">{{traderef.name.slice(0,1)}}</span>
                    <div class="media-body">
                        <p>
                           <i class="fa fa-institution"></i> {{traderef.name}} 
                            <a href=""@click.prevent="editModal(traderef)">
                                <i class="fa fa-edit"></i>
                                Edit
                            </a>
                            <a href=""@click.prevent="deletetraderef(traderef)">
                                <i class="fa fa-trash text-danger"></i> 
                                Delete
                                <i v-if="loading" class="fa fa-spinner fa-pulse"></i>
                            </a>                            
                                                                                <br>
                            <i class="fa fa-map-marker"></i> {{traderef.address}}       <br>
                            <i class="fa fa-phone"></i> {{traderef.phone}} 
                        </p>
                    </div>
                </div>  

            </div>

<!-- Modal -->   
                <div class="modal fade modal-lg" id="traderefModal" tabindex="-1" role="dialog" aria-labelledby="traderefModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="traderefModalLabel">{{modalTitle}} <span class="small"> - {{user.organisation}}</span></h4>
                            </div>
                            <form role="form"  @submit.prevent="editMode? edittraderef(): addtraderef()">
                                <div class="modal-body">
                                    <p v-if="errors">
                                        <h6 class="text-danger"><strong>{{message}}</strong></h6>
                                    </p>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-user"></i></span> 
                                        </div>
                                        <input type="text" class="form-control" v-model="name" :class="{'is-invalid': errors.hasError('name')}"  required>
                                        <label class="floating-label">traderef's name</label>
                                         <span v-if="errors.hasError('name')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('name')}}</strong>
                                        </span>                                
                                    </div>                                                        
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-phone"></i></span> 
                                        </div>
                                        <input type="tel" class="form-control" v-model="phone"  :class="{'is-invalid': errors.hasError('phone')}"  required>
                                        <label class="floating-label">traderef's Phone Number</label>
                                         <span v-if="errors.hasError('phone')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('phone')}}</strong>
                                        </span>                                
                                    </div>
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                           <span class="input-group-text"><i class="fa fa-address"></i></span> 
                                        </div>
                                        <input type="text" class="form-control" v-model="address"  :class="{'is-invalid': errors.hasError('address')}"  required>
                                        <label class="floating-label">traderef's Address</label>
                                         <span v-if="errors.hasError('address')" class="invalid-feedback" role="alert">
                                            <strong>{{errors.get('address')}}</strong>
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
                name: '',
                phone: '',
                address: '',
                message: '',
                id:'',
                traderefs: {},
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
                $('#traderefModal').modal('show');
                this.editMode = false;
                this.modalTitle ='Add traderef';
                this.title = 'Add a User';
                this.submitTitle = 'Add traderef';
                this.name = '';
                this.phone = '';
                this.address = '';                
             },
             editModal(traderef){
                $('#traderefModal').modal('show');
                this.editMode = true;
                this.modalTitle ='Edit traderef';
                this.title = 'Edit traderef';
                this.submitTitle = 'Edit traderef';
                this.name = traderef.name;
                this.phone = traderef.phone;
                this.address = traderef.address;
                this.id =traderef.id;
             },           
            loadtraderefs(){
                axios.get('/traderefs/' + this.user.slug, {
                }).then((response) => {
                    this.traderefs = response.data});
            },
            addtraderef(){
                this.loading = true; //the loading begin
                axios.post('/traderefs/'+ this.user.slug,{
                    name: this.name,
                    phone: this.phone,
                    address: this.address, 

                }).then((response) =>{ 
                  //window.location.href='/dashboard/'+this.user.slug; 
                    this.message = '';
                    this.name= '';
                    this.phone = '';
                    this.address =''; 
                    this.errors = new Errors(); 
                    Fire.$emit('AftertraderefWasUpdated');
                    $('#traderefModal').modal('hide');                       
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' traderefs not updated!';                    
                }).finally(() => (this.loading = false)); // set loading to false when request finish

            },

            edittraderef(){
                axios.put('/traderefs/'+ this.id,{
                    name: this.name,
                    phone: this.phone,
                    address: this.address,                   
                }).then((response) =>{ 
                   // window.location.href='/dashboard/'+this.user.slug; 
                    this.message = '';
                    this.name= '';
                    this.phone = '';
                    this.address =''; 
                    this.errors = new Errors(); 
                    Fire.$emit('AftertraderefWasUpdated');
                    $('#traderefModal').modal('hide');                       
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' traderefs not updated!';                    
                }).finally(() => (this.loading = false)); // set loading to false when request finish
            },

            
            deletetraderef(traderef){
                this.loading = true; //the loading begin
                Swal.fire({
                    title: "Are you sure?",
                    text: "Once Deleted, you will not be able to recover the traderef -- " +traderef.name +"!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText:'Yes, delete it!',
                    cancelButtonText:'No, keep it',
                    }).then((willDelete) => {                        
                        if (willDelete.value) {                    
                        axios.delete('/traderefs/'+traderef.id).then((response)=>{
            //            window.location.href='/dashboard/'+this.user.slug; 
                        this.message = ''; 
                        this.errors = new Errors(); 
                    Fire.$emit('AftertraderefWasUpdated');
                    $('#traderefModal').modal('hide');                                
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
                                        'Your Trade Ref is safe',
                                        'error'
                            )
                        }
                    }).finally(() => (this.loading = false)); // set loading to false when request finish;

            },

        },
        mounted(){
            this.loadtraderefs();
            Fire.$on('AftertraderefWasUpdated', () => {this.loadtraderefs()});
        }

    }	
</script>

