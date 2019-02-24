var containers = document.getElementsByClassName("the-container");
var curContainer = 0;			//question
var btns = document.getElementsByClassName("my-love-btn");
btns[curContainer].disabled = true;
var i = 0;
for (i = 0; i < btns.length; ++i) {
	btns[i].theIndex = i;
	btns[i].addEventListener("click", function ( event ) {
		var theBtn = event.target;
		theBtn.disabled = true;
		var myIndex = theBtn.theIndex;
		var textEditor = document.getElementsByClassName("richText-editor")[0];
		var text = textEditor.innerHTML;
		containers[curContainer].innerHTML = text;
		containers[curContainer].parentNode.classList.remove("edit-selected");
		btns[curContainer].disabled = false;
		curContainer = myIndex;
		theBtn.parentNode.parentNode.classList.add("edit-selected");
		text = containers[myIndex].innerHTML;
		textEditor.innerHTML = text;
	});
}

function createMultiChoice() {
	var textEditor = document.getElementsByClassName("richText-editor")[0];
	containers[curContainer].innerHTML = textEditor.innerHTML;
	document.getElementById("the_question").value = document.getElementById("question-container").innerHTML;
	document.getElementById("answer_a").value = document.getElementById("answer-a-container").innerHTML;
	document.getElementById("answer_b").value = document.getElementById("answer-b-container").innerHTML;
	document.getElementById("answer_c").value = document.getElementById("answer-c-container").innerHTML;
	document.getElementById("answer_d").value = document.getElementById("answer-d-container").innerHTML;
	document.forms["multi-choice-form"].submit();
}

function resetQuestion() {
	for(i = 0; i < containers.length; ++i) {
		containers[i].innerHTML = "";
		btns[i].disabled = false;
		containers[i].parentNode.classList.remove("edit-selected");
	}
	curContainer = 0;
	btns[curContainer].disabled = true;
	containers[curContainer].parentNode.classList.add("edit-selected");
	document.getElementsByClassName("richText-editor")[0].innerHTML = "";
}