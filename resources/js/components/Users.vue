<template>
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h3 class="card-title">Users Management</h3>
                  <div class="card-tools">
                     <div class="input-group input-group-sm mt-5" style="width: 170px; bottom:30px;">
                        <input type="text" name="users_table_search" v-model="search" @keyup="searchTerm" class="form-control" placeholder="Search">
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
                           <th>Email</th>
                           <th>Type</th>
                           <th>Phone number</th>
						   <th>Created At</th>
                           <th class="text-center" style="width: 3%">Modify</th>
                        </tr>
                        <tr v-for="user in users.data" :key="user.id">
                           <td>{{user.id}}</td>
                           <td>{{user.first_name}}</td>
						   <td>{{user.email}}</td>
                           <td>{{user.type}}</td>
                           <td>{{user.phone_number}}</td>
                           <td>{{user.created_at | formatDate}}</td>
                           <td>
                              <a class="cursor-pointer" @click="editUserModal(user)"> <i class="far fas fa-pencil-alt"  style="color: #FFC107;"></i></a>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="card-footer">
                  <pagination :data="users" @pagination-change-page="getResults" :limit=5>
                     <span slot="prev-nav">&lt; Previous</span>
                     <span slot="next-nav">Next &gt;</span>
                  </pagination>
               </div>
            </div>
         </div>
      </div>

      <div class="modal fade" id="updateUser" tabindex="-1" role="dialog">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">Update User</h5>
               </div>
               <form @submit.prevent="updateUser()">
                  <div class="modal-body">
                     <!-- Name form input -->
                     <div class="form-group">
                        <label>Name</label><span class="red">&#42;</span>
                        <input v-model="userForm.first_name" type="text" name="first_name" placeholder="User's name"
                           class="form-control" :class="{ 'is-invalid': userForm.errors.has('first_name') }">
                        <has-error :form="userForm" field="first_name"></has-error>
                     </div>
                     <!-- Email form input -->
                     <div class="form-group">
                        <label>Email</label><span class="red">&#42;</span>
                        <input v-model="userForm.email" type="text" name="email" placeholder="User's email"
                           class="form-control" :class="{ 'is-invalid': userForm.errors.has('email') }">
                        <has-error :form="userForm" field="email"></has-error>
                     </div>
                    <!-- Type form input -->
                     <div class="form-group">
                        <label>Type</label><span class="red">&#42;</span>
                        <select name="type" v-model="userForm.type" id="type" class="form-control" 
                           :class="{ 'is-invalid': userForm.errors.has('type') }">
                           <option value="" disabled selected>Please select an option</option>
                           <option value="user">User</option>
                           <option value="admin">Admin</option>
                        </select>
                        <has-error :form="userForm" field="type"></has-error>
                     </div>
                     <!-- Phone number form input -->
                     <div class="form-group">
                        <label>Phone number</label><span class="red">&#42;</span>
                        <input v-model="userForm.phone_number" type="text" name="phone_number" placeholder="User Phone number"
                           class="form-control" :class="{ 'is-invalid': userForm.errors.has('phone_number') }">
                        <has-error :form="userForm" field="phone_number"></has-error>
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
   </div>
</template>
<script>
	export default {
		data() {
			return {
				search: '',
				users: {},
				userForm: new Form({
					id: '',
					first_name: '',
					email: '',
					type: '',
					phone_number: '',
					created_at: ''
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
			updateUser() {
				this.userForm.put('api/users/' + this.userForm.id)
					.then(() => {
						Fire.$emit('RefreshUsers');
						$('#updateUser').modal('hide');
						swal.fire({
                     toast: true,
                     position: 'top',
                     showConfirmButton: false,
                     timer: 3500,
                     type: 'success',
                     title: 'User has been successfully updated'
                  })
					})
					.catch(() => {
						swal.fire({
							title: 'Error',
							text: "Failed to update user.",
							type: 'error'
						})
					})
			},
			editUserModal(user) {
				this.userForm.clear();
				this.userForm.reset();
				$("#updateUser").modal({
					backdrop: 'static',
					keyboard: false
				});
				this.userForm.fill(user);
			},
			getResults(page = 1) {
				axios.get('api/users?page=' + page)
					.then(response => {
						this.users = response.data;
					});
			},
			displayUsers() {
				axios.get("api/users").then(({
					data
				}) => (this.users = data)) 
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
			Fire.$on('searching', () => {
				let query = this.search;
				axios.get('api/findUser?q=' + query)
				.then((data) => {
					this.users = data.data;
				})
				.catch(error => {
					console.log(error);
				})
			});
			this.displayUsers();
			Fire.$on('RefreshUsers', () => {
				this.displayUsers();
			});
		}
	} 
</script>