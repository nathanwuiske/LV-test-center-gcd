
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
               <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-columns"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Vouchers</span>
                            <h3>{{voucherCount}}</h3>
                        </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-6">
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

                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="far fa-plus-square"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">New Vouchers today</span>
                            <h3>{{latestVouchers}}</h3>
                        </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-user-plus"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">New Users today</span>
                            <h3>{{latestUsers}}</h3>
                        </div>
                        </div>
                    </div>
                    </div>
               <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>
               <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.</p>
            </div>
        </div>
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
