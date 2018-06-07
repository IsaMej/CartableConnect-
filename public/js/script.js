$(document).ready(function() {
	$(".container").on("click", ".next", function() {
		nextElement();
	});
});

function nextElement() {
	var activeId = $("#connectionTest").find(".active").attr("id");
	
	if(activeId != "testVideo") {$('#connectionTest').carousel('next');}
}

function previousElement() {
	var activeId = $("#connectionTest").find(".active").attr("id");
	
	if(activeId != "testDebit") {$('#connectionTest').carousel('previous');}
}