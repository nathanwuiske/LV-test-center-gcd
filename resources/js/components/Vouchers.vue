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
                     <div class="input-group input-group-sm mt-5" style="width: 270px;">
						
						  <a @click.prevent="resetSearch"> <i class="fas fa-window-close" style="position:relative; right:10px; top:5px;font-size:20px; cursor:pointer;"></i></a>
                        <input type="text" name="voucher_table_search" v-model="search" @keyup="searchTerm" class="form-control" placeholder="Search for Name or Description">
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
                           <th class="text-center" style="width: 12%">Modify</th>
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
                           <!-- End of Display categories -->
                           <td class="text-center">
							  <a class="cursor-pointer" @click="getMap(voucher.id, voucher.latitude, voucher.longitude, voucher.name)"> <i class="fas fa-map-marker-alt"  style="color: #0F7E15;"></i></a>
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

	<div class="modal fade" id="showMap" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add / Remove a location</h5>
				</div>
				<div class="modal-body">
					<form id="form-create" @submit.prevent="createLocation()">
					<input type="hidden" name="_token"  id="token-create" />
					<div class="form-group">
						<label>Voucher Name</label>
						<input disabled v-model="voucherForm.name" type="text" name="locName" class="form-control">
					</div>
					<div class="form-group">
						<label>Latitude</label>
						<input disabled v-model="locationForm.latitude" type="text" id="txtLat" name="latitude" class="form-control" :class="{ 'is-invalid': locationForm.errors.has('latitude') }">
						<has-error :form="locationForm" field="latitude"></has-error>
					</div>
					<div class="form-group">
						<label>Longitude</label>
						<input disabled v-model="locationForm.longitude" type="text" id="txtLng" class="form-control" name="longitude" :class="{ 'is-invalid': locationForm.errors.has('longitude') }"> 
						<has-error :form="locationForm" field="longitude"></has-error>
					</div>
					<div class="form-group">
						<p class="text-center"> To remove a location clear the values and then click Create Location.
						<div class="text-center">
							<button type="submit" class="btn btn-primary" id="btn-create">Create Location</button>
							<button type="button" @click="deleteLocation" class="btn btn-danger">Clear Values</button>
						</div>
					</div>
					</form>
					<div id="pac-container" class="text-center" style="z-index: 1050;">
						<div class="form-group">
							<input id="pac-input" type="text" placeholder="Search for a location" style="width:100%;">
						</div>
						<p class="text-center"> Once a location is searched the marker can be dragged for further accuracy</p>
					</div>
					<div id="map_canvas" style="width: auto; height: 600px;"></div>
					<div id="infowindow-content">
						<img src="" width="16" height="16" id="place-icon">
						<span id="place-name"  class="title"></span><br>
						<span id="place-address"></span>
					</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
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
<style>
/* Stops the Google Maps search from disappearing behind the modal */
.pac-container {
    z-index: 1050;
}
</style>
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
				}),
				locationForm: new Form({
                    id: '',
                    longitude: '',
					latitude: ''
				})
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
			getImage(image) {
				if(!image){
					var source = "imgs/errors/";
					image = "no-voucher-image.png";
				}
				else {
					var source = "imgs/vouchers/";
				}
				$('#imagepreview').attr('src', source + image);
				$('#showImage').modal('show');
			},
			getMap(id, latitude, longitude, vouchername){
		
			//	$('#addNewVoucher').modal('hide');
				$('#showMap').modal('show');
				this.voucherForm.name = vouchername;
				this.locationForm.latitude = latitude;
				this.locationForm.longitude = longitude;
				this.locationForm.id = id;
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
			deleteLocation(){
				this.locationForm.latitude = null;
				this.locationForm.longitude = null;
			},
			 createLocation() {
				this.locationForm.put('api/location/' + this.locationForm.id)
					.then(() => {
						Fire.$emit('RefreshVouchers');
						$('#showMap').modal('hide');
						      swal.fire({
                           toast: true,
                           position: 'top',
                           showConfirmButton: false,
                           timer: 3500,
                           type: 'success',
                           title: 'Location successfully assigned to voucher'
                         })
                    this.locationForm.clear();
				    this.locationForm.reset();
					})
					.catch(() => {
						swal.fire({
							title: 'Error',
							text: "Error assigning location.",
							type: 'error'
						})
					})
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
			loadMap() {
			// Creating map object
			var map = new google.maps.Map(document.getElementById('map_canvas'), {
				center: {
					lat: -28.017879,
					lng: 153.397253
				},
				zoom: 13
			});

			var card = document.getElementById('pac-card');
			var input = document.getElementById('pac-input');
			var types = document.getElementById('type-selector');
			var strictBounds = document.getElementById('strict-bounds-selector');

			map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
			var autocomplete = new google.maps.places.Autocomplete(input);
			autocomplete.bindTo('bounds', map);
			autocomplete.setFields(['address_components', 'geometry', 'icon', 'name']);
			var infowindow = new google.maps.InfoWindow();
			var infowindowContent = document.getElementById('infowindow-content');
			infowindow.setContent(infowindowContent);
			var marker = new google.maps.Marker({
				map: map,
				anchorPoint: new google.maps.Point(0, -29),
				draggable: true
			});

			var el = document.getElementById('txtLat');
			var el2 = document.getElementById('txtLng');
				autocomplete.addListener('place_changed', function () {

					infowindow.close();
					marker.setVisible(false);
					var place = autocomplete.getPlace();
					if (!place.geometry) {
						window.alert("No details available for input: '" + place.name + "'");
						return;
					}

					if (place.geometry.viewport) {
						map.fitBounds(place.geometry.viewport);
					} else {
						map.setCenter(place.geometry.location);
						map.setZoom(17); 
					}
					marker.setPosition(place.geometry.location);
					marker.setVisible(true);
					el2.value = place.geometry.location.lng();
					let event2 = new Event('input', {
						bubbles: true
					});
					el2.dispatchEvent(event2);
					el.value = place.geometry.location.lat();
					let event = new Event('input', {
						bubbles: true
					});
					el.dispatchEvent(event);
					var address = '';
					if (place.address_components) {
						address = [
							(place.address_components[0] && place.address_components[0].short_name || ''),
							(place.address_components[1] && place.address_components[1].short_name || ''),
							(place.address_components[2] && place.address_components[2].short_name || '')
						].join(' ');
					}
					infowindowContent.children['place-icon'].src = place.icon;
					infowindowContent.children['place-name'].textContent = place.name;
					infowindowContent.children['place-address'].textContent = address;
					infowindow.open(map, marker);
				});

				google.maps.event.addListener(marker, 'dragend', function (evt) {
					// trigger an event for v-model in vue instance
					el.value = evt.latLng.lat().toFixed(6);
					let event = new Event('input', {
						bubbles: true
					});
					el.dispatchEvent(event);
					el2.value = evt.latLng.lng().toFixed(6);
					let event2 = new Event('input', {
						bubbles: true
					});
					el2.dispatchEvent(event2);
					map.panTo(evt.latLng);
				});
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
				$("#imageUpload").val('');
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
				
				$("#imageUpload").val('');
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
			this.loadMap();
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