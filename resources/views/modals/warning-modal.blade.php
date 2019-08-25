
 <div class="modal fade" id="warningRedeem{{$voucherid}}" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header" style="background-color:#07AD4D;">
            <h5 class="modal-title" style="color: white; font-size: 15px;">Voucher Redemption</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 0.9; color: white; position:absolute;right: 2%;top: 2%;">
            <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
         </div>
         <div class="modal-body" style="background-color: #F2F2F2">
            Please ensure you are at the establishment before redeeming the voucher.<br>
            Once redeemed, you will have 5 minutes to present the voucher at the counter before the voucher is disabled.<br><br>
         </div>
         <div class="modal-footer" style="background-color: #F2F2F2">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" onClick="startRedeem({{$voucherid}}, {{$userid }})" data-dismiss="modal">Redeem</button>
         </div>
      </div>
   </div>
</div>
