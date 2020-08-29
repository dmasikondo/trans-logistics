<template>
	<div class="container">
		<div class="d-flex justify-content-center h-100">              
                          
        <form role="form"  @submit.prevent="editMode? editload(): addload()">
           
                <p v-if="errors">
                    <h6 class="text-danger"><strong>{{message}}</strong></h6>
                </p>

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fa fa-truck"></i></span> 
                    </div>
                    <select class="form-control" id="transport_mode" v-model="transport_mode" :class="{'is-invalid': errors.hasError('transport_mode')}"  required>
                        <option value="">Select Transport Mode</option>
                        <option value ="air freight">Air Freight</option>
                        <option value ="rail freight">Rail Freight</option>
                        <option value ="road freight">Road Freight</option>
                        <option value ="sea freight">Sea Freight</option>
                    </select>
                    <label class="floating-label">Mode of Transport</label>
                     <span v-if="errors.hasError('transport_mode')" class="invalid-feedback" role="alert">
                        <strong>{{errors.get('transport_mode')}}</strong>
                    </span>                                
                </div>

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fa fa-truck"></i></span> 
                    </div>
                    <select class="form-control" id="category" v-model="category_type" :class="{'is-invalid': errors.hasError('category_type')}"  required>
                        <option value="">Select Consignment Category</option>
                        <option v-for="category in categories" :value ="category.id" :selected="category.name == category_type? 'selected' : ''">{{category.name}}</option>
                                                                </select>
                    <label class="floating-label">Select Consignment Category</label>
                     <span v-if="errors.hasError('category_type')" class="invalid-feedback" role="alert">
                        <strong>{{errors.get('category')}}</strong>
                    </span>                                
                </div>

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fa fa-trailer"></i></span> 
                    </div>
                    <input type="tountry" class="form-control" v-model="name"  :class="{'is-invalid': errors.hasError('name')}"  required>
                    <label class="floating-label">Name of Consignment</label>
                     <span v-if="errors.hasError('name')" class="invalid-feedback" role="alert">
                        <strong>{{errors.get('name')}}</strong>
                    </span>                                
                </div>

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fa fa-trailer"></i></span> 
                    </div>
                    <input type="text" class="form-control" v-model="size"  :class="{'is-invalid': errors.hasError('size')}"  required>
                    <label class="floating-label">Weight/Volume per item</label>
                     <span v-if="errors.hasError('size')" class="invalid-feedback" role="alert">
                        <strong>{{errors.get('size')}}</strong>
                    </span>                                
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fa fa-trailer"></i></span> 
                    </div>
                    <input type="number" class="form-control" v-model="quantity"  :class="{'is-invalid': errors.hasError('quantity')}"  required>
                    <label class="floating-label">No. of Items</label>
                     <span v-if="errors.hasError('quantity')" class="invalid-feedback" role="alert">
                        <strong>{{errors.get('quantity')}}</strong>
                    </span>                                
                </div>

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fa fa-trailer"></i></span> 
                    </div>
                    <input type="number" class="form-control" v-model="containers"  :class="{'is-invalid': errors.hasError('containers')}"  required>
                    <label class="floating-label">No. of Containers (optional)</label>
                     <span v-if="errors.hasError('containers')" class="invalid-feedback" role="alert">
                        <strong>{{errors.get('containers')}}</strong>
                    </span>                                
                </div>                                    

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fa fa-road"></i></span> 
                    </div>
                    <input type="text" class="form-control" v-model="pickup_street"  :class="{'is-invalid': errors.hasError('pickup_street')}"  required>
                    <label class="floating-label">Pickup Address</label>
                     <span v-if="errors.hasError('pickup_street')" class="invalid-feedback" role="alert">
                        <strong>{{errors.get('pickup_street')}}</strong>
                    </span>                                
                </div>  

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fa fa-tower"></i></span> 
                    </div>
                    <input type="text" class="form-control" v-model="pickup_city"  :class="{'is-invalid': errors.hasError('pickup_city')}"  required>
                    <label class="floating-label">Pickup City</label>
                     <span v-if="errors.hasError('pickup_city')" class="invalid-feedback" role="alert">
                        <strong>{{errors.get('pickup_city')}}</strong>
                    </span>                                
                </div>                                                                      

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fa fa-flag"></i></span> 
                    </div>
                    <select type="tel" class="form-control" v-model="pickup_country"  :class="{'is-invalid': errors.hasError('pickup_country')}"  required>
                        <option value="Botswana">Botswana</option>
                        <option value="Congo, The Democratic Republic of the">Congo, The Democratic Republic of the</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="South Africa">South Africa</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                    <label class="floating-label">Pickup Country</label>
                     <span v-if="errors.hasError('pickup_country')" class="invalid-feedback" role="alert">
                        <strong>{{errors.get('pickup_country')}}</strong>
                    </span>                                
                </div> 


                <div class="form-group input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fa fa-road"></i></span> 
                    </div>
                    <input type="text" class="form-control" v-model="destination_street"  :class="{'is-invalid': errors.hasError('destination_street')}"  required>
                    <label class="floating-label">destination Address</label>
                     <span v-if="errors.hasError('destination_street')" class="invalid-feedback" role="alert">
                        <strong>{{errors.get('destination_street')}}</strong>
                    </span>                                
                </div>  

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fa fa-tower"></i></span> 
                    </div>
                    <input type="text" class="form-control" v-model="destination_city"  :class="{'is-invalid': errors.hasError('destination_city')}"  required>
                    <label class="floating-label">destination City</label>
                     <span v-if="errors.hasError('destination_city')" class="invalid-feedback" role="alert">
                        <strong>{{errors.get('destination_city')}}</strong>
                    </span>                                
                </div>                                                            

                    <div class="form-group input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fa fa-flag"></i></span> 
                    </div>
                    <select type="tel" class="form-control" v-model="destination_country"  :class="{'is-invalid': errors.hasError('destination_country')}"  required>
                        <option value="Botswana">Botswana</option>
                        <option value="Congo, The Democratic Republic of the">Congo, The Democratic Republic of the</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="South Africa">South Africa</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                    <label class="floating-label">Destination Country</label>
                     <span v-if="errors.hasError('destination_country')" class="invalid-feedback" role="alert">
                        <strong>{{errors.get('destination_country')}}</strong>
                    </span>                                
                </div> 
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fa fa-calender"></i></span> 
                    </div>
                    <input type="date" class="form-control" v-model="pickup_date"  :class="{'is-invalid': errors.hasError('pickup_date')}" required>
                    <label class="floating-label">Preferred Pickup Date</label>
                     <span v-if="errors.hasError('pickup_date')" class="invalid-feedback" role="alert">
                        <strong>{{errors.get('pickup_date')}}</strong>
                    </span>                                
                </div>                                     

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fa fa-calender"></i></span> 
                    </div>
                    <input type="date" class="form-control" v-model="destination_date"  :class="{'is-invalid': errors.hasError('destination_date')}"  required>
                    <label class="floating-label">Expected Arrival Date</label>
                     <span v-if="errors.hasError('destination_date')" class="invalid-feedback" role="alert">
                        <strong>{{errors.get('destination_date')}}</strong>
                    </span>                                
                </div>

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fa fa-road"></i></span> 
                    </div>
                    <input type="text" class="form-control" v-model="preferred_route"  :class="{'is-invalid': errors.hasError('preferred_route')}" >
                    <label class="floating-label">Preferred Route (optional)</label>
                     <span v-if="errors.hasError('preferred_route')" class="invalid-feedback" role="alert">
                        <strong>{{errors.get('preferred_route')}}</strong>
                    </span>                                
                </div> 

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fa fa-truck"></i></span> 
                    </div>
                    <select class="form-control" id="carriage_rate" v-model="carriage_rate" :class="{'is-invalid': errors.hasError('carriage_rate')}"  required>
                        <option value="">Carriage Rate</option>
                        <option value ="cost_per_km">Cost per Km</option>
                        <option value ="cost_for_whole_journey">Cost for the whole journey</option>
                        <option value ="request_a_quote">Request a Quote</option>
                    </select>
                    <label class="floating-label">Carriage Rate</label>
                     <span v-if="errors.hasError('carriage_rate')" class="invalid-feedback" role="alert">
                        <strong>{{errors.get('carriage_rate')}}</strong>
                    </span>                                
                </div>                                   

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fa fa-dollar"></i></span> 
                    </div>
                    <input type="text" class="form-control" v-model="amount"  :class="{'is-invalid': errors.hasError('amount')}" >
                    <label class="floating-label">Carriage amount offered US$ (optional)</label>
                     <span v-if="errors.hasError('amount')" class="invalid-feedback" role="alert">
                        <strong>{{errors.get('amount')}}</strong>
                    </span>                                
                </div> 

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fa fa-truck"></i></span> 
                    </div>
                    <select class="form-control" id="payment_option" v-model="payment_option" :class="{'is-invalid': errors.hasError('payment_option')}"  required>
                        <option value="">Payment Options</option>
                        <option value ="cash on delivery">Cash on Delivery</option>
                        <option value="deposit and balance after 3 days">Deposit and balance after 3 days</option>
                        <option value="deposit and balance after 7 days">Deposit and balance after 7 days</option>
                        <option value="deposit and balance after 14 days">Deposit and balance after 14 days</option>
                        <option value="deposit and balance after 30 days">Deposit and balance after 30 days</option>
                    </select>
                    <label class="floating-label">Payment Options</label>
                     <span v-if="errors.hasError('payment_option')" class="invalid-feedback" role="alert">
                        <strong>{{errors.get('payment_option')}}</strong>
                    </span>                                
                </div>


                <div class="form-group input-group">
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fa fa-dollar"></i></span> 
                    </div>
                    <textarea rows="2" type="text" class="form-control" v-model="requirements"  :class="{'is-invalid': errors.hasError('requirements')}"></textarea>
                    <label class="floating-label">Any other requirements (optional)</label>
                     <span v-if="errors.hasError('requirements')" class="invalid-feedback" role="alert">
                        <strong>{{errors.get('requirements')}}</strong>
                    </span>                                
                </div>                                     

                <div class="form-group">
                    <button class=" form-control btn btn-primary" type="submit">{{submitTitle}}</button>                                            
                </div>  
                </form>                     
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
                submitTitle: 'Upload Consignment',
                transport_mode: '',
                name:'',
                size:'',
                pickup_street: '',
                pickup_city: '',
                pickup_country: '',
                destination_street: '',
                destination_city: '',
                destination_country: '', 
                pickup_date: '', 
                destination_date: '', 
                preferred_route:'',
                carriage_rate:'',
                quantity:'', 
                containers:'',
                amount: '', 
                payment_option: '',
                load_slug:'',
                requirements: '',            
                categories:{},
                category_type: [],
                message: '',
                slug:'',
                loads: {},
                errors: new Errors(),
            }
        },
        props: {
             editMode:{
                type: Boolean,
                required: true,
             },

            freight: {
                type: Object,
              required: false,
            },

            user: {
                type: Object,
              required: true,
            },                        
        },

        computed:{
            selectedCategory(){
                if(this.editMode){
                    for(let i=0; i<this.freight.categories.length; i++){
                    return this.freight.categories[i].name;
                    }  
                }
              
            },
        },

        methods:{
            formatTheDate() {
                this.pickup_date = moment(this.pickup_date).format('MM/DD/YYYY');
            },            
             getAllCategories(){
                axios.get('/allcategories').then((response)=>{
                this.categories = response.data;
                }); 

                 if(this.editMode){
                    this.title = 'Edit Consignment';
                    this.submitTitle = 'Edit Consignment';
                    this.transport_mode = this.freight.transport_mode;
                    this.name = this.freight.name;
                    this.size = this.freight.size;
                    this.pickup_street = this.freight.pickup_street;
                    this.pickup_city = this.freight.pickup_city;
                    this.pickup_country = this.freight.pickup_country;
                    this.destination_street = this.freight.destination_street;
                    this.destination_city = this.freight.destination_city;
                    this.destination_country = this.freight.destination_country;
                    this.pickup_date  = moment(this.freight.pickup_date).format('YYYY-MM-DD');
                    this.destination_date = moment(this.freight.destination_date).format('YYYY-MM-DD');
                    this.preferred_route = this.freight.preferred_route;
                    this.quantity = this.freight.quantity;
                    this.containers = this.freight.containers;
                    this.carriage_rate = this.freight.carriage_rate;
                    this.requirements =this.freight.requirements;
                    this.amount = this.freight.amount;
                    this.payment_option = this.freight.payment_option;
                    this.id =this.freight.id;
                    this.errors = new Errors();
                    this.message = '';                  
                 }                                  
             }, 
            addload(){
                axios.post('/loads/'+this.user.slug,{
                        name: this.name,
                        size: this.size,
                        transport_mode: this.transport_mode,
                        pickup_street: this.pickup_street,
                        pickup_city: this.pickup_city,
                        pickup_country: this.pickup_country,
                        destination_street: this.destination_street,
                        destination_country: this.destination_country,
                        destination_city: this.destination_city,
                        pickup_date: this.pickup_date,
                        destination_date: this.destination_date,
                        preferred_route: this.preferred_route,
                        quantity: this.quantity,
                        containers: this.containers,
                        carriage_rate: this.carriage_rate,
                        amount: this.amount,
                        requirements: this.requirements,
                        payment_option: this.payment_option,
                        category_type: this.category_type, 

                }).then((response) =>{ 
                    window.location.href='/loads/'+response.data;
                    this.message = '';
                    this.transport_mode = '';
                    this.name = '';
                    this.size = '';
                    this.pickup_street = '';
                    this.pickup_city = '';
                    this.pickup_country = '';
                    this.destination_street = '';
                    this.destination_city = '';
                    this.destination_country = '';
                    this.pickup_date ='';
                    this.destination_date ='';
                    this.preferred_route = '';
                    this.quantity = '';
                    this.containers = '';
                    this.requirements = '';
                    this.carriage_rate ='';
                    this.amount = '';
                    this.payment_option ='';
                    this.errors = new Errors();                     
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' Consignment not uploaded!';                    
                });

            },

            editload(){
                axios.put('/loads/'+ this.freight.slug,{
                        name: this.name,
                        size: this.size,
                        transport_mode: this.transport_mode,
                        pickup_street: this.pickup_street,
                        pickup_city: this.pickup_city,
                        pickup_country: this.pickup_country,
                        destination_street: this.destination_street,
                        destination_country: this.destination_country,
                        destination_city: this.destination_city,
                        pickup_date: this.pickup_date,
                        destination_date: this.destination_date,
                        preferred_route: this.preferred_route,
                        quantity: this.quantity,
                        containers: this.containers,
                        amount: this.amount,
                        payment_option: this.payment_option,
                        carriage_rate: this.carriage_rate,
                        requirements: this.requirements,
                        category_type: this.category_type,                   
                }).then((response) =>{ 
                    window.location.href='/loads/'+this.freight.slug; 
                    this.message = '';
                    this.transport_mode = '';
                    this.name = '';
                    this.size = '';
                    this.pickup_street = '';
                    this.pickup_city = '';
                    this.pickup_country = '';
                    this.destination_street = '';
                    this.destination_city = '';
                    this.destination_country = '';
                    this.pickup_date ='';
                    this.destination_date ='';
                    this.preferred_route = '';
                    this.quantity = '';
                    this.containers = '';
                    this.requirements = '';
                    this.carriage_rate ='';
                    this.amount = '';
                    this.payment_option = '';
                    this.errors = new Errors();                       
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' Consignment not updated!';                    
                });
            },

            deleteload(load){
                axios.delete('/loads/'+load.slug).then((response)=>{
                    window.location.href='/dashboard/'+this.user.slug; 
                    this.message = ''; 
                    this.errors = new Errors();                      
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' Consignment not deleted!';                    
                });
            },

        },
        mounted(){
           // this.loadloads();
            this.getAllCategories();
           // Fire.$on('AfterloadWasUpdated', () => {this.loadloads()});
        }

    }	
</script>

