<template>
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h3 class="card-title">App Messaging</h3>
                  <button class="btn btn-success" @click="addNewMessageModal">
                  <i class="fas fa-plus pr-1"></i>Add New Message
                  </button>
               </div>
               <div class="card-body table-responsive p-0">
                  <table class="table table-hover">
                     <tbody>
                        <tr>
                           <th>ID</th>
                           <th>Title</th>
                           <th>Body</th>
                           <th>Image</th>
                           <th>Published At</th>
                           <th class="text-center" style="width: 3%">Modify</th>
                        </tr>
                        <tr v-for="message in messages.data" :key="message.id">
                           <td>{{message.id}}</td>
                           <td>{{message.title}}</td>
                           <td>{{message.body}}</td>
                           <td>View</td>
                           <td>{{message.created_at | formatDate}}</td>
                           <td>
                              <a class="cursor-pointer" @click="editMessageModal(message)"> <i class="far fas fa-pencil-alt"  style="color: #FFC107;"></i></a>
                              <a class="cursor-pointer" @click="deleteMessage(message.id)"><i class="fas fa-trash red"></i></a>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="card-footer">
                  <pagination :data="messages" @pagination-change-page="getResults" :limit=5>
                     <span slot="prev-nav">&lt; Previous</span>
                     <span slot="next-nav">Next &gt;</span>
                  </pagination>
               </div>
            </div>
         </div>
      </div>
      <!-- Modal for editing  -->
      <div class="modal fade" id="updateMessage" tabindex="-1" role="dialog">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">Update Message</h5>
               </div>
               <form @submit.prevent="updateMessage()">
                  <div class="modal-body">
                     <!-- Title form input -->
                     <div class="form-group">
                        <label>Title</label>
                        <input v-model="messageForm.title" type="text" name="title" placeholder="Enter a Home page message title"
                           class="form-control" :class="{ 'is-invalid': messageForm.errors.has('title') }">
                        <has-error :form="messageForm" field="title"></has-error>
                     </div>
                     <!-- Body form input -->
                     <div class="form-group">
                        <label>Body</label>
                        <textarea style="height:200px;" type="text" v-model="messageForm.body" 
                        class="form-control" :class="{ 'is-invalid': messageForm.errors.has('body') }"
                        name="body" placeholder="Enter a Home page message body"></textarea>
                        <has-error :form="messageForm" field="body"></has-error>
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
      <!-- Modal for adding new  -->
      <div class="modal fade" id="addNewMessage" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">Create new message</h5>
               </div>
               <form @submit.prevent="createMessage()">
                  <div class="modal-body">
                     <!-- Title form input -->
                     <div class="form-group">
                        <label>Title</label>
                        <input v-model="messageForm.title" type="text" name="title" placeholder="Enter a Home page message title"
                           class="form-control" :class="{ 'is-invalid': messageForm.errors.has('title') }">
                        <has-error :form="messageForm" field="title"></has-error>
                     </div>
                     <!-- Body form input -->
                     <div class="form-group">
                        <label>Body</label>
                        <textarea style="height:200px;" type="text"  v-model="messageForm.body" 
                        class="form-control" :class="{ 'is-invalid': messageForm.errors.has('body') }"
                        name="body" placeholder="Enter a Home page message body"></textarea>
                        <has-error :form="messageForm" field="body"></has-error>
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
            messages: {},
            currentPage: '',
				messageForm: new Form({
					id: '',
					title: '',
					body: '',
					image: '',
					created_at: ''
				})
			}
		},
		methods: {
			updateMessage() {
				this.messageForm.put('api/message/' + this.messageForm.id)
					.then(() => {
						Fire.$emit('RefreshMessages');
						$('#updateMessage').modal('hide');
						swal.fire({
                     toast: true,
                     position: 'top',
                     showConfirmButton: false,
                     timer: 3500,
                     type: 'success',
                     title: 'Message has been successfully updated'
                  })
					})
					.catch(() => {
						swal.fire({
							title: 'Error',
							text: "Failed to update message.",
							type: 'error'
						})
					})
            },
             createMessage() {
                this.messageForm.post('api/message')
                    .then(() => {
                        Fire.$emit('RefreshMessages');
                        $('#addNewMessage').modal('hide');
                        swal.fire({
                           toast: true,
                           position: 'top',
                           showConfirmButton: false,
                           timer: 3500,
                           type: 'success',
                           title: 'Message has been successfully created'
                         })
                    })
                    .catch(() => {
                        swal.fire({
                            title: 'Error',
                            text: "Failed to create new message.",
                            type: 'error'
                        })
                    })
            },
            deleteMessage(id) {
                swal.fire({
                    title: 'Are you sure?',
                    html: 'Are you sure you want to permanently delete message ID '+ id + '?' ,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#07AD4D',
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if (result.value) {
                        this.messageForm.delete('api/message/' + id).then(() => {
                            swal.fire({
                           toast: true,
                           position: 'top',
                           showConfirmButton: false,
                           timer: 3500,
                           type: 'success',
                           title: 'Message has been successfully deleted'
                         })
                            Fire.$emit('RefreshMessages');
                        }).catch(() => {
                            swal("Failed!", "Failed to delete message.", "warning");
                        });
                    }
                })
            },
            addNewMessageModal() {
				this.editmode = false;
				this.messageForm.clear();
				this.messageForm.reset();
				$("#addNewMessage").modal({
					backdrop: 'static',
					keyboard: false
				});
			},
			editMessageModal(message) {
				this.messageForm.clear();
				this.messageForm.reset();
				$("#updateMessage").modal({
					backdrop: 'static',
					keyboard: false
				});
				this.messageForm.fill(message);
			},
			getResults(page = 1) {
            this.currentPage = page;
				axios.get('api/message?page=' + page)
					.then(response => {
						this.messages = response.data;
					});
			},
			displayMessages() {
				axios.get("api/message").then(({
					data
				}) => (this.messages = data)) 
				.catch(error => {
							swal.fire({
							title: 'Error',
							text: error,
							type: 'error'
						})
				})
         },
         displayMessagesPaginate() {
         axios.get("api/message?page=" + this.currentPage).then(({
            data
         }) => (this.messages = data)) 
         .catch(error => {
                  swal.fire({
                  title: 'Error',
                  text: error,
                  type: 'error'
               })
         })
      }
		},
		/* END OF METHODS */
		mounted() {
			this.displayMessages();
			Fire.$on('RefreshMessages', () => {
				this.displayMessagesPaginate();
			});
		}
	} 
</script>