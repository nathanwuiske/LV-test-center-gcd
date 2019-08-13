<template>
   <div class="container">
       <div class="vld-parent">
            <loading :active.sync="isLoading"></loading>
       </div>
      <div class="row justify-content-center">
         <h3>Voucher and User overview</h3>
         <div class="col-md-12">
            <div class="row">
               <div class="col-12 col-sm-3 col-md-3">
                  <div class="info-box">
                     <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-columns"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Total Vouchers</span>
                        <h3>{{metric_data['countTotalVouchers']}}</h3>
                     </div>
                  </div>
               </div>
               <!-- fix for small devices only -->
               <div class="clearfix hidden-md-up"></div>
               <div class="col-12 col-sm-3 col-md-3">
                  <div class="info-box mb-3">
                     <span class="info-box-icon bg-primary elevation-1"><i class="far fa-plus-square"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">New Vouchers today</span>
                        <h3>{{metric_data['countVouchersToday']}}</h3>
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
               
               <div class="col-12 col-sm-3 col-md-3">
                  <div class="info-box mb-3">
                     <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-user-plus"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">New Users today</span>
                        <h3>{{metric_data['countUsersToday']}}</h3>
                     </div>
                  </div>
               </div>
            </div>
         </div>
        
      </div>

       <div class="row justify-content-center">
         <div class="col-md-12">
            <div class="row">
 
    
               <!-- fix for small devices only -->
               <div class="clearfix hidden-md-up"></div>
               <div class="col-12 col-sm-6 col-md-6">
                  <div class="info-box mb-3">
                     <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-alt"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Active Users</span>
                        <h3>{{metric_data['activeUsers']}} user(s) online right now</h3>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-sm-6 col-md-6">
                  <div class="info-box mb-3">
                     <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-circle"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Site activity (last 7 days)</span>
                        <h3 v-for="page in metric_data.pageVisits" :key="page.pageTitle">
                          {{page.visitors}} vistors</h3>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <h3>User activity</h3> 
      </div>
      <canvas id="myChart" width="400" height="200"></canvas>
      <canvas id="browserChart" width="400" height="200"></canvas>

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
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';

    export default {
        data(){
            return {
                metric_data: {},
                 isLoading: false
            }
        },
         components: {
            Loading
        },
        methods: {
             getMetrics(){
                this.isLoading = true;
                axios.get('api/metrics').then(response => {
                this.metric_data = response.data;
                this.loadPageViewsChart(this.metric_data);
                this.loadBrowserChart(this.metric_data);
                this.isLoading = false;
            });
            },
            loadPageViewsChart(metric_data){
               var ctx = document.getElementById('myChart').getContext('2d');
               var i;
               var arr = [];
               var labels = [];
               for (i = 0; i < metric_data.mostVisited.length; i++) { 
                     arr.push(metric_data.mostVisited[i].pageViews);
                     labels.push(metric_data.mostVisited[i].url);
               }
               var myChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                     labels: labels,
                     datasets: [{
                           label: '# of Views',
                           data: arr,
                           backgroundColor: [
                              'rgba(255, 99, 132)',
                              'rgba(54, 162, 235)',
                              'rgba(255, 206, 86)',
                              'rgba(75, 192, 192)',
                              'rgba(153, 102, 255)',
                              'rgba(255, 159, 64)'
                           ],
                           borderColor: [
                              'rgba(255, 99, 132, 1)',
                              'rgba(54, 162, 235, 1)',
                              'rgba(255, 206, 86, 1)',
                              'rgba(75, 192, 192, 1)',
                              'rgba(153, 102, 255, 1)',
                              'rgba(255, 159, 64, 1)'
                           ],
                           borderWidth: 1
                     }]
                  },
                  options: {
                     legend: {
                        display: false,
                     },
                     title: {
                        display: true,
                        text: 'Most Visited Pages (last 7 days)'
                      },
                     responsive: true,
                     scales: {
                           yAxes: [{
                              ticks: {
                                 beginAtZero: true
                              }
                           }]
                     }
                  }
               });
            },
             loadBrowserChart(metric_data){
               var ctx = document.getElementById('browserChart').getContext('2d');
               var i;
               var browserData = [];
               var labels = [];
               for (i = 0; i < metric_data.browser.length; i++) { 
                     browserData.push(metric_data.browser[i].sessions);
                     labels.push(metric_data.browser[i].browser);
               }
               var myChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                     labels: labels,
                     datasets: [{
                           label: '# of Sessions',
                           data: browserData,
                           backgroundColor: [
                              'rgba(255, 99, 132)',
                              'rgba(54, 162, 235)',
                              'rgba(255, 206, 86)',
                              'rgba(75, 192, 192)',
                              'rgba(153, 102, 255)',
                              'rgba(255, 159, 64)'
                           ],
                           borderColor: [
                              'rgba(255, 99, 132, 1)',
                              'rgba(54, 162, 235, 1)',
                              'rgba(255, 206, 86, 1)',
                              'rgba(75, 192, 192, 1)',
                              'rgba(153, 102, 255, 1)',
                              'rgba(255, 159, 64, 1)'
                           ],
                           borderWidth: 1
                     }]
                  },
                  options: {
                     legend: {
                        display: false,
                     },
                     title: {
                        display: true,
                        text: 'Top Browsers Used'
                      },
                     responsive: true,
                     scales: {
                           yAxes: [{
                              ticks: {
                                 beginAtZero: true
                              }
                           }]
                     }
                  }
               });
            }
        },
        mounted() {
           this.getMetrics();
        }
    }
</script>
