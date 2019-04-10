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

        <!-- Modal for adding new voucher -->
        <div class="modal fade" id="addNewVoucher" tabindex="-1" role="dialog" aria-labelledby="newVoucherLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newVoucherLabel">Add new Voucher</h5>
                </div>
                <div class="modal-body">
                    Some text for the modal body
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger closefirstmodal">Close</button>
                    <button type="button" class="btn btn-success">Create</button>
                </div>
                </div>
            </div>
        </div>
<!-- Warning Modal for confirming close -->
<div id="Warning" class="modal fade" role="dialog" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
             <div class="modal-header">
                 
                    <h5 class="modal-title" id="Warning">
                        <i class="fas fa-exclamation-triangle red"></i>
                        Warning</h5>
                </div>
            <div class="modal-body">
                <p>Are you sure you want to close? All data will be lost.</p>
                <button type="button" class="btn btn-danger confirmclosed">Confirm Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel Close</button>
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
            $(document).ready(function () {
                $('.closefirstmodal').click(function () {
                    $('#Warning').modal('show');
                });
                $('.confirmclosed').click(function () {
                    $('#Warning').modal('hide');
                    $('#addNewVoucher').modal('hide');
                });
        });
        }
        
    }
</script>
