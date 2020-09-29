<template>
    <div class="mt-4">
        <div class="row">   
            <h1 class="col-md-10">
                <i class="fa fa-share-alt fa-3x"></i>
                The Uploaded Files for <small>{{user.organisation}}</small>
            </h1>  

            <h2 class="col-md-2">
                <span class="pull-right">
                    <a :href="'/dashboard/' + user.slug">
                        <i class="fa fa-chevron-left text-success"></i> 
                        Back
                    </a>                            
                </span>
            </h2>
            <div v-for="profile in user.profiles" class="media col-md-3">
                <span class="circle mr-4 mb-4">
                    <a :href="'/'+ profile.profiledoc">
                        <i class="fa-2x" :class="profile.file_type"></i> 
                    </a> <br>
                    <small class="text-muted">Uploaded {{profile.created_date}}</small>   
                </span>
                <div class="media-body">
                    <p>
                        <a href=""@click.prevent="deleteProfile(profile)" class="ml-4">
                            <i class="fa fa-trash text-danger"></i> 
                            Delete
                            <i v-if="deleteLoading" class="fa fa-spinner fa-pulse"></i>
                        </a>                            
                            
                    </p>
                </div>
            </div>  
        </div>  

      <div v-if="uploadSuccess" class="alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> File successfully uploaded
      </div>

      <div v-if="uploadFailure" class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Failure!</strong> {{message}}
      </div>

        <div class="d-flex justify-content-center h-100 mt-4">

            <form @submit.prevent="addFile" enctype="multipart/form-data">
                <div class="dropbox">   
                    <input type="file" class="form-control input-file" @change="onFileChange" :class="{'is-invalid': errors.hasError('file')}" ref="fileUpload">
                         <span v-if="errors.hasError('file')" class="invalid-feedback" role="alert">
                            <strong>{{errors.get('file')}}</strong>
                        </span>
                    </span>
                    <p>
                      Drag a file of max size 2MB or click to browse
                      <i v-if="loading" class="fa fa-spinner fa-pulse"></i>
                    </p>
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
                file: '',
                errors: new Errors(),
                message: '',
                user: {},
                loading: false,
                deleteLoading: false,
                uploadSuccess: false,
                uploadFailure: false,
            }
        },
        props: {
            uzer: {
                type: Object,
              required: true
            },
        },

        methods:{ 
            getnewUserValues()
            {
                axios.get('/profiles/'+ this.uzer.slug).then((response) =>{
                    this.user = response.data;
                    Fire.$emit('AfterFileWasUpdated');
                }).catch((e) =>{
                    this.errors.record(e.response.data.errors);                   
                });               

            },    
              onFileChange(){
                this.uploadSuccess = false;
                this.uploadFailure = false;
                this.errors = new Errors();
                this.file = event.target.files[0];
              /*  if(this.file.size >2048){
                    this.uploadFailure = true;
                    this.message = 'The file must less than 2 Mb';
                    this.$refs.fileUpload.value = null;
                }*/
                 this.addFile();
              },

              addFile(){ 
                this.loading = true; //the loading begin 
                var formData = new FormData();
                formData.append('file', this.file);                                               
                axios.post('/profiles', formData,{                   
                }).then((response) =>{
                    this.uploadSuccess = true;
                    this.$refs.fileUpload.value = null;
                    this.file = '';
                    this.message = '';
                    this.errors = new Errors();
                    Fire.$emit('AfterFileWasUpdated');
                }).catch((e) =>{
                    this.uploadFailure = true;
                    this.errors.record(e.response.data.errors);
                    this.message = e.response.data.message + ' File not uploaded!';                    
                }).finally(() => (this.loading = false)); // set loading to false when request finish
              },
                 deleteProfile(profile){
                    this.deleteLoading = true, //the loading begin
                    Swal.fire({
                    title: "Are you sure?",
                    text: "Once Deleted, you will not be able to recover this file -- ",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText:'Yes, delete it!',
                    cancelButtonText:'No, keep it',
                    }).then((willDelete) => {                        
                        if (willDelete.value) { 
                         axios.delete('/profiles/'+ profile.id, {                   
                            }).then((response) =>{                                                    
                            Fire.$emit('AfterFileWasUpdated');
                            Swal.fire('Deleted!',
                            'Your file was successfully deleted',
                            'success'
                            ); 
                           // window.location.href='/loads/create';  

                        }).catch((e)=>{
                            this.errors.record(e.response.data.errors);
                            this.message = e.response.data.message;
                            Swal.fire("Failure! "+ this.message, {
                            icon: "error",
                        });                        
                    }).finally(() => (this.deleteLoading = false)); // set loading to false when request finish;
                        } 
                        else if(willDelete.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire('Cancelled',
                                        'Your file is safe',
                                        'error'
                            )
                        }
                    }).finally(() => (this.deleteLoading = false)); // set loading to false when request finish;
                 },         

        },
        mounted(){
            this.getnewUserValues();
            Fire.$on('AfterFileWasUpdated', () => {this.getnewUserValues()});
        }        

    }   
</script>