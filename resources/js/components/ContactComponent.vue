<template>
	<div class="container">
		<div class="d-flex justify-content-center h-100">
				<div class="card">
					<div class="card-header">
						<h3>Add Organisation's Link Persons Contact Details</h3>
					</div>
					<div class="card-body">

						<form @submit.prevent="">
                            <p v-if="errors.length">
                                <span class="text-danger">{{message}}</span>
                            </p>
							<div class="form-group input-group">
                                <div class="input-group-prepend">
                                   <span class="input-group-text"><i class="fa fa-user"></i></span> 
                                </div>
                                <input type="text" class="form-control" v-model="person" :class="{'is-invalid': errors.hasError('person')}"  required>
                                <label class="floating-label">Contact Person</label>
                                 <span v-if="errors.hasError('person')" class="invalid-feedback" role="alert">
                                    <strong>{{errors.get('person')}}</strong>
                                </span>                                
                            </div>                                                        
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                   <span class="input-group-text"><i class="fa fa-phone"></i></span> 
                                </div>
                                <input type="text" class="form-control" v-model="phone"  :class="{'is-invalid': errors.hasError('phone')}"  required>
                                <label class="floating-label">Contact Phone Number</label>
                                 <span v-if="errors.hasError('phone')" class="invalid-feedback" role="alert">
                                    <strong>{{errors.get('phone')}}</strong>
                                </span>                                
                            </div>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                   <span class="input-group-text"><i class="fa fa-whatsapp"></i></span> 
                                </div>
                                <input type="text" class="form-control" v-model="whatsapp"  :class="{'is-invalid': errors.hasError('whatsapp')}"  required>
                                <label class="floating-label">WhatsApp Number (Optional)</label>
                                 <span v-if="errors.hasError('whatsapp')" class="invalid-feedback" role="alert">
                                    <strong>{{errors.get('whatsapp')}}</strong>
                                </span>                                
                            </div>                            
                            <div class="form-group">
                                <button class="btn-info form-control" type="submit">Add</button>
                            </div>                                                       
						</form>
					</div>

                    <div class="card-footer">
                       <div class="d-flex justify-content-center">
                            Add Another Contact
                        </div>
                    </div> 

				</div>
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
                person: '',
                phone: '',
                whatsapp: '',
                password_confirmation:'',
                message: '',
                errors: new Errors(),
            }
        },
        props: [
                'user',
        ],

        methods:{
            userRegistration(){
                axios.post('/contacts',{
                    person: this.person,
                    phone: this.phone,
                    whatsapp: this.whatsapp,
                }).then((response) =>{
                   // window.location.href='/home';
                    this.errors = new Errors();
                    this.person= '';
                    this.phone = '';
                    this.whatsapp ='';                    
                }).catch(e =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' User not Registered';                    
                });

            },

        }

    }	
</script>


                      