   
function currentRedeem(voucher_id, user_id, times) {
	$("#redeem-current-" + voucher_id).css("display", "inline");
	$("#redeem_btn_" + voucher_id).attr("disabled", "disabled");
	$("#redeem-current-time-" + voucher_id).html(times['dateRedeemed']);
	$("#redeem-next-time-" + voucher_id).html(times['dateAvailable']);
}

function ajaxRedeem(voucher_id, user_id) {
	$.ajax({
		method: 'POST',
		url: 'api/redeem',
		data: {
			'voucher_id': voucher_id,
			'user_id': user_id
		},
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		success: function (response) {
			currentRedeem(voucher_id, user_id, response);
		},
		error: function () {
            Swal.fire({
				toast: true,
				position: 'top',
				showConfirmButton: false,
				timer: 3500,
				type: 'error',
				title: 'Failed to redeem voucher.'
			})
		}
	});
}


function addToFavourites(voucherid, userid) {
	$.ajax({
		type: 'post',
		url: 'api/addfavourite',
		data: {
			'user_id': userid,
			'voucher_id': voucherid,
		},
		success: function () {
			Swal.fire({
				toast: true,
				position: 'top',
            showConfirmButton: false,
				timer: 2000,
				type: 'success',
				title: 'Voucher added to favourites'
            })
            // hide add button
            $('#addfavourites' + voucherid).hide();
            // show delete button
            $('#deletefavourite' + voucherid).show();
		},
		error: function (XMLHttpRequest) {
			Swal.fire({
				toast: true,
				position: 'top',
				showConfirmButton: false,
				timer: 3500,
				type: 'error',
				title: 'Failed to add voucher to favourites'
			})
		}
	});

}

function deleteFromFavourites(voucherid, userid) {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		type: 'post',
		url: 'api/deletefavourite/' + voucherid,
		data: {
			'user_id': userid,
			'voucher_id': voucherid,
		},
		success: function () {
			Swal.fire({
				toast: true,
				position: 'top',
				showConfirmButton: false,
				timer: 3500,
				type: 'success',
				title: 'Voucher removed from favourites'
			})
			// show add button
         $('#addfavourites' + voucherid).show();
         // hide delete button
         $('#deletefavourite' + voucherid).hide();
		},
		error: function (xhr) {
			Swal.fire({
				toast: true,
				position: 'top',
				showConfirmButton: false,
				timer: 3500,
				type: 'error',
				title: 'Failed to remove voucher from favourites'
			})
		}
	});
}

