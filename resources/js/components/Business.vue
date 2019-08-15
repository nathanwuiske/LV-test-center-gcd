<template>
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h3 class="card-title">Businesses</h3>
                  <button class="btn btn-success" @click="addNewBusinessModal">
                  <i class="fas fa-plus pr-1"></i>Add New Business
                  </button>
               </div>
               <div class="card-body table-responsive p-0">
                  <table class="table table-hover">
                     <tbody>
                        <tr>
                           <th>ID</th>
                           <th>Name</th>
                           <th>Image</th>
                           <th style="width: 25%">Modify</th>
                        </tr>
                        <tr v-for="business in businesses.data" :key="business.created_at">
                           <td>{{business.id}}</td>
                           <td>{{business.name}}</td>
                           <td><a href="#" @click="getImage(business.image)">Show</a></td>
                           <td>
                              <a class="cursor-pointer" @click="editBusinessModal(business)"> <i class="far fas fa-pencil-alt"  style="color: #FFC107;"></i></a>
                              <a class="cursor-pointer" @click="deleteBusiness(business.id, business.name)"><i class="fas fa-trash red"></i></a>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="card-footer">
                  <pagination :data="businesses" @pagination-change-page="getResults" :limit=5>
                     <span slot="prev-nav">&lt; Previous</span>
                     <span slot="next-nav">Next &gt;</span>
                  </pagination>
               </div>
            </div>
             <!-- Modal for adding new businesses -->
            <div class="modal fade" id="addNewBusiness" tabindex="-1" role="dialog" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Add new Business</h5>
                     </div>
                     <form @submit.prevent="createBusiness()">
                        <div class="modal-body">
                           <!-- Name form input -->
                           <div class="form-group">
                              <label>Name</label><span class="red">&#42;</span>
                              <input v-model="businessForm.name" type="text" name="name" placeholder="Enter business name"
                                 class="form-control" :class="{ 'is-invalid': businessForm.errors.has('name') }">
                              <has-error :form="businessForm" field="name"></has-error>
                           </div>
                           <!-- business image input-->
                           <div class="form-group">
                              <label for="image" class="control-label">Image</label>
                              <div class="col-sm-12">
                                 <input type="file" @change="insertImage" name="image" id="imageUpload" class="form-control" :class="{ 'is-invalid': businessForm.errors.has('image') }">
                                 <has-error :form="businessForm" field="image"></has-error>
                              </div>
                           </div>
                        </div>
                        <!-- Footer -->
                        <div class="modal-footer">
                           <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-success">Create</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <!-- Modal for editing businesses -->
            <div class="modal fade" id="editBusinessModal" tabindex="-1" role="dialog" aria-labelledby="editTagModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Update an existing business</h5>
                     </div>
                     <form @submit.prevent="updateBusiness()">
                        <div class="modal-body">
                           <!-- Business name form input -->
                           <div class="form-group">
                              <label>Name</label><span class="red">&#42;</span>
                              <input v-model="businessForm.name" type="text" name="name" placeholder="Enter a name for the business"
                                 class="form-control" :class="{ 'is-invalid': businessForm.errors.has('name') }">
                              <has-error :form="businessForm" field="name"></has-error>
                           </div>
                           <!-- business image input-->
                           <div class="form-group">
                              <label for="image" class="control-label">Image (OPTIONAL)</label>
                              <div class="col-sm-12">
                                 <input type="file" @change="insertImage" name="image" id="imageUpload" class="form-control" :class="{ 'is-invalid': businessForm.errors.has('image') }">
                                 <has-error :form="businessForm" field="image"></has-error>
                              </div>
                           </div>
                        </div>
                        <!-- Footer -->
                        <div class="modal-footer">
                           <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <!-- Image Modal -->
            <div class="modal fade" id="showImage" tabindex="-1" role="dialog" aria-labelledby="showImageLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-body">
                        <img src="" id="imagepreview" class="imagepreview" style="width: 100%;" >
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                     </div>
                  </div>
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
                businesses: {},
                businessForm: new Form({
                    id: '',
                    name: '',
                    image: ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/business?page=' + page)
                    .then(response => {
                        this.businesses = response.data;
                    });
            },
            getBusinesses() {
                axios.get('api/business').then(({
                    data
                }) => (this.businesses = data));
            },
            addNewBusinessModal() {
                this.businessForm.clear();
                this.businessForm.reset();
                $("#addNewBusiness").modal({
                    backdrop: 'static',
                    keyboard: false
                });
            },
            createBusiness() {
                this.businessForm.post('api/business')
                    .then(() => {
                        Fire.$emit('RefreshBusinesses');
                        $('#addNewBusiness').modal('hide');
                        swal.fire({
                           toast: true,
                           position: 'top',
                           showConfirmButton: false,
                           timer: 3500,
                           type: 'success',
                           title: 'Business has been successfully created'
                         })
                    })
                    .catch(() => {
                        swal.fire({
                            title: 'Error',
                            text: "Failed to create new business.",
                            type: 'error'
                        })
                    })
            },
            insertImage(event) {
                let file = event.target.files[0];
                let reader = new FileReader();
                if (file['size'] < 2097152) {
                    reader.onloadend = (file) => {
                        this.businessForm.image = reader.result;
                    }
                    reader.readAsDataURL(file);
                } else {
                    $("#imageUpload").val('');
                    swal.fire({
                        title: 'Error',
                        text: "File cannot be larger than 2MB.",
                        type: 'error'
                    })
                }
            },
            getImage(image) {
                $('#imagepreview').attr('src', "imgs/businesses/" + image);
                $('#showImage').modal('show');
            },
            deleteBusiness(id, name) {
                swal.fire({
                    title: 'Are you sure?',
                    html: 'The following business will be permanently deleted: <b><b><br>' + name,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#07AD4D',
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if (result.value) {
                        this.businessForm.delete('api/business/' + id).then(() => {
                            swal.fire({
                           toast: true,
                           position: 'top',
                           showConfirmButton: false,
                           timer: 3500,
                           type: 'success',
                           title: 'Business has been successfully deleted'
                         })
                            Fire.$emit('RefreshBusinesses');
                        }).catch(() => {
                            swal("Failed!", "Failed to delete business.", "warning");
                        });
                    }
                })
            },
            editBusinessModal(business) {
                this.businessForm.clear();
                this.businessForm.reset();
                $('#editBusinessModal').modal('show');
                this.businessForm.fill(business);
            },
            updateBusiness() {
                this.businessForm.put('api/business/' + this.businessForm.id)
                    .then(() => {
                        Fire.$emit('RefreshBusinesses');
                        $('#editBusinessModal').modal('hide');
                        swal.fire({
                           toast: true,
                           position: 'top',
                           showConfirmButton: false,
                           timer: 3500,
                           type: 'success',
                           title: 'Business has been successfully updated'
                         })
                    })
                    .catch(() => {
                        swal.fire({
                            title: 'Error',
                            text: "Failed to update business.",
                            type: 'error'
                        })
                    })
            },
            /* End of methods */
        }, 

        mounted() {
            Fire.$on('RefreshBusinesses', () => {
                this.getBusinesses();
            });
            this.getBusinesses();
        }
    } 
</script>