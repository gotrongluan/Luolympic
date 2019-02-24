function resetQuestion() {
	document.getElementsByClassName("richText-editor")[0].innerHTML = "";
}

function createEssayQuestion() {
	var answer = document.getElementById("the_answer").value;
	if (answer == "")
		document.getElementById("err-mess").innerHTML = "<i class='fa fa-times'></i> Đáp án không được phép rỗng";
	else {
		var questionContent = document.getElementsByClassName("richText-editor")[0].innerHTML;
		document.getElementById("question_content").value = questionContent;
		document.forms["essay-form"].submit();
	}
}