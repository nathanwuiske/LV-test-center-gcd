<template>
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h3 class="card-title">Categories</h3>
                  <button class="btn btn-success" @click="addNewCategoryModal">
                  <i class="fas fa-plus pr-1"></i>Add New Category
                  </button>
               </div>
               <div class="card-body table-responsive p-0">
                  <table class="table table-hover">
                     <tbody>
                        <tr>
                           <th>ID</th>
                           <th>Category Name</th>
                           <th>Modify</th>
                        </tr>
                        <tr v-for="category in categories.data" :key="category.id">
                           <td>{{category.id}}</td>
                           <td>{{category.name}}</td>
                           <td>
                              <a href="#" @click="editCategory(category)"> <i class="far fas fa-pencil-alt"  style="color: #FFC107;"></i></a>
                              <a href="#" @click="deleteCategoryTitle(category.id, category.name)"><i class="fas fa-trash red"></i></a>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="card-footer">
                  <pagination :data="categories" @pagination-change-page="getCategoryResults" :limit=5>
                     <span slot="prev-nav">&lt; Previous</span>
                     <span slot="next-nav">Next &gt;</span>
                  </pagination>
               </div>
            </div>
            <div class="card">
               <div class="card-header">
                  <h3 class="card-title">Assign categories to vouchers</h3>
                      <div class="card-tools">
                     <div class="input-group input-group-sm mt-3" style="width: 170px;">
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
                           <th>Voucher Name</th>
                           <th>Category Name(s)</th>
                           <th>Add/Remove categories</th>
                        </tr>
                        <tr v-for="voucher in vouchers.data" :key="voucher.id">
                           <td>{{voucher.id}}</td>
                           <td>{{voucher.name}}</td>
                           <td v-if="voucher.get_categories.length == 0">-</td>
                           <div v-for="category in voucher.get_categories" :key="category.id">
                              <td>{{category.name}}</td>
                           </div>
                           <td>
                              <a href="#" @click="categorymodal(voucher.id)"><i class="fas fa-plus green"></i></a>
                              <a href="#" @click="deleteCategory(voucher)"><i class="fas fa-trash red"></i></a>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="card-footer">
                  <pagination :data="vouchers" @pagination-change-page="getVoucherResults" :limit=5>
                     <span slot="prev-nav">&lt; Previous</span>
                     <span slot="next-nav">Next &gt;</span>
                  </pagination>
               </div>
               <!-- Modal for editing categories -->
               <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Update an existing category</h5>
                        </div>
                        <form @submit.prevent="updateCategory()">
                           <div class="modal-body">
                              <!-- Category name form input -->
                              <div class="form-group">
                                 <label>Name</label><span class="red">&#42;</span>
                                 <input v-model="categoryForm.name" type="text" name="name" placeholder="Enter a name for the category"
                                    class="form-control" :class="{ 'is-invalid': categoryForm.errors.has('name') }">
                                 <has-error :form="categoryForm" field="name"></has-error>
                              </div>
                              <p>Any vouchers that have this category will also have their names updated</p>
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
               <!-- Modal for adding new categories -->
               <div class="modal fade" id="addNewCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addNewCategoryModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Add new category</h5>
                        </div>
                        <form @submit.prevent="addCategory()">
                           <div class="modal-body">
                              <!-- Category name form input -->
                              <div class="form-group">
                                 <label>Name</label><span class="red">&#42;</span>
                                 <input v-model="categoryForm.name" type="text" name="name" placeholder="Enter a name for the category"
                                    class="form-control" :class="{ 'is-invalid': categoryForm.errors.has('name') }">
                                 <has-error :form="categoryForm" field="name"></has-error>
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
               <!-- Modal for assigning new categories -->
               <div class="modal fade" id="addNewCategory" tabindex="-1" role="dialog" aria-labelledby="addNewCategoryLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Assign a new category</h5>
                        </div>
                        <form @submit.prevent="assignCategory()">
                           <div class="modal-body">
                              <!-- Categories form input -->
                              <div class="form-group">
                                 <select name="name" v-model="categoryForm.category_id" id="name" class="form-control" 
                                    :class="{ 'is-invalid': categoryForm.errors.has('name') }">
                                    <option value="" disabled selected>Select categories</option>
                                    <option v-for="category in sortedCategories" :key="category.id" v-bind:value="category.id">{{category.name}}</option>
                                 </select>
                                 <has-error :form="categoryForm" field="name"></has-error>
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
               <!-- Modal for deleteing new categories -->
               <div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Remove an existing category</h5>
                        </div>
                        <form @submit.prevent="submitDeleteCategory()">
                           <div class="modal-body">
                              <!-- Categories form input -->
                              <div class="form-group">
                                 <select name="categories" v-model="categoryForm.category_id" id="categories_name" class="form-control" 
                                    :class="{ 'is-invalid': categoryForm.errors.has('name') }">
                                    <option value="" disabled selected>Select category</option>
                                    <option v-for="category in voucherCategories" :key="category.id" v-bind:value="category.id">
                                       {{category.name}}
                                    </option>
                                 </select>
                                 <has-error :form="categoryForm" field="name"></has-error>
                              </div>
                           </div>
                           <!-- Footer -->
                           <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success">Delete</button>
                           </div>
                        </form>
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
            search: '',
            categories: {},
            allCategories: {},
				vouchers: {},
				categoryForm: new Form({
					id: '',
					voucher_id: '',
					category_id: '',
					name: '',
					get_categories: []
				}),
			}
		},
		computed: {
			sortedCategories() {
				return _.sortBy(this.allCategories, [category => category.name.toLowerCase()], 'category_id');
			},
			voucherCategories() {
				return _.sortBy(this.categoryForm.get_categories, [category => category.name.toLowerCase()], 'category_id');
			}
		},
		methods: {
         searchTerm: function() {
         if (this.timeout) clearTimeout(this.timeout); 
         this.timeout = setTimeout(() => {
            Fire.$emit('searching');
         }, 500);
			},
			getCategoryResults(page = 1) {
				axios.get('api/category?page=' + page)
					.then(response => {
						this.categories = response.data;
					});
			},
			getVoucherResults(page = 1) {
				axios.get('api/voucher?page=' + page)
					.then(response => {
						this.vouchers = response.data;
					});
			},
			updateCategory() {
				this.categoryForm.put('api/category/' + this.categoryForm.id)
					.then(() => {
						Fire.$emit('RefreshVouchersAndCategories');
						$('#editCategoryModal').modal('hide');
						swal.fire(
							'Success!',
							'Category has been successfully updated.',
							'success'
						)
					})
					.catch(() => {
						swal.fire({
							title: 'Error',
							text: "Failed to update category.",
							type: 'error'
						})
					})
			},
			editCategory(category) {
				this.categoryForm.clear();
				this.categoryForm.reset();
				$('#editCategoryModal').modal('show');
				this.categoryForm.fill(category);
			},
			deleteCategoryTitle(categoryID, categoryName) {
				swal.fire({
					title: 'Warning',
					html: 'Deleting the category <b><b>' + categoryName + ' </b></b>will also permanently remove it from all vouchers',
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#d33',
					cancelButtonColor: '#07AD4D',
					confirmButtonText: 'Delete'
				}).then((result) => {
					if (result.value) {
						this.categoryForm.delete('api/category/' + categoryID).then(() => {
							swal.fire(
								'Deleted!',
								'Category has been deleted.',
								'success'
							)
							Fire.$emit('RefreshVouchersAndCategories');
						}).catch(() => {
							swal("Failed!", "Failed to delete category.", "warning");
						});
					}
				})
			},
			addCategory() {
				this.categoryForm.post('api/category')
					.then(() => {
						Fire.$emit('RefreshVouchersAndCategories');
						$('#addNewCategoryModal').modal('hide');
						swal.fire(
							'Success!',
							'Category has been created successfully',
							'success'
						)
					})
					.catch(() => {
						swal.fire({
							title: 'Error',
							text: "Failed to create new category.",
							type: 'error'
						})
					})
			},
			addNewCategoryModal() {
            this.categoryForm.clear();
            this.categoryForm.reset();
				$('#addNewCategoryModal').modal('show');
			},
			/* Deleting categories */
			submitDeleteCategory() {
				let id = 0;
				this.categoryForm.delete('api/vouchercategory/' + id).then(() => {
						Fire.$emit('RefreshVouchersAndCategories');
						$('#deleteCategoryModal').modal('hide');
						swal.fire(
							'Success!',
							'Category has been successfully removed.',
							'success'
						)
					})
					.catch(() => {
						swal.fire({
							title: 'Error',
							text: "Failed to delete category.",
							type: 'error'
						})
					})
			},
			deleteCategory(voucher) {
				this.categoryForm.clear();
				this.categoryForm.reset();
				$('#deleteCategoryModal').modal('show');
				this.categoryForm.fill(voucher);
			},
			/* Adding new categories */
			categorymodal(voucherid) {
				this.categoryForm.clear();
				this.categoryForm.reset();
				$('#addNewCategory').modal('show');
				this.categoryForm.voucher_id = voucherid;
			},
			assignCategory() {
				this.categoryForm.post('api/vouchercategory').then(() => {
						Fire.$emit('RefreshVouchersAndCategories');
						$('#addNewCategory').modal('hide');
						swal.fire(
							'Success!',
							'Category has been successfully added.',
							'success'
						)
					})
					.catch(() => {
						swal.fire({
							title: 'Error',
							text: "Failed to add category.",
							type: 'error'
						})
					})
			},
			/* Getting category data */
			getCategory() {
				axios.get('api/category').then(({
					data
				}) => (this.categories = data));
         },
         getAllCategory() {
				axios.get('api/categoryall').then(({
					data
				}) => (this.allCategories = data));
			},
			/* Getting voucher data */
			getVouch() {
				axios.get('api/voucher').then(({
					data
				}) => (this.vouchers = data));
			}
		},
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
         
			Fire.$on('RefreshVouchersAndCategories', () => {
				this.getVouch();
				this.getCategory();
         });
         this.getAllCategory();
			this.getVouch();
			this.getCategory();
		}
	} 
</script>