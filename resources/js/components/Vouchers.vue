<template>
    <div class="container">
       <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Vouchers Management</h3>
                <button class="btn btn-success" @click="addNewVoucherModal">
                    <i class="fas fa-plus pr-1"></i>Add New Voucher
                </button>
                <div class="card-tools">
                  <div class="input-group input-group-sm mt-5" style="width: 170px;">
                    <input type="text" name="voucher_table_search" class="form-control" placeholder="Search">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Expiry Date</th>
                    <th>Facebook Link</th>
                    <th>Popular</th>
                    <th>Tags</th>
                    <th>Category</th>
                    <th class="text-center" style="width: 8%">Modify</th>
                  </tr>
                  <!-- Display vouchers from database using the voucher object created -->
                  <tr v-for="voucher in vouchers.data" :key="voucher.id">
                    <td>{{voucher.id}}</td>
                    <td>{{voucher.name}}</td>
                    <td class="truncateText"><span>{{voucher.description}}</span><a href="#">view more</a></td>
                    <td>{{voucher.expiry_date | formatDate}}</td>
                    <td class="truncateText"><span>{{voucher.facebook_link}}</span></td>
                    <td>{{voucher.popular_flag}}</td>
                    <td></td>
                    <td>{{voucher.category}}</td>
                    <td>
                      <a href="#" @click="editVoucherModal(voucher)"> <i class="far fas fa-pencil-alt"  style="color: #FFC107;"></i></a>
                      <a href="#" @click="archiveVoucher"><i class="fas fa-archive" style="color: #428bca;"></i></a>
                      <a href="#" @click="deleteVoucher(voucher.id, voucher.name)"><i class="fas fa-trash red deleteToolTip"></i></a>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
                <div class="card-footer">
                  <pagination :data="vouchers" @pagination-change-page="getResults">
                    <span slot="prev-nav">&lt; Previous</span>
                  	<span slot="next-nav">Next &gt;</span>
                  </pagination>
                </div>
            </div>
          </div>
        </div>

        <!-- Modal for adding new voucher -->
        <div class="modal fade" id="addNewVoucher" tabindex="-1" role="dialog" aria-labelledby="newVoucherLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                      <h5 v-show="!editmode" class="modal-title" id="newVoucherLabel">Add new Voucher</h5>
                      <h5 v-show="editmode" class="modal-title" id="newVoucherLabel">Update Voucher</h5>
                  </div>
                <!-- If editmode is true, call updateVoucher. If false call createVoucher -->
                  <form @submit.prevent="editmode ? updateVoucher() : createVoucher()">
                  <div class="modal-body">
                <!-- Name form input -->
                  <div class="form-group">
                      <label>Name</label><span class="red">&#42;</span>
                      <input v-model="voucherForm.name" type="text" name="name" placeholder="Enter a name for the voucher"
                      class="form-control" :class="{ 'is-invalid': voucherForm.errors.has('name') }">
                      <has-error :form="voucherForm" field="name"></has-error>
                  </div>
                <!-- Description form input -->
                 <div class="form-group">
                    <label>Description</label><span class="red">&#42;</span>
                    <textarea v-model="voucherForm.description" type="text" name="description" placeholder="Enter a voucher Description"
                    class="form-control" :class="{ 'is-invalid': voucherForm.errors.has('description') }"></textarea>
                    <has-error :form="voucherForm" field="description"></has-error>
                 </div>
                <!-- Facebook Link form input -->
                 <div class="form-group">
                    <label>Facebook Link</label>
                    <input v-model="voucherForm.facebook_link" type="text" name="facebook_link" placeholder="Enter a link to the voucher's facebook page (OPTIONAL)"
                    class="form-control" :class="{ 'is-invalid': voucherForm.errors.has('facebook_link') }">
                    <has-error :form="voucherForm" field="facebook_link"></has-error>
                 </div>
                <!-- Expiry Date form input  -->
                 <div class="form-group">
                    <label>Expiry Date</label><span class="red">&#42;</span>
                    <input v-model="voucherForm.expiry_date" type="datetime-local" name="expiry_date"
                    class="form-control" :class="{ 'is-invalid': voucherForm.errors.has('expiry_date') }">
                    <has-error :form="voucherForm" field="expiry_date"></has-error>
                 </div> 
                <!-- 
                    <div class="form-group">
                    <label>Expiry Date</label><span class="red">&#42;</span>
                    <datetime v-model="voucherForm.expiry_date" type="date" name="expiry_date" input-class="form-control" :class="{ 'is-invalid': voucherForm.errors.has('expiry_date') }">
                      <has-error :form="voucherForm" field="expiry_date"></has-error>
                    </datetime>
                 </div> -->

                <!-- Catgeory form input -->
                  <div class="form-group">
                    <label>Category</label><span class="red">&#42;</span>
                    <select name="category" v-model="voucherForm.category" id="category" class="form-control" 
                      :class="{ 'is-invalid': voucherForm.errors.has('category') }">
                      <option value="">Please select an option</option>
                      <option value="food">Food</option>
                      <option value="automotive">Automotive</option>
                      <option value="beauty">Beauty</option>
                    </select>
                    <has-error :form="voucherForm" field="category"></has-error>
                 </div>
                <!-- Popular form input -->
                 <div class="form-group">
                    <label>Popular voucher?</label><span class="red">&#42;</span>
                    <i class="fas fa-info-circle voucherFormToolTip"
                    ></i>
                    <select name="popular_flag" v-model="voucherForm.popular_flag" id="popular_flag" class="form-control" 
                      :class="{ 'is-invalid': voucherForm.errors.has('popular_flag') }">
                      <option value="">Please select an option</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select>
                    <has-error :form="voucherForm" field="popular_flag"></has-error>
                 </div>
                </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger closefirstmodal">Close</button>
                      <button v-show="editmode" type="submit" class="btn btn-warning">Update</button>
                      <button v-show="!editmode" type="submit" class="btn btn-success">Create</button>
                  </div>
                </form>
                </div>
            </div>
        </div>
        <!-- Warning Modal for confirming close -->
        <div id="Warning" class="modal fade" role="dialog" data-backdrop="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title col-12 text-center" id="Warning">
                        <i class="fas fa-exclamation-triangle red"></i> Warning
                        </h5>
                    </div>
                    <div class="modal-body text-center">
                        <p v-show="editmode">Are you sure you want to close? Any changes made will be lost.</p>
                        <p v-show="!editmode">Are you sure you want to close? All data will be lost.</p>
                        <button type="button" class="btn btn-danger confirmclosed">Confirm Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
          return {
            editmode: false,
            vouchers: {},
            voucherForm: new Form({
              id: '',
              name: '',
              description: '',
              photo: '',
              expiry_date: '',
              facebook_link: '',
              category: '',
              popular: ''
            })
          }
        },
        methods: {

          updateVoucher(){
            this.voucherForm.put('api/voucher/' + this.voucherForm.id)
            .then(()=>{ 
              Fire.$emit('RefreshVouchers');
              $('#addNewVoucher').modal('hide');
              swal.fire(
                  'Success!',
                  'Voucher has been successfully updated.',
                  'success'
                  )
            }) 
            .catch(()=>{
              swal.fire({
              title: 'Error',
              text: "Failed to update voucher.",
              type: 'error'
              })
            })
          },
          archiveVoucher(){
            swal.fire({
              title: 'Nothing here',
              text: "I haven't added archive voucher yet.",
              type: 'warning'
              })
          },
          editVoucherModal(voucher){
            this.editmode = true;
            this.voucherForm.clear();
            this.voucherForm.reset();
            $("#addNewVoucher").modal({
              backdrop: 'static',
              keyboard: false
            });
            this.voucherForm.fill(voucher);
          },
          addNewVoucherModal(){
            this.editmode = false;
            this.voucherForm.clear();
            this.voucherForm.reset();
            /* Show the modal and make sure it can't be closed when clicking the areas around it */
            $("#addNewVoucher").modal({
              backdrop: 'static',
              keyboard: false
            });
          },
          /* Method to paginate the voucher data */
          getResults(page = 1) {
            axios.get('api/voucher?page=' + page)
              .then(response => {
                this.vouchers = response.data;
              });
          },
          createVoucher(){
           /* New date picker
           var transformDate = moment(this.voucherForm.expiry_date).format('YYYYMMDD');
            this.voucherForm.expiry_date = transformDate; */
            this.voucherForm.post('api/voucher')
            .then(()=>{ 
              /* If the post was successful then hide the modal and print success message */
              Fire.$emit('RefreshVouchers');
              $('#addNewVoucher').modal('hide');
              swal.fire(
                  'Success!',
                  'Voucher has been created successfully',
                  'success'
                  )
            }) 
            .catch(()=>{
              /* If unsuccessful, catch */
              swal.fire({
              title: 'Error',
              text: "Failed to create new voucher. Please check you have correctly filled the form.",
              type: 'error'
              })
            })
          },
          displayVouchers(){
            axios.get("api/voucher")
            .then(({data}) => (this.vouchers = data)); /*store the data in the voucher object */
          },
          deleteVoucher(id, name){ 
            swal.fire({
            title: 'Are you sure?',
            html: 'The following voucher will be permanently deleted: <b><b><br>' + name ,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#07AD4D',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if(result.value) {
                this.voucherForm.delete('api/voucher/'+id).then(()=> {
                  swal.fire(
                  'Deleted!',
                  'Voucher has been deleted.',
                  'success'
                  )
                /* After deleting, send an event to fresh the voucher table */
                Fire.$emit('RefreshVouchers'); 
                }
                ).catch(()=>{
                  swal("Failed!", "Failed to delete voucher.", "warning");
                });
                }
            })
            }

        }, /* END OF METHODS */

         
        mounted() {
            this.displayVouchers();
            /* If a voucher is created, call the displayVouchers function again to refresh vouchers table*/
            Fire.$on('RefreshVouchers', () => {
              this.displayVouchers();
            });
            /* TODO: Code refactoring */
            /* Show a warning modal before closing the 'Create Voucher' modal  */
            $(document).ready(function () {
                $('.closefirstmodal').click(function () {
                    $('#Warning').modal('show');
                });
                /* If the user confirms the close, hide both modals */
                $('.confirmclosed').click(function () {
                    $('#Warning').modal('hide');
                    $('#addNewVoucher').modal('hide');
                });
        });
          /* Setup tooltips */
          $(".voucherFormToolTip").tooltip({
              placement: "top",
              title: "Popular vouchers will be displayed on the home page"
          });
          $(".deleteToolTip").tooltip({
             placement: "top",
             title: "Delete"
          });
          
        } 
    }
</script>
