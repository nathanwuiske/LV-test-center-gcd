
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
         <div class="text-center">
               <img id="modal_image_{{$voucherid}}" src="{{url('imgs/vouchers/' . $voucherimage)}}">
         </div>
              
               <p style="font-size:15px;">
                     1. Please ensure you are at the business or establishment.<br>
                     2. Present voucher <strong>at point of sale</strong>, and <strong>press [Redeem Voucher]</strong>. <br>
                     3. Business representative will then press <strong>[confirm]</strong>.</p>

                     <button type="button" class="btn btn-success" onClick="startRedeem({{$voucherid}}, {{$userid }})" data-dismiss="modal">Confirm</button>
         </div>
         
         <div class="modal-footer" style="background-color: #F2F2F2">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            
         </div>
      </div>
   </div>
</div>
