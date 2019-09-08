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
            <div class="col-12 col-sm-12 col-md-12 text-center">
               <div class="info-box mb-3">
                  <div class="info-box-content">
                     <span class="info-box-text">Active Users</span>
                     <h3>{{metric_data['activeUsers']}} website users online right now</h3>
                  </div>
               </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 text-center">
               <div class="info-box mb-3">
                  <div class="info-box-content">
                     <span class="info-box-text">Top 5 Redeemed Vouchers</span>
                     <div class="table-responsive p-0">
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
                  </div>
               </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 text-center">
               <div class="info-box mb-3">
                  <div class="info-box-content">
                     <span class="info-box-text">Top 5 Favourited Vouchers</span>
                     <div class="table-responsive p-0">
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
                  </div>
               </div>
            </div>
         </div>
      </div>
      <h3>User activity</h3>
   </div>
   <canvas id="visitorChart" width="400" height="200"></canvas>
   <canvas id="myChart" width="400" height="200"></canvas>
   <canvas id="browserChart" width="400" height="200"></canvas>
</div>
</template>
<script>
    export default {
        data(){
            return {
                metric_data: {},
                 isLoading: false
            }
        },
        methods: {
             getMetrics(){
                this.isLoading = true;
                axios.get('api/metrics').then(response => {
                this.metric_data = response.data;
                this.loadPageViewsChart(this.metric_data);
                this.loadBrowserChart(this.metric_data);
                this.loadVisitorChart(this.metric_data);
                this.isLoading = false;
            }).catch(error => {
						swal.fire({
						title: 'Dashboard retrieval error',
						text: error,
						type: 'error'
					})
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
            loadVisitorChart(metric_data){
               var ctx = document.getElementById('visitorChart').getContext('2d');
               var i;
               var visitData = [];
               var labels = [];
               for (i = 0; i < metric_data.pageVisits.length; i++) { 
                     visitData.push(metric_data.pageVisits[i].visitors);
                     labels.push(moment(metric_data.pageVisits[i].date).format("DD-MM"));
               }
               var myChart = new Chart(ctx, {
                 type: 'line',
                  data: {
                     labels: labels,
                     datasets: [{
                           label: '# of Sessions',
                           data: visitData,
                           fill: false,
                           backgroundColor: ['#5ABFC0'],
                           borderColor: ['#5ABFC0'],
                           pointBorderColor: ['#5ABFC0']
                     }]
                  },
                  options: {
                     legend: {
                        display: false,
                     },
                     title: {
                        display: true,
                        text: 'Website Visitors this month'
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
