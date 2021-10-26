<template>
	<div>    
        <div class="page-breadcrumb border-bottom">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-xs-12 justify-content-start d-flex align-items-center">
                    <h5 class="font-medium text-uppercase mb-0">Category Create</h5>
                </div>
                <div class="col-lg-9 col-md-8 col-xs-12 d-flex justify-content-start justify-content-md-end align-self-center">
                    <nav aria-label="breadcrumb" class="mt-2">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><router-link to="/dashboard">Home</router-link></li>
                            <li class="breadcrumb-item active" aria-current="page">Category</li>
                        </ol>
                    </nav>
                    <router-link to='/category' class="btn btn-info btn-sm text-white d-none d-md-block">Category List</router-link>
                </div>
            </div>
        </div>
        
        <div class="page-content container-fluid">
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add category from here</h4>
                            </h6>
                        </div>
                        <hr>
                        <form class="form-horizontal" @submit.prevent="addCategory" enctype="multipart/form-data" role="form">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Category Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" v-model="name" placeholder="category name" name="name">
                                        <div v-if="errors && errors.name">{{errors.name[0]}}</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">Select File</label>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputGroupFile01" v-on:change="handleFileUpload" name="banner">
                                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                                </div>
                                                <div v-if="errors && errors.banner">{{errors.banner[0]}}</div>
                                            </div>
                                        </div>
                                    </div>
                                
                                
                            </div>
                            <hr>
                            
                            <div class="card-body">
                                <div class="form-group mb-0 text-right">
                                    <button type="submit" class="btn btn-info btn-sm waves-effect waves-light">Save</button>

                                    <button @click='backToUrl' class="btn btn-danger btn-sm waves-effect waves-light">Backs</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
	</div>
</template>
<script>
    export default {
      data() {

          return {

            name: '',
            banner: '',
            errors: {},
          }
    },

      methods: {
        async handleFileUpload(e){
            
            this.banner = e.target.files[0];
        },
        async addCategory () {
            const formData = new FormData

            formData.set('name',this.name);
            formData.set('banner',this.banner);

            axios.post('/api/category',formData).then((response)=>{
                    this.$router.push('/category');
                    Toast.fire({
                      icon: 'success',
                      title: 'Category inserted successfully'
                    })
                }).catch(errors => {
                    this.errors = error.response.data.errors;
                })
          
        },
        backToUrl(){
            this.$router.push('/category');
        }
      }
    }
</script>

<style></style>