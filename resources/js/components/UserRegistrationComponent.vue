<template>
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">        
				<div class="card">                    
					<div class="card-header">
						<h2>Sign Up</h2>
                        <div class="feature-wrap justify-content-center d-flex">
                            <i class="fa fa-unlock-alt"></i>                          
                        </div>                        
					</div>
					<div class="card-body">
                    <div v-if="loading">
<div class="progress">
  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
</div>
                       
                    </div>

                    <div v-else>
                        <!-- request finished -->
                    </div>                        
                        <p v-if="errors">
                            <span class="text-danger">{{message}}</span>
                        </p>
						<form @submit.prevent="userRegistration" class="go-register">

							<div class="form-group input-group">
                                <div class="input-group-prepend">
                                   <span class="input-group-text"><i class="fa fa-user"></i></span> 
                                </div>
                                <input type="text" class="form-control" v-model="organisation" :class="{'is-invalid': errors.hasError('organisation')}" required autocomplete="false">
                                <label class="floating-label">Organisation Name</label>
                                 <span v-if="errors.hasError('organisation')" class="invalid-feedback" role="alert">
                                    <strong>{{errors.get('organisation')}}</strong>
                                </span>                                
                            </div>                                                        
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                   <span class="input-group-text"><i class="fa fa-envelope"></i></span> 
                                </div>
                                <input type="email" class="form-control" v-model="email"  :class="{'is-invalid': errors.hasError('email')}"  required autocomplete="false">
                                <label class="floating-label">Email</label>
                                 <span v-if="errors.hasError('email')" class="invalid-feedback" role="alert">
                                    <strong>{{errors.get('email')}}</strong>
                                </span>                                
                            </div>

                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                   <span class="input-group-text"><i class="fa fa-key"></i></span> 
                                </div>
                                <input type="password" class="form-control" v-model="password"  :class="{'is-invalid': errors.hasError('password')}"  required autocomplete="false">
                                <label class="floating-label">Password</label>
                                 <span v-if="errors.hasError('password')" class="invalid-feedback" role="alert">
                                    <strong>{{errors.get('password')}}</strong>
                                </span>                                
                            </div> 
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                   <span class="input-group-text"><i class="fa fa-key"></i></span> 
                                </div> 
                                <input type="password" class="form-control" v-model="password_confirmation"  :class="{'is-invalid': errors.hasError('password_confirmation')}"  required autocomplete="false">
                                <label class="floating-label">Confirm Password</label>
                                 <span v-if="errors.hasError('password_confirmation')" class="invalid-feedback" role="alert">
                                    <strong>{{errors.get('password_confirmation')}}</strong>
                                </span>                                
                            </div>                            
                            <div class="form-group">
                                <button class="btn btn-lg form-control btn-outline-info" type="submit"> 
                                    <i class="fa fa-lock fa-lg"> </i> 
                                    Register
                                    <i v-if="loading" class="fa fa-spinner fa-pulse"></i>
                                </button>
                            </div>                                                       
						</form>                         
					</div>

                    <div class="card-footer">
                       <div class="d-flex justify-content-center">
                            <span class="links"> Already have an account? </span>
                            <a href="/login"> Login </a>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="#"> Forgot your password?</a>
                        </div>
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
                selection: [],
                organisation: '',
                email: '',
                password: '',
                password_confirmation:'',
                message: '',
                errors: new Errors(),
                loading: false,
            }
        },

        methods:{
            userRegistration(){
                 this.loading = true, //the loading begin
                axios.post('/register',{
                    organisation: this.organisation,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                }).then((response) =>{
                    window.location.href='/home';
                    this.errors = new Errors();
                    this.message = '',
                    this.organisation= '';
                    this.email = '';
                    this.password ='';
                    this.password_confirmation ='';                    
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' User not Registered';                    
                }).finally(() => (this.loading = false)); // set loading to false when request finish;

            },

        }

    }	
</script>

                      