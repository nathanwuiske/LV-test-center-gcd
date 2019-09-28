<template>
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="card">
              <h2 class="text-center" style="padding:10px;">Currently Set App Version as</h2>
            <h4 class="text-center" style="color:red;font-size:40px;">{{version_number["app_version"]}}</h4>
            <div class="text-center" style="padding:10px;">    
               <button @click="changeVersion()" class="btn btn-danger">Change App Version</button>
            </div>
            <div class="text-center">
               <p><span style="color:red;">WARNING:</span> Changing the app version to a version that 
               does not match the Google Play/Apple store versions will <strong>break</strong> the application <br>for users by continuously warning them update their application.
               <p> Make sure the number above matches the <strong>"Current Version"</strong> shown in Google Play/Apple store: </p>
               <img src="/imgs/1.png">
          
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
            version_number: '',
            	versionForm: new Form({
					app_version: ''
				})
			}
		},
		methods: {
         getVersion(){
              axios.get('api/app_version').then(response => {
                this.version_number = response.data;
            }).catch(error => {
						swal.fire({
						title: 'Version retrieval error',
						text: error,
						type: 'error'
					})
			});
         },
			changeVersion(){
            swal.fire({
					title: 'Are you sure?',
               type: 'warning',
			   input: 'text',
			   inputPlaceholder: "Enter new version number",
               html: 'Putting an incorrect version number will break the application for ALL users. Be careful.',
					showCancelButton: true,
					confirmButtonColor: '#DC3A32',
					cancelButtonColor: '#07AD4D',
					confirmButtonText: 'Change Version'
				}).then((result) => {
					if (result.value) {
                  this.versionForm.app_version = result.value;
						this.versionForm.put('api/app_version/' + 1).then(() => {
							swal.fire({
								toast: true,
								position: 'top',
								showConfirmButton: false,
								timer: 3500,
								type: 'success',
								title: 'App Version successfully changed.'
							})
							/* After archiving, send an event to refresh the voucher table */
							Fire.$emit('RefreshVersion');
						}).catch(() => {
							swal("Failed!", "Failed to change app version.", "warning");
						});
					}
				})
         }
		},

		mounted() {
         this.getVersion();
         	Fire.$on('RefreshVersion', () => {
			       this.getVersion();
			});
		}
	} 
</script>