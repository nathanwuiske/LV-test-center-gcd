<template>
    <div class="container">
       <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Vouchers table</h3>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>FB_link</th>
                    <th>is_Popular</th>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>Test</td>
                    <td>Some description</td>
                    <td>Some link</td>
                    <td>1</td>
                  </tr>
                </tbody></table>
              </div>
            </div>
          </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
