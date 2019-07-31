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
                           <th>Name</th>
                           <th>Latitude</th>
                           <th>Longitude</th>
                           <th style="width: 25%">Modify</th>
                        </tr>
                        <tr v-for="location in locations.data" :key="location.id">
                           <td>{{location.id}}</td>
                           <td>{{location.name}}</td>
                           <td>{{location.latitude}}</td>
                           <td>{{location.longitude}}</td>
                           <td>
                               <a href="#" @click="editLocationModal(location)"> <i class="far fas fa-pencil-alt"  style="color: #FFC107;"></i></a>
                              <a href="#" @click="deleteLocation(location.id, location.name)"><i class="fas fa-trash red"></i></a>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="card-footer">
                  <pagination :data="locations" @pagination-change-page="getResults" :limit=5>
                     <span slot="prev-nav">&lt; Previous</span>
                     <span slot="next-nav">Next &gt;</span>
                  </pagination>
               </div>
            </div>
            <div class="card">
               <div class="card-header">Add New Location</div>
               <div class="card-body">
                  <form id="form-create" @submit.prevent="createLocation()">
                     <input type="hidden" name="_token"  id="token-create" />
                     <div class="form-group">
                        <label>Name</label>
                        <input v-model="locationForm.name" type="text" class="form-control" name="name" id="name" :class="{ 'is-invalid': locationForm.errors.has('name') }">
                        <has-error :form="locationForm" field="name"></has-error>
                     </div>
                     <div class="form-group">
                        <label>Latitude</label>
                        <input disabled v-model="locationForm.lat" type="text" id="txtLat" name="lat" class="form-control" :class="{ 'is-invalid': locationForm.errors.has('lat') }">
                        <has-error :form="locationForm" field="lat"></has-error>
                     </div>
                     <div class="form-group">
                        <label>Longitude</label>
                        <input disabled v-model="locationForm.long" type="text" id="txtLng" class="form-control" name="lng" :class="{ 'is-invalid': locationForm.errors.has('long') }"> 
                        <has-error :form="locationForm" field="long"></has-error>
                     </div>
                     <div class="text-center">
                        <button type="submit" class="btn btn-primary" id="btn-create">Create</button>
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
                           <!-- Location name form input -->
                           <div class="form-group">
                              <label>Name</label><span class="red">&#42;</span>
                              <input v-model="locationForm.name" type="text" name="name" placeholder="Enter a location name"
                                 class="form-control" :class="{ 'is-invalid': locationForm.errors.has('name') }">
                              <has-error :form="locationForm" field="name"></has-error>
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
				locationForm: new Form({
                    id: '',
                    name: '',
                    long: '',
                    lat: ''
				})
			}
        },
        methods:{
             getResults(page = 1) {
                axios.get('api/location?page=' + page)
                    .then(response => {
                        this.locations = response.data;
                    });
            },
             editLocationModal(location) {
                this.locationForm.clear();
                this.locationForm.reset();
                $('#editLocationModal').modal('show');
                this.locationForm.fill(location);
            },
             updateLocation() {
                this.locationForm.put('api/location/' + this.locationForm.id)
                    .then(() => {
                        Fire.$emit('RefreshLocations');
                        $('#editLocationModal').modal('hide');
                        swal.fire(
                            'Success!',
                            'Location has been successfully updated.',
                            'success'
                        )
                    })
                    .catch(() => {
                        swal.fire({
                            title: 'Error',
                            text: "Failed to update location.",
                            type: 'error'
                        })
                    })
            },
            deleteLocation(id, name) {
                swal.fire({
                    title: 'Are you sure?',
                    html: 'The following location will be permanently deleted: <b><b><br>' + name,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#07AD4D',
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if (result.value) {
                        this.locationForm.delete('api/location/' + id).then(() => {
                            swal.fire(
                                'Deleted!',
                                'Location has been deleted.',
                                'success'
                            )
                            Fire.$emit('RefreshLocations');
                        }).catch(() => {
                            swal("Failed!", "Failed to delete location.", "warning");
                        });
                    }
                })
            },
            createLocation() {
				this.locationForm.post('api/location')
					.then(() => {
                        Fire.$emit('RefreshLocations');
						swal.fire(
							'Success!',
							'Location added',
							'success',
                        )
                    this.locationForm.clear();
				        this.locationForm.reset();
					})
					.catch(() => {
						swal.fire({
							title: 'Error',
							text: "Error creating location.",
							type: 'error'
						})
					})
            },
             getLocations() {
                axios.get('api/location').then(({
                    data
                }) => (this.locations = data));
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
             Fire.$on('RefreshLocations', () => {
                this.getLocations();
            });
            this.getLocations();
            this.loadMap();

        }
    }
</script>
