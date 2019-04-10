<template>
    <div class="container">
       <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Vouchers Management</h3>
                <button class="btn btn-success" data-toggle="modal" data-target="#addNewVoucher" data-backdrop="static" data-keyboard="false">
                    <i class="fas fa-plus pr-1"></i>Add New Voucher
                </button>
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
                    <th>Modify</th>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>Test</td>
                    <td>Some description</td>
                    <td>Some link</td>
                    <td>1</td>
                    <td>
                        <a href="#">Edit
                        <i class="far fa-edit"></i>
                        </a>
                        /
                        <a href="#">Delete
                        <i class="fas fa-trash"></i>
                        </a>
                    </td>
                  </tr>
                </tbody></table>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNewVoucher" tabindex="-1" role="dialog" aria-labelledby="newVoucherLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newVoucherLabel">Add new Voucher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Some text for the modal body
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Create</button>
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
