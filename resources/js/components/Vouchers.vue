<template>
    <div class="container">
       <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Vouchers Management</h3>
                <button class="btn btn-success" data-toggle="modal" data-target="#addNewVoucher" data-backdrop="static" data-keyboard="false">
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
                    <th>Categories</th>
                    <th class="text-center">Modify</th>
                  </tr>
                  <!-- Display vouchers from database using the voucher object created -->
                  <tr v-for="voucher in vouchers" :key="voucher.id">
                    <td>{{voucher.id}}</td>
                    <td>{{voucher.name}}</td>
                    <td class="truncateText"><span>{{voucher.description}}</span><a href="#">view more</a></td>
                    <td>{{voucher.expiry_date | formatDate}}</td>
                    <td class="truncateText"><span>{{voucher.facebook_link}}</span></td>
                    <td>{{voucher.popular_flag}}</td>
                    <td></td>
                    <td></td>
                    <td>
                      <button type="button" class="btn btn-warning"> <i class="far fa-edit pr-1"></i>Edit</button>
                      <button type="button" class="btn btn-danger"><i class="fas fa-trash pr-1"></i>Delete</button>
                      <button type="button" class="btn btn-primary"><i class="fas fa-archive pr-1"></i>Archive</button>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal for adding new voucher -->
        <div class="modal fade" id="addNewVoucher" tabindex="-1" role="dialog" aria-labelledby="newVoucherLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="newVoucherLabel">Add new Voucher</h5>
                  </div>
                  <form @submit.prevent="createVoucher">
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
                <!-- Expiry Date form input --> 
                 <div class="form-group">
                    <label>Expiry Date</label><span class="red">&#42;</span>
                    <input v-model="voucherForm.expiry_date" type="datetime-local" name="expiry_date"
                    class="form-control" :class="{ 'is-invalid': voucherForm.errors.has('expiry_date') }">
                    <has-error :form="voucherForm" field="expiry_date"></has-error>
                 </div>
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
                    <i class="nav-icon fas fa-info-circle" data-toggle="tooltip" data-placement="top" 
                    title="Popular vouchers will be displayed on the home page"></i>
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
                      <button type="submit" class="btn btn-success">Create</button>
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
                        <p>Are you sure you want to close?</p>
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
            vouchers: {},
            voucherForm: new Form({
              name : '',
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
          createVoucher(){
            this.voucherForm.post('api/voucher')
            .then(()=>{ 
              /* If the post was successful then hide the modal and print success message */
              $('#addNewVoucher').modal('hide');
              swal("Success", "Voucher has been created successfully", "success");
            }) 
            .catch(()=>{
              /* If unsuccessful, catch the error */
              console.log("Voucher form submit error");
            })
          },
          displayVouchers(){
            axios.get("api/voucher").then(({data}) => (this.vouchers = data.data)); /*store the data in the voucher object */
          }
        },
        mounted() {
            this.displayVouchers();
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
          /* Enable all tooltips */
          $(function () {
            $('[data-toggle="tooltip"]').tooltip()
          })
        } 
    }
</script>
