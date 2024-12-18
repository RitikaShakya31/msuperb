// $("#otpbtn").click(function (e) {
// 	console.log($("#contactno").val());
// 	e.preventDefault();
// 	var secondsLeft = 30;
// 	var base_url = $("#base").val();
// 	var contactno = $("#contactno").val();
// 	if (contactno !== "") {
// 		$("#contactErrMsg").text("");
// 		$.ajax({
// 			type: "json",
// 			method: "POST",
// 			url: base_url + "UserHome/get_otp",
// 			data: { contactno: contactno },
// 			beforeSend: function () {
// 				$("#otpbtn").html('<i class="fa fa-spinner fa-spin"></i> Loading...');
// 			},
// 			success: function (response) {
// 				console.log("otp = " + response);
// 				var json = $.parseJSON(response);
// 				if (json.status == 1) {
// 					var countdownv = 30;
// 					$("#resend").hide();
// 					var refreshId = setInterval(function () {
// 						if (countdownv > 1) {
// 							$("#resendmsg").text("Resend in " + countdownv + " sec");
// 							countdownv--;
// 						} else {
// 							$("#resendmsg").text("");
// 							clearInterval(refreshId);
// 						}
// 					}, 1000);
// 					setTimeout(function () {
// 						$("#otpbtn").text("Resend OTP");
// 						$("#otpbtn").show();
// 					}, 30000);

// 					$("#otpbtn").hide();
// 					$("#verifybtn").show();
// 					$("#otpbox").show();
// 					$("#otpverify").show();

// 					// setTimeout(function () {
// 					// 	$('#otpbtn').text('Resend OTP');
// 					// 	$('#otpbtn').show();
// 					// }, 30000);
// 				}
// 				$("#otpmessage").html(
// 					'<p class="text-danger">' + json.login_msg + "</p><br/>"
// 				);
// 				$("#otpbtn").text("Request OTP");
// 			},
// 		});
// 	} else {
// 		$("#contactErrMsg").text("Please enter contact no.");
// 	}
// });

// $("#otpverify").click(function (e) {
// 	e.preventDefault();
// 	var base_url = $("#base").val();
// 	var contactno = $("#contactno").val();
// 	var otp = $("#otp").val();
// 	$.ajax({
// 		type: "json",
// 		method: "POST",
// 		url: base_url + "UserHome/verify_otp",
// 		data: {
// 			contactno: contactno,
// 			otp: otp,
// 		},
// 		success: function (response) {
// 			var json = $.parseJSON(response);

// 			$("#otpmessage").html(
// 				'<span class="text-danger">' + json.login_msg + "</span><br/>"
// 			);
// 			if (json.status == 1) {
// 				window.location.href = base_url + "orders";
// 			} else if (json.status == 3) {
// 				window.location.href = base_url + "checkout";
// 			} else {
// 				// window.location.href = base_url;
// 			}
// 		},
// 	});
// });

// $("#registerotpverify").click(function (e) {
// 	e.preventDefault();
// 	var base_url = $("#base").val();
// 	var contactno = $("#contactno").val();
// 	var otp = $("#otp").val();
// 	$.ajax({
// 		type: "json",
// 		method: "POST",
// 		url: base_url + "UserHome/check_verification",
// 		data: {
// 			contactno: contactno,
// 			otp: otp,
// 		},
// 		success: function (response) {
// 			var json = $.parseJSON(response);
// 			$("#otpmessage").html(
// 				'<span class="text-danger">' + json.reg_msg + "</span><br/>"
// 			);
// 			if (json.status == 1) {
// 				window.location.href = base_url;
// 			} else if (json.status == 3) {
// 				window.location.href = base_url + "checkout";
// 			} else {
// 				window.location.href = base_url;
// 			}
// 		},
// 	});
// });

// $(document).ready(function () {
// 	$(".forcheckotp").click(function (e) {
// 		e.preventDefault();
// 		var contactno = $("#contact").val();
// 		console.log(contactno);
// 		var base_url = $("#base").val();

// 		if (contactno !== "") {
// 			$.ajax({
// 				type: "POST",
// 				url: base_url + "UserHome/get_otp",
// 				data: { contactno: contactno },
// 				beforeSend: function () {
// 					$(".forcheckotp").html(
// 						'<i class="fa fa-spinner fa-spin"></i> Loading...'
// 					);
// 				},
// 				success: function (response) {
// 					var json = $.parseJSON(response);
// 					if (json.status == 1) {
// 						// Handle success
// 						alert(json.login_msg);
// 						var otpModal = new bootstrap.Modal(
// 							document.getElementById("staticBackdrop")
// 						);
// 						otpModal.show();
// 						// $(".forcheckotp").text("OTP Sent");
// 					} else {
// 						// Handle error
// 						alert(json.login_msg);
// 						// $(".forcheckotp").text("Try Again");
// 					}
// 				},
// 				error: function () {
// 					// Handle AJAX error
// 					alert("An error occurred while sending OTP.");
// 					// $(".forcheckotp").text("Try Again");
// 				},
// 			});
// 		} else {
// 			alert("Please enter your contact number.");
// 		}
// 	});
// });

// function login_check() {
// 	console.log("request click");
// 	var email = $("#user_email").val();
// 	if (email == "") {
// 		$("#emailerror").html("Email is required.").css("color", "red");
// 	} else {
// 		if (check_email_format(email) == "invalid") {
// 			$("#emailerror").html("Email format is not valid").css("color", "red");
// 		} else {
// 			$("#emailerror").html("");
// 			$.ajax({
// 				type: "POST",
// 				url: "UserHome/login_check",
// 				data: {
// 					email: email,
// 					type: "get_otp",
// 				},
// 				dataType: "json",
// 				success: function (response) {
// 					if (response.status == 200) {
// 						$("#loginotp").modal("show");
// 						$("#exampleModal").modal("hide");
// 					} else {
// 						$("#emailerror").text("Email does not exist").css("color", "red");
// 					}
// 				},
// 			});
// 		}
// 	}
// }

// function check_email_format(email) {
// 	var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
// 	return emailPattern.test(email) ? "valid" : "invalid";
// }

// $(document).ready(function () {
// 	var countdown = 20;
// 	var timer = setInterval(function () {
// 		countdown--;
// 		$("#resend-timer").text("" + countdown + " seconds to resend");
// 		if (countdown === 0) {
// 			clearInterval(timer);
// 			$("#resend-timer").hide();
// 			$("#resend-btn").show();
// 		}
// 	}, 1000);

// 	$("#resend-btn").click(function () {
// 		var email = $("#user_email").val();
// 		$.ajax({
// 			url: "<?= base_url('login_check') ?>",
// 			type: "POST",
// 			data: {
// 				email: email,
// 				type: "resend_otp",
// 			},
// 			success: function (response) {
// 				if (response.status != 200) {
// 					$("#otperror").text("Email does not exist").css("color", "red");
// 				}
// 			},
// 			error: function (xhr, status, error) {},
// 		});

// 		countdown = 20;
// 		$("#resend-btn").hide();
// 		$("#resend-timer").show();
// 		timer = setInterval(function () {
// 			countdown--;
// 			$("#resend-timer").text(
// 				"Please wait " + countdown + " seconds to resend the code."
// 			);
// 			if (countdown === 0) {
// 				clearInterval(timer);
// 				$("#resend-timer").hide();
// 				$("#resend-btn").show();
// 			}
// 		}, 1000);
// 	});

// 	$("#submitotp").click(function () {
// 		console.log('click on submit');
// 		$("#otperror").text("");	
// 		var email = $("#user_email").val();
// 		var otp = $("#otp").val();
// 		$.ajax({
// 			url: "UserHome/login_check",
// 			type: "POST",
// 			dataType: "json",
// 			data: {
// 				email: email,
// 				otp: otp,
// 				type: "check_otp",
// 			},
// 			success: function (response) {
// 				console.log(response);
// 				if (response.status == 200) {
// 					window.location.href = "<?= base_url('checkout') ?>";
// 				}
// 				else {
// 					console.log('error in redirection');
// 					$("#otperror").text(response.message).css("color", "red");
// 				}
// 			},
// 			error: function (xhr, status, error) {
// 				console.log('error');
// 				console.log(error);
// 			},
// 		});
// 	});
// });
