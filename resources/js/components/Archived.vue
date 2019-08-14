<template>
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h3 class="card-title">Archived Vouchers</h3>
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
                           <th>Popular</th>
                           <th>Image</th>
                           <th>Restore</th>
                        </tr>
                        <tr v-if="archived.data.length === 0"><p style="text-align:center;color:#AD1707;">There are currently no archived vouchers.</p></tr>
                        <tr v-for="archive in archived.data" :key="archive.id">
                           <td>{{archive.id}}</td>
                           <td>{{archive.name}}</td>
                           <td class="truncateText">
                              <span>{{archive.description}}</span>
                           </td>
                           <td>{{archive.expiry_date | formatDate}}</td>
                           <td class="truncateText"><span>{{archive.website_link}}</span></td>
                           <td>{{archive.popular_flag}}</td>
                           <td><a href="#" @click="getImage(archive.image)">Show</a></td>
                           <td>
                              <a href="#" @click="restoreVoucher(archive.id, archive.name)"> <i class="fas fa-trash-restore"></i></a>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="card-footer">
                  <pagination :data="archived" @pagination-change-page="getResults" :limit=5>
                     <span slot="prev-nav">&lt; Previous</span>
                     <span slot="next-nav">Next &gt;</span>
                  </pagination>
               </div>
            </div>
            <!-- image Modal -->
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
				archived: {},
				archiveForm: new Form({
					id: ''
				})
			}
		},
		methods: {
			getImage(image) {
				$('#imagepreview').attr('src', "imgs/vouchers/" + image);
				$('#showImage').modal('show');
			},
			getResults(page = 1) {
				axios.get('api/archived?page=' + page)
					.then(response => {
						this.archived = response.data;
					});
			},
			getArchived() {
				axios.get('api/archived').then(({
					data
				}) => (this.archived = data));
			},
			restoreVoucher(id, name) {
				swal.fire({
					title: 'Voucher Restore',
					html: 'The following voucher will be restored: <b><b><br>' + name,
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3490DE',
					cancelButtonColor: '#07AD4D',
					confirmButtonText: 'Restore'
				}).then((result) => {
					if (result.value) {
						this.archiveForm.delete('api/archived/' + id).then(() => {
							swal.fire({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3500,
                        type: 'success',
                        title: 'Voucher has been successfully restored.'
							})
							Fire.$emit('RefreshVouchers');
						}).catch(() => {
							swal.fire({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3500,
                        type: 'error',
                        title: 'Failed to restore voucher.'
							})
						});
					}
				})
			}
		},

		mounted() {
			Fire.$on('RefreshVouchers', () => {
				this.getArchived();
			});
			this.getArchived();
		}
	} 
</script>