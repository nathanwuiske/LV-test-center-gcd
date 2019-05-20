<template>
   <div class="container">
      <div class="row justify-content-center">
         <h3>Voucher and User data</h3>
         <div class="col-md-12">
            <div class="row">
               <div class="col-12 col-sm-3 col-md-3">
                  <div class="info-box">
                     <span class="info-box-icon bg-success elevation-1"><i class="fas fa-columns"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Total Vouchers</span>
                        <h3>{{voucherCount}}</h3>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-sm-3 col-md-3">
                  <div class="info-box mb-3">
                     <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-users"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Total Users</span>
                        <h3>{{userCount}}</h3>
                     </div>
                  </div>
               </div>
               <!-- fix for small devices only -->
               <div class="clearfix hidden-md-up"></div>
               <div class="col-12 col-sm-3 col-md-3">
                  <div class="info-box mb-3">
                     <span class="info-box-icon bg-danger elevation-1"><i class="far fa-plus-square"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">New Vouchers today</span>
                        <h3>{{latestVouchers}}</h3>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-sm-3 col-md-3">
                  <div class="info-box mb-3">
                     <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-user-plus"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">New Users today</span>
                        <h3>{{latestUsers}}</h3>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <h3>User activity</h3>
      </div>
      <p class="text-center">To be added.</p>
   </div>
</template>

<script>
    export default {
        data(){
            return {
                voucherCount: '',
                userCount: '',
                latestVouchers: '',
                latestUsers: ''
            }
        },
        methods: {
            getVoucherCount(){
                axios.get('/vouchercount').then(response => {
                this.voucherCount = response.data;
            });
            },
              getUserCount(){
                axios.get('/usercount').then(response => {
                this.userCount = response.data;
            });
            },
              getLatestVoucherCount(){
                axios.get('/latestvouchers').then(response => {
                this.latestVouchers = response.data;
            });
            },
            getLatestUserCount(){
                axios.get('/latestusers').then(response => {
                this.latestUsers = response.data;
            });
            }
        },
        mounted() {
           this.getVoucherCount();
           this.getUserCount();
           this.getLatestVoucherCount();
           this.getLatestUserCount();
        }
    }
</script>
