<template>
   <div class="container">
      <script type="application/javascript" ></script>
      <div class="row justify-content-center">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header">
                  <h3 class="card-title">Locations</h3>
               </div>
               <div class="card-body table-responsive p-0">
                  <table class="table table-hover">
                     <tbody>
                        <tr>
                           <th>ID</th>
                           <th>Voucher Name</th>
                           <th>Latitude</th>
                           <th>Longitude</th>
                           <th style="width: 25%">Modify</th>
                        </tr>
                        <tr v-for="voucher in vouchers.data" :key="voucher.id">
                           <td>{{voucher.id}}</td>
                           <td>{{voucher.name}}</td>
                           <td>{{voucher.latitude}}</td>
                           <td>{{voucher.longitude}}</td>
                           <td>
                              <a href="#" @click="editLocationModal(voucher)"> <i class="far fas fa-pencil-alt"  style="color: #FFC107;"></i></a>
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
            <div class="card">
               <div class="card-header">Assign Location to Voucher</div>
               <div class="card-body">
                  <form id="form-create" @submit.prevent="createLocation()">
                     <input type="hidden" name="_token"  id="token-create" />
                     <div class="form-group">
                        <select name="name" v-model="locationForm.id" id="name" class="form-control" 
                           :class="{ 'is-invalid': locationForm.errors.has('name') }">
                           <option value="" disabled selected>Select Voucher</option>
                           <option v-for="voucher in sortedVouchers" :key="voucher.id" v-bind:value="voucher.id">{{voucher.id}} - {{voucher.name}}</option>
                        </select>
                        <has-error :form="locationForm" field="name"></has-error>
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
                     <div class="text-center">
                        <button type="submit" class="btn btn-primary" id="btn-create">Create Location</button>
                     </div>
                  </form>
               </div>
            </div>
            <div class="card">
               <div class="card-header">Select Location</div>
               <div class="card-body">
                  <p class="text-center">Drag the marker to the location to get Latitude and Longitude values.</p>
                  <div class="col-12" >
                     <div id="map_canvas" style="width: auto; height: 600px;"></div>
                  </div>
               </div>
            </div>
            <!-- Modal for editing locations -->
            <div class="modal fade" id="editLocationModal" tabindex="-1" role="dialog" aria-labelledby="editTagModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Update an existing location</h5>
                     </div>
                     <form @submit.prevent="updateLocation()">
                        <div class="modal-body">
                           <!-- longitude input -->
                           <div class="form-group">
                              <label>longitude</label><span class="red">&#42;</span>
                              <input v-model="locationForm.longitude" type="text" name="longitude" placeholder="Enter longitude"
                                 class="form-control" :class="{ 'is-invalid': locationForm.errors.has('longitude') }">
                              <has-error :form="locationForm" field="longitude"></has-error>
                           </div>
                           <!-- latitude input -->
                           <div class="form-group">
                              <label>latitude</label><span class="red">&#42;</span>
                              <input v-model="locationForm.latitude" type="text" name="latitude" placeholder="Enter latitude"
                                 class="form-control" :class="{ 'is-invalid': locationForm.errors.has('latitude') }">
                              <has-error :form="locationForm" field="latitude"></has-error>
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
      </div>
   </div>
</template>

<script>
    export default {
        data() {
			return {
            locations: {},
            vouchers: {},
            allVouchers: {},
				locationForm: new Form({
                    id: '',
                    longitude: '',
                    latitude: ''
				})
			}
        },
        computed: {
			sortedVouchers() {
				return _.sortBy(this.allVouchers, [voucher => voucher.name], 'id');
			},
		},
        methods:{
             getResults(page = 1) {
                axios.get('api/voucher?page=' + page)
                    .then(response => {
                        this.vouchers = response.data;
                    });
            },
             editLocationModal(voucher) {
                this.locationForm.clear();
                this.locationForm.reset();
                $('#editLocationModal').modal('show');
                this.locationForm.fill(voucher);
            },
             updateLocation() {
                this.locationForm.put('api/location/' + this.locationForm.id)
                    .then(() => {
                        Fire.$emit('RefreshVouchers');
                        $('#editLocationModal').modal('hide');
                        swal.fire({
                           toast: true,
                           position: 'top',
                           showConfirmButton: false,
                           timer: 3500,
                           type: 'success',
                           title: 'Location has been successfully updated'
                         })
                    })
                    .catch(() => {
                        swal.fire({
                            title: 'Error',
                            text: "Failed to update location.",
                            type: 'error'
                        })
                    })
            },
            createLocation() {
				this.locationForm.put('api/location/' + this.locationForm.id)
					.then(() => {
                        Fire.$emit('RefreshVouchers');
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
            getVouchers() {
                axios.get('api/voucher').then(({
                    data
                }) => (this.vouchers = data));
            },
             getAllVouchers() {
                axios.get('api/voucherall').then(({
                    data
                }) => (this.allVouchers = data));
            },
            loadMap(){
                // Creating map object
                var map = new google.maps.Map(document.getElementById('map_canvas'), {
                    zoom: 12,
                    center: new google.maps.LatLng(-28.032868, 153.410143),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                // creates a draggable marker to the given coords
                var vMarker = new google.maps.Marker({
                    position: new google.maps.LatLng(-28.032868, 153.410143),
                    draggable: true
                });

                var el = document.getElementById('txtLat');
                var el2 = document.getElementById('txtLng');
                // adds a listener to the marker
                // gets the coords when drag event ends
                // then updates the input with the new coords
                google.maps.event.addListener(vMarker, 'dragend', function (evt) {
                
                    // trigger an event for v-model in vue instance
                    el.value = evt.latLng.lat().toFixed(6);
                    let event = new Event('input', { bubbles: true });
                    el.dispatchEvent(event);

                    el2.value = evt.latLng.lng().toFixed(6);
                    let event2 = new Event('input', { bubbles: true });
                    el2.dispatchEvent(event2);
                // $("#txtLat").val(evt.latLng.lat().toFixed(6));
                //var event = new Event('input', {bubbles: true})
                // $("#txtLng").val(evt.latLng.lng().toFixed(6));
                    map.panTo(evt.latLng);
                });

                // centers the map on markers coords
                map.setCenter(vMarker.position);

                // adds the marker on the map
                vMarker.setMap(map);
            }
        },
        mounted() {
             Fire.$on('RefreshVouchers', () => {
                this.getVouchers();
            });
            this.getAllVouchers();
            this.getVouchers();
            this.loadMap();
        }
    }
</script>
