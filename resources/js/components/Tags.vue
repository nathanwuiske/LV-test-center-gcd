<template>
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h3 class="card-title">Tags</h3>
                  <button class="btn btn-success" @click="addNewTagModal">
                  <i class="fas fa-plus pr-1"></i>Add New Tag
                  </button>
               </div>
               <div class="card-body table-responsive p-0">
                  <table class="table table-hover">
                     <tbody>
                        <tr>
                           <th>ID</th>
                           <th>Tag Name</th>
                           <th>Modify</th>
                        </tr>
                        <tr v-for="tag in tags.data" :key="tag.id">
                           <td>{{tag.id}}</td>
                           <td>{{tag.tag_title}}</td>
                           <td>
                              <a class="cursor-pointer" @click="editTag(tag)"> <i class="far fas fa-pencil-alt"  style="color: #FFC107;"></i></a>
                              <a class="cursor-pointer" @click="deleteTagTitle(tag.id, tag.tag_title)"><i class="fas fa-trash red"></i></a>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="card-footer">
                  <pagination :data="tags" @pagination-change-page="getTagResults" :limit=5>
                     <span slot="prev-nav">&lt; Previous</span>
                     <span slot="next-nav">Next &gt;</span>
                  </pagination>
               </div>
            </div>
            <div class="card">
               <div class="card-header">
                  <h3 class="card-title">Assign tags to vouchers</h3>
                  <div class="card-tools">
                     <div class="input-group input-group-sm mt-3" style="width: 200px;">
                         <a @click.prevent="resetSearch"> <i class="fas fa-window-close" style="position:relative; right:10px; top:5px;font-size:20px; cursor:pointer;"></i></a>
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
                           <th>Tag Name(s)</th>
                           <th>Add/Remove tags</th>
                        </tr>
                        <tr v-for="voucher in vouchers.data" :key="voucher.id">
                           <td>{{voucher.id}}</td>
                           <td>{{voucher.name}}</td>
                           <td v-if="voucher.gettags.length == 0">-</td>
                           <div v-for="tag in voucher.gettags" :key="tag.id">
                              <td>{{tag.tag_title}}</td>
                           </div>
                           <td> 
                              <a class="cursor-pointer" @click="tagmodal(voucher.id)"><i class="fas fa-plus green"></i></a>
                              <a class="cursor-pointer" @click="deleteTag(voucher)"><i class="fas fa-trash red"></i></a>
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
               <!-- Modal for editing new tags -->
               <div class="modal fade" id="editTagModal" tabindex="-1" role="dialog" aria-labelledby="editTagModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Update an existing tag</h5>
                        </div>
                        <form @submit.prevent="updateTag()">
                           <div class="modal-body">
                              <!-- Tag name form input -->
                              <div class="form-group">
                                 <label>Name</label><span class="red">&#42;</span>
                                 <input v-model="tagForm.tag_title" type="text" name="tag_title" placeholder="Enter a name for the tag"
                                    class="form-control" :class="{ 'is-invalid': tagForm.errors.has('tag_title') }">
                                 <has-error :form="tagForm" field="tag_title"></has-error>
                              </div>
                              <p>Any vouchers that have this tag will also have their names updated</p>
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
               <!-- Modal for adding new tags -->
               <div class="modal fade" id="addNewTagModal" tabindex="-1" role="dialog" aria-labelledby="addNewTagModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Add new tag</h5>
                        </div>
                        <form @submit.prevent="addTag()">
                           <div class="modal-body">
                              <!-- Tag name form input -->
                              <div class="form-group">
                                 <label>Name</label><span class="red">&#42;</span>
                                 <input v-model="tagForm.tag_title" type="text" name="tag_title" placeholder="Enter a name for the tag"
                                    class="form-control" :class="{ 'is-invalid': tagForm.errors.has('tag_title') }">
                                 <has-error :form="tagForm" field="tag_title"></has-error>
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
               <!-- Modal for assigning new tags -->
               <div class="modal fade" id="addNewTag" tabindex="-1" role="dialog" aria-labelledby="addNewTagLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Assign a new tag</h5>
                        </div>
                        <form @submit.prevent="assignTag()">
                           <div class="modal-body">
                              <!-- Tags form input -->
                              <div class="form-group">
                                 <select name="tags" v-model="tagForm.tag_id" id="tag_title" class="form-control" 
                                    :class="{ 'is-invalid': tagForm.errors.has('tag_title') }">
                                    <option value="" disabled selected>Select tags</option>
                                    <option v-for="tag in sortedTags" :key="tag.id" v-bind:value="tag.id">{{tag.tag_title}}</option>
                                 </select>
                                 <has-error :form="tagForm" field="tag_title"></has-error>
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
               <!-- Modal for deleteing new tags -->
               <div class="modal fade" id="deleteTagModal" tabindex="-1" role="dialog" aria-labelledby="deleteTagLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Remove an existing tag</h5>
                        </div>
                        <form @submit.prevent="submitDeleteTag()">
                           <div class="modal-body">
                              <!-- Tags form input -->
                              <div class="form-group">
                                 <select name="tags" v-model="tagForm.tag_id" id="tag_title" class="form-control" 
                                    :class="{ 'is-invalid': tagForm.errors.has('tag_title') }">
                                    <option value="" disabled selected>Select tag</option>
                                    <option v-for="tag in voucherTags" :key="tag.id" v-bind:value="tag.id">
                                       {{tag.tag_title}}
                                    </option>
                                 </select>
                                 <has-error :form="tagForm" field="tag_title"></has-error>
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
            tags: {},
            currentPage: '',
            tagsall: {},
				tagForm: new Form({
					id: '',
					voucher_id: '',
					tag_id: '',
					tag_title: '',
					gettags: []
				}),
				vouchers: {},
			}
		},
		computed: {
			sortedTags() {
				return _.sortBy(this.tagsall, [tag => tag.tag_title.toLowerCase()], 'tag_id');
			},
			voucherTags() {
				return _.sortBy(this.tagForm.gettags, [tag => tag.tag_title.toLowerCase()], 'tag_id');
			}
		},
		methods: {
         resetSearch(){
				this.search='';
				Fire.$emit('searching');
			},
         searchTerm: function() {
         if (this.timeout) clearTimeout(this.timeout); 
         this.timeout = setTimeout(() => {
            Fire.$emit('searching');
         }, 500);
			},
			getTagResults(page = 1) {
				axios.get('api/tag?page=' + page)
					.then(response => {
						this.tags = response.data;
					});
			},
			getVoucherResults(page = 1) {
            this.currentPage = page;
				axios.get('api/voucher?page=' + page)
					.then(response => {
						this.vouchers = response.data;
					});
			},
			updateTag() {
				this.tagForm.put('api/tag/' + this.tagForm.id)
					.then(() => {
						Fire.$emit('RefreshVouchersAndTags');
						$('#editTagModal').modal('hide');
						swal.fire({
                     toast: true,
                     position: 'top',
                     showConfirmButton: false,
                     timer: 3500,
                     type: 'success',
                     title: 'Tag has been successfully updated'
						})
					})
					.catch(() => {
						swal.fire({
							title: 'Error',
							text: "Failed to update tag.",
							type: 'error'
						})
					})
			},
			editTag(tag) {
				this.tagForm.clear();
				this.tagForm.reset();
				$('#editTagModal').modal('show');
				this.tagForm.fill(tag);
			},
			deleteTagTitle(tagID, tagName) {
				swal.fire({
					title: 'Warning',
					html: 'Deleting the tag <b><b>' + tagName + ' </b></b>will also permanently remove it from all vouchers',
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#d33',
					cancelButtonColor: '#07AD4D',
					confirmButtonText: 'Delete'
				}).then((result) => {
					if (result.value) {
						this.tagForm.delete('api/tag/' + tagID).then(() => {
							swal.fire({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3500,
                        type: 'success',
                        title: 'Tag has been successfully deleted'
						   })
							Fire.$emit('RefreshVouchersAndTags');
						}).catch(() => {
							swal("Failed!", "Failed to delete tag.", "warning");
						});
					}
				})
			},
			addTag() {
				this.tagForm.post('api/tag')
					.then(() => {
						Fire.$emit('RefreshVouchersAndTags');
						$('#addNewTagModal').modal('hide');
						swal.fire({
                     toast: true,
                     position: 'top',
                     showConfirmButton: false,
                     timer: 3500,
                     type: 'success',
                     title: 'Tag has been successfully created'
						})
					})
					.catch(() => {
						swal.fire({
							title: 'Error',
							text: "Failed to create new tag.",
							type: 'error'
						})
					})
			},
			addNewTagModal() {
            this.tagForm.clear();
				this.tagForm.reset();
				$('#addNewTagModal').modal('show');
			},
			/* Deleting tags */
			submitDeleteTag() {
				let id = 0;
				this.tagForm.delete('api/vouchertag/' + id).then(() => {
						Fire.$emit('RefreshVouchersAndTags');
						$('#deleteTagModal').modal('hide');
						swal.fire({
                     toast: true,
                     position: 'top',
                     showConfirmButton: false,
                     timer: 3500,
                     type: 'success',
                     title: 'Tag successfully removed from voucher'
						})
					})
					.catch(() => {
						swal.fire({
							title: 'Error',
							text: "Failed to delete tag.",
							type: 'error'
						})
					})
			},
			deleteTag(voucher) {
				this.tagForm.clear();
				this.tagForm.reset();
				$('#deleteTagModal').modal('show');
				this.tagForm.fill(voucher);
			},
			/* Adding new tags */
			tagmodal(voucherid) {
				this.tagForm.clear();
				this.tagForm.reset();
				$('#addNewTag').modal('show');
				this.tagForm.voucher_id = voucherid;
			},
			assignTag() {
				this.tagForm.post('api/vouchertag').then(() => {
						Fire.$emit('RefreshVouchersAndTags');
						$('#addNewTag').modal('hide');
						swal.fire({
                     toast: true,
                     position: 'top',
                     showConfirmButton: false,
                     timer: 3500,
                     type: 'success',
                     title: 'Tag successfully assigned to voucher'
						})
					})
					.catch((error) => {
						swal.fire({
							title: 'Error',
							text: error,
							type: 'error'
						})
					})
			},
			/* Getting tag data */
			getTags() {
				axios.get('api/tag').then(({
					data
				}) => (this.tags = data));
         },
         getAllTags() {
				axios.get('api/tagall').then(({
					data
				}) => (this.tagsall = data));
			},
			/* Getting voucher data */
			getVouch() {
				axios.get('api/voucher').then(({
					data
				}) => (this.vouchers = data));
         },
         getVoucherSearch(){
            let query = this.search;
				axios.get('api/findVoucher?q=' + query)
				.then((data) => {
					this.vouchers = data.data;
				})
				.catch(error => {
               console.log(error);
				})
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
			Fire.$on('RefreshVouchersAndTags', () => {
            this.getAllTags();
            if(this.search == ''){
               axios.get('api/voucher?page=' + this.currentPage)
               .then(response => {
                  this.vouchers = response.data;
               });
				}
				else {
					this.getVoucherSearch();
            }
           
            this.getTags();
         });
         this.getAllTags();
			this.getVouch();
			this.getTags();
		}
	} 
</script>