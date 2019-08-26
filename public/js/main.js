   
function currentRedeem(voucher_id, response) {
	$("#redeem-current-" + voucher_id).css("display", "inline");
	$("#start_redeem_" + voucher_id).attr("disabled", "disabled");
	$("#redeem-a" + voucher_id).addClass("disabled-a");
	$("#modal_image_" + voucher_id).css("opacity", "0.1");
	$("#redeem-current-time-" + voucher_id).html(response['dateRedeemed']);
	$("#redeem-next-time-" + voucher_id).html(response['dateAvailable']);
}

function warningRedeem(voucher_id) {
	$("#start_redeem_" + voucher_id).attr("disabled", "disabled");
	$("#redeem-a" + voucher_id).addClass("disabled-a");
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
			currentRedeem(voucher_id, response);
		},
		error: function (response) {
           //console.log(response);
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

function startTimer(duration, display, voucherid, userid) {
    var start = Date.now(),
        diff,
        minutes,
        seconds;
    function timer() {
        diff = duration - (((Date.now() - start) / 1000) | 0);
        minutes = (diff / 60) | 0;
        seconds = (diff % 60) | 0;

        minutes = minutes < 10 ?  minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = "Voucher will be redeemed in " + minutes + ":" + seconds; 

        if (diff <= 0) {
         display.textContent = ""; 
		 ajaxRedeem(voucherid, userid);
		 clearInterval(myTimer);
        }
        
    };
    timer();
    var myTimer = setInterval(timer, 1000);
}

function startRedeem(voucherid, userid) {
	 warningRedeem(voucherid);
	 $('#warningRedeem' + voucherid).modal('hide');
	 var fiveMinutes = 5 * 60;
	 var display = document.querySelector('#time'+voucherid);
	 startTimer(fiveMinutes, display, voucherid, userid);
 }

 function updateAccount(id, name, phone_number) {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		type: 'put',
		url: 'updateaccount/' + id,
		data: {
			'full_name': name,
			'phone_number': phone_number
		},
		success: function () {
			Swal.fire({
				toast: true,
				position: 'top',
				showConfirmButton: false,
				timer: 2000,
				type: 'success',
				title: 'Account settings successfully updated'
			})
		},
		error: function (response) {
			Swal.fire({
				toast: true,
				position: 'top',
				showConfirmButton: false,
				timer: 3500,
				type: 'error',
				title: 'The given information is invalid'
			})
		}
	});
} 

