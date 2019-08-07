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
                        <h3>{{metric_data['countVouchersUsers']}}</h3>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-sm-3 col-md-3">
                  <div class="info-box mb-3">
                     <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-users"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Total Users</span>
                        <h3>{{metric_data['countTotalUsers']}}</h3>
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
                        <h3>{{metric_data['countVouchersToday']}}</h3>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-sm-3 col-md-3">
                  <div class="info-box mb-3">
                     <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-user-plus"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">New Users today</span>
                        <h3>{{metric_data['countUsersToday']}}</h3>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <h3>User activity</h3>
      </div>
      <p class="text-center">To be added.</p>
      <div class="col-md-12">
        <div class="card">
               <div class="card-header">
                  <h3 class="card-title">Top 5 Favourited Vouchers</h3>
               </div>
               <div class="card-body table-responsive p-0">
                  <table class="table table-hover">
                    <tbody>
                        <tr>
                           <th>Voucher ID</th>
                           <th>Voucher Name</th>
                           <th>Favourite Count</th>
                        </tr>
                        <tr v-for="voucher in metric_data.favourited" :key="voucher.id">
                           <td>{{voucher.voucher_id}}</td>
                           <td>{{voucher.name}}</td>
                           <td>{{voucher.favourite_count}}</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="card-footer"></div>
            </div>
        </div>


          <div class="col-md-12">
        <div class="card">
               <div class="card-header">
                  <h3 class="card-title">Top 5 Redeemed Vouchers</h3>
               </div>
               <div class="card-body table-responsive p-0">
                  <table class="table table-hover">
                    <tbody>
                        <tr>
                           <th>Voucher ID</th>
                           <th>Voucher Name</th>
                           <th>Redeem Count</th>
                        </tr>
                        <tr v-for="voucher in metric_data.redeemed" :key="voucher.id">
                           <td>{{voucher.voucher_id}}</td>
                           <td>{{voucher.name}}</td>
                           <td>{{voucher.redeem_count}}</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="card-footer"></div>
            </div>
        </div>
   </div>
</template>

<script>
    export default {
        data(){
            return {
                metric_data: ''
            }
        },
        methods: {
             getMetrics(){
                axios.get('api/metrics').then(response => {
                this.metric_data = response.data;
            });
            }
        },
        mounted() {
           this.getMetrics();
        }
    }
</script>
