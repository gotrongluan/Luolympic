var infoInputs = document.getElementsByClassName("admin-info");
var passwordInputs = document.getElementsByClassName("admin-password");
var infoStartValues = [];
var i;
for (i = 0; i < infoInputs.length; ++i) {
	infoStartValues[i] = infoInputs[i].value;
}

function startUpdate() {
	document.getElementById("update-btns").style.display = "none";
	document.getElementById("when-update-btns").style.display = "block";
	for ( i = 0; i < infoInputs.length; ++i ) {
		infoInputs[i].readOnly = false;
	}
}

function stopUpdate() {
	document.getElementById("when-update-btns").style.display = "none";
	document.getElementById("update-btns").style.display = "block";
	for (i = 0; i < infoInputs.length; ++i) {
		infoInputs[i].readOnly = true;
		infoInputs[i].value = infoStartValues[i];
	}
	document.getElementById("err-message").innerHTML = "";
}

function checkLastName(lastname) {
	var len = lastname.length;
	if (len < 3 || len > 30)
		throw "Họ và tên đệm không hợp lệ";
}

function checkFirstName(firstname) {
	var len = firstname.length;
	if (len == 0 || len > 7)
		throw "Tên không hợp lệ";
}

function checkPhoneNumber(phone) {
	var len = phone.length;
	if (len != 10)
		throw "Số điện thoại không hợp lệ";
}

function checkEmail(email) {
	var len = email.length;
	if (len < 20)
		throw "Email không hợp lệ";
}

function checkAddress(address) {
	var len = address.length;
	if (len < 15 || len > 50)
		throw "Địa chỉ không hợp lệ";
}

function saveUpdate() {
	try {
		var lastname = document.getElementsByName("last-name")[0].value;
		checkLastName(lastname);
		var firstname = document.getElementsByName("first-name")[0].value;
		checkFirstName(firstname);
		var phone = document.getElementsByName("phone-number")[0].value;
		checkPhoneNumber(phone);
		var email = document.getElementsByName("email")[0].value;
		checkEmail(email);
		var address = document.getElementsByName("address")[0].value;
		checkAddress(address);
		document.forms["admin-info-form"].submit();
	}
	catch(err) {
		document.getElementById("err-message").innerHTML = "<i class='fa fa-times'></i> " + err;
	}
}

function startChangePassword() {
	for (i = 0; i < infoInputs.length; ++i) {
		infoInputs[i].disabled = true;
	}
	document.getElementById("update-btn").disabled = true;
	document.getElementById("change-pass-btn").disabled = true;
	document.forms["change-password-form"].style.display = "block";
}

function stopChangePassword() {
	for (i = 0; i < passwordInputs.length; ++i) {
		passwordInputs[i].value = "";
	}
	document.getElementById("err-message-change-password").innerHTML = "";
	document.forms["change-password-form"].style.display = "none";
	for (i = 0; i < infoInputs.length; ++i) {
		infoInputs[i].disabled = false;
	}
	document.getElementById("update-btn").disabled = false;
	document.getElementById("change-pass-btn").disabled = false;
}

var getAdminPasswordRoutePath = document.getElementById("amPWurl").value;

function checkOldPassword(password) {
	var xhttp = new XMLHttpRequest();
	xhttp.open("GET", getAdminPasswordRoutePath, false);
	xhttp.send();
	var currentPassword = xhttp.responseText.trim();
	if (password !== currentPassword)
		throw "Mật khẩu cũ không đúng";
}

// function checkNewPassword(password) {
// 	var len = password.length;
// 	if (len < 4 || len > 30)
// 		throw "Mật khẩu mới không hợp lệ";
// }

function saveChangePassword() {
	try {
		var oldPassword = document.getElementsByName("old-password")[0].value;
		checkOldPassword(oldPassword);
		// var newPassword = document.getElementsByName("new-password")[0].value;
		// var newPasswordRetype = document.getElementsByName("new-password_confirmation")[0].value;
		// if (newPassword !== newPasswordRetype)
		// 	throw "Mật khẩu không khớp";
		//checkNewPassword(newPassword);
		document.forms["change-password-form"].submit();
	}
	catch(err) {
		document.getElementById("err-message-change-password").innerHTML = "<i class='fa fa-times'></i> " + err;
	}
}

