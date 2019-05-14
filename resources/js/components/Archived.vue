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
                           <th>Facebook Link</th>
                           <th>Popular</th>
                           <th>Photo</th>
                           <th>Restore</th>
                        </tr>
                        <tr v-for="archive in archived.data" :key="archive.id">
                           <td>{{archive.id}}</td>
                           <td>{{archive.name}}</td>
                           <td class="truncateText">
                              <span>{{archive.description}}</span>
                           </td>
                           <td>{{archive.expiry_date | formatDate}}</td>
                           <td class="truncateText"><span>{{archive.facebook_link}}</span></td>
                           <td>{{archive.popular_flag}}</td>
                           <td><a href="#" @click="getPhoto(archive.photo)">Show</a></td>
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
            <!-- Photo Modal -->
            <div class="modal fade" id="showPhoto" tabindex="-1" role="dialog" aria-labelledby="showPhotoLabel" aria-hidden="true">
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
        data(){
            return {
                archived: {},
                 archiveForm: new Form({
                     id: ''
                 })
            }
        },
        methods: {
            getPhoto(photo) {
                $('#imagepreview').attr('src', "imgs/vouchers/" + photo);
                $('#showPhoto').modal('show');
            },
             getResults(page = 1) {
                axios.get('api/archived?page=' + page)
                    .then(response => {
                        this.archived = response.data;
                    });
            },
             getArchived() {
			    axios.get('api/archived').then(({data}) => (this.archived = data));
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
                            swal.fire(
                                'Restored!',
                                'Voucher has been restored.',
                                'success'
                            )
                            Fire.$emit('RefreshVouchers');
                        }).catch(() => {
                            swal("Failed!", "Failed to restore voucher.", "warning");
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
