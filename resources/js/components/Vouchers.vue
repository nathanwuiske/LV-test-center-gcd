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
                        <input type="text" name="voucher_table_search" v-model="search" @keyup="searchTerm" class="form-control" placeholder="Search">
                        <div class="input-group-append">
                           <button class="btn btn-default" @click.prevent="searchTerm"><i class="fa fa-search"></i></button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body table-responsive p-0">
                  <table class="table table-hover">
                     <tbody>
                        <tr>
                           <th>ID</th>
                           <th>Name</th>
                           <th>Description</th>
                           <th>Expiry Date</th>
                           <th>Website Link</th>
						   <th>Timeout (hrs)</th>
                           <th>Popular</th>
                           <th>Tags</th>
                           <th>Image</th>
                           <th>Categories</th>
                           <th class="text-center" style="width: 10%">Modify</th>
                        </tr>
                        <!-- Display vouchers from database using the voucher object created -->
                        <tr v-for="voucher in vouchers.data" :key="voucher.id">
                           <td>{{voucher.id}}</td>
                           <td>{{voucher.name}}</td>
                           <td class="truncateText">
                              <span>{{voucher.description}}</span>
                           </td>
                           <td>{{voucher.expiry_date | formatDate}}</td>
                           <td class="truncateText"><span>{{voucher.website_link | cleanURL}}</span></td>
						   <td>{{voucher.timeout}}</td>
                           <td>{{voucher.popular_flag}}</td>
                           <!-- Display tags -->
                           <td v-if="voucher.gettags.length == 0">-</td>
                           <div v-for="tag in voucher.gettags" :key="tag.tag_title">
                              <td>{{tag.tag_title}}</td>
                           </div>
                           <!-- End of Display tags -->
                           <td><a href="#" @click="getImage(voucher.image)">Show</a></td>
                           <!-- Display categories -->
                           <td v-if="voucher.get_categories.length == 0">-</td>
                           <div v-for="category in voucher.get_categories" :key="category.id">
                              <td>{{category.name}}</td>
                           </div>
                           <!-- End of Display tags -->
                           <td>
                              <a class="cursor-pointer" @click="editVoucherModal(voucher)"> <i class="far fas fa-pencil-alt"  style="color: #FFC107;"></i></a>
                              <a class="cursor-pointer" @click="archiveVoucher(voucher.id, voucher.name)"><i class="fas fa-archive" style="color: #428bca;"></i></a>
                              <a class="cursor-pointer" @click="deleteVoucher(voucher.id, voucher.name)"><i class="fas fa-trash red"></i></a>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="card-footer">
                  <pagination :data="vouchers" @pagination-change-page="getResults" :limit=5>
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
                     <!-- Website Link form input -->
                     <div class="form-group">
                        <label>Website Link</label>
                        <input v-model="voucherForm.website_link" type="text" name="website_link" placeholder="Enter a link to the voucher's website (OPTIONAL)"
                           class="form-control" :class="{ 'is-invalid': voucherForm.errors.has('website_link') }">
                        <has-error :form="voucherForm" field="website_link"></has-error>
                     </div>
					 <!-- Timeout form input -->
                     <div class="form-group">
                        <label>Timeout</label><span class="red">&#42;</span>
                        <input v-model="voucherForm.timeout" type="text" name="timeout" placeholder="Enter voucher timeout in hours (Default is 24 hours)"
                           class="form-control" :class="{ 'is-invalid': voucherForm.errors.has('timeout') }">
                        <has-error :form="voucherForm" field="timeout"></has-error>
                     </div>
                     <!-- Expiry Date form input  -->
                     <div class="form-group">
                        <label>Expiry Date</label><span v-show="!editmode" class="red">&#42; </span> 
                        <input v-model="voucherForm.expiry_date" type="date" name="expiry_date"
                           class="form-control" :class="{ 'is-invalid': voucherForm.errors.has('expiry_date') }">
                        <has-error :form="voucherForm" field="expiry_date"></has-error>					
                     </div>	 
                     <!-- Popular form input -->
                     <div class="form-group">
                        <label>Popular voucher?</label><span class="red">&#42;</span>
                        <i class="fas fa-info-circle voucherFormToolTip"></i>
                        <select name="popular_flag" v-model="voucherForm.popular_flag" id="popular_flag" class="form-control" 
                           :class="{ 'is-invalid': voucherForm.errors.has('popular_flag') }">
                           <option value="" disabled selected>Please select an option</option>
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                        </select>
                        <has-error :form="voucherForm" field="popular_flag"></has-error>
                     </div>
                     <!-- Voucher image input -->
                     <div class="form-group">
                        <label for="image" class="control-label">Image</label>
                        <div class="col-sm-12">
                           <input type="file" @change="insertImage" name="image" id="imageUpload" class="form-control" :class="{ 'is-invalid': voucherForm.errors.has('image') }">
                           <has-error :form="voucherForm" field="image"></has-error>
                        </div>
                     </div>
                  </div>
                  <!-- Footer -->
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
</template>
<script>
	export default {
		data() {
			return {
				search: '',
				editmode: false,
				vouchers: {},
				voucherForm: new Form({
					id: '',
					name: '',
					currentPage: '',
					description: '',
					image: '',
					expiry_date: '',
					website_link: '',
					category: '',
					popular_flag: '',
					timeout: '',
					is_archive: ''
				})
			}
		},
		methods: {
			searchTerm: function() {
				if (this.timeout) clearTimeout(this.timeout); 
				this.timeout = setTimeout(() => {
					Fire.$emit('searching');
				}, 500);
			},
			getImage(image) {
				$('#imagepreview').attr('src', "imgs/vouchers/" + image);
				$('#showImage').modal('show');
			},
			insertImage(event) {
				let file = event.target.files[0];
				let reader = new FileReader();

				/* if the file size is less than 2MB, continue */
				if(file['size'] < 2097152){ 
					/* convert to base64 */
					reader.onloadend = (file) => {
						this.voucherForm.image = reader.result;
					}
					reader.readAsDataURL(file);
				}
				else {
					$("#imageUpload").val('');
					swal.fire({
						title: 'Error',
						text: "File cannot be larger than 2MB.",
						type: 'error'
					})
				}
			},
			updateVoucher() {
				this.voucherForm.put('api/voucher/' + this.voucherForm.id)
					.then(() => {
						Fire.$emit('RefreshVouchers');
						$('#addNewVoucher').modal('hide');
						swal.fire({
							toast: true,
							position: 'top',
							showConfirmButton: false,
							timer: 3500,
							type: 'success',
							title: 'Voucher has been successfully updated.'
						})
					})
					.catch(() => {
						swal.fire({
							title: 'Error',
							text: "Failed to update voucher.",
							type: 'error'
						})
					})
			},
			archiveVoucher(id, name) {
				swal.fire({
					title: 'Are you sure?',
					html: 'The following voucher will be archived: <b><b><br>' + name,
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#428BCA',
					cancelButtonColor: '#07AD4D',
					confirmButtonText: 'Archive'
				}).then((result) => {
					if (result.value) {
						this.voucherForm.is_archive = "yes";
						this.voucherForm.delete('api/voucher/' + id).then(() => {
							swal.fire({
								toast: true,
								position: 'top',
								showConfirmButton: false,
								timer: 3500,
								type: 'success',
								title: 'Voucher has been archived.'
							})
							/* After archiving, send an event to refresh the voucher table */
							Fire.$emit('RefreshVouchers');
						}).catch(() => {
							swal("Failed!", "Failed to archive voucher.", "warning");
						});
					}
				})
			},
			editVoucherModal(voucher) {
				this.editmode = true;
				this.voucherForm.clear();
				this.voucherForm.reset();
				$("#addNewVoucher").modal({
					backdrop: 'static',
					keyboard: false
				});
				this.voucherForm.fill(voucher);
			},
			addNewVoucherModal() {
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
				this.currentPage = page;
				axios.get('api/voucher?page=' + page)
					.then(response => {
						this.vouchers = response.data;
					});
			},
			createVoucher() {
				this.$Progress.start();
				//this.voucherForm.expiry_date = moment(this.voucherForm.expiry_date).format("YYYY-MM-DD");
				this.voucherForm.post('api/voucher')
					.then(() => {
						/* If the post was successful then hide the modal and print success message */
						Fire.$emit('RefreshVouchers');
						$('#addNewVoucher').modal('hide');
						swal.fire({
							toast: true,
							position: 'top',
							showConfirmButton: false,
							timer: 3500,
							type: 'success',
							title: 'Voucher successfully created'
						})
						this.$Progress.finish();
					})
					.catch(() => {
						swal.fire({
							title: 'Error',
							text: "Failed to create new voucher. Please check you have correctly filled the form.",
							type: 'error'
						})
						this.$Progress.fail();
					})
			},
			displayVouchers() {
				axios.get("api/voucher").then(({
					data
				}) => (this.vouchers = data)) /*store the data in the voucher object */
				.catch(error => {
							swal.fire({
							title: 'Voucher data retrieval error',
							text: error,
							type: 'error'
						})
				})
			},
			displayVouchersPaginate() {
			axios.get("api/voucher?page=" + this.currentPage).then(({
				data
			}) => (this.vouchers = data)) /*store the data in the voucher object */
			.catch(error => {
						swal.fire({
						title: 'Voucher data retrieval error',
						text: error,
						type: 'error'
					})
			})
			},
			displayVouchersSearch(){
				let query = this.search;
				axios.get('api/findVoucher?q=' + query)
				.then((data) => {
					this.vouchers = data.data;
				})
				.catch(error => {
					console.log(error);
				})
			},
			deleteVoucher(id, name) {
				swal.fire({
					title: 'Are you sure?',
					html: 'The following voucher will be permanently deleted: <b><b><br>' + name,
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#d33',
					cancelButtonColor: '#07AD4D',
					confirmButtonText: 'Delete'
				}).then((result) => {
					if (result.value) {
						this.voucherForm.is_archive = "no";
						this.$Progress.start();
						this.voucherForm.delete('api/voucher/' + id).then(() => {
							swal.fire({
								toast: true,
								position: 'top',
								showConfirmButton: false,
								timer: 3500,
								type: 'success',
								title: 'Voucher has been successfully deleted'
							})
							this.$Progress.finish();
							/* After deleting, send an event to fresh the voucher table */
							Fire.$emit('RefreshVouchers');
						}).catch(() => {
							swal("Failed!", "Failed to delete voucher.", "warning");
							this.$Progress.fail();
						});
					}
				})
			}
			 

		},
		/* END OF METHODS */


		mounted() {
			Fire.$on('searching', () => {
				let query = this.search;
				axios.get('api/findVoucher?q=' + query)
				.then((data) => {
					this.vouchers = data.data;
				})
				.catch(error => {
					console.log(error);
				})
			});
			this.displayVouchers();
			/* If a voucher is created, call the displayVouchers function again to refresh vouchers table*/
			Fire.$on('RefreshVouchers', () => {
				if(this.search == ''){
					this.displayVouchersPaginate();
				}
				else {
					this.displayVouchersSearch();
				}
			});
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
		}
	} 
</script>