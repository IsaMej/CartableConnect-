$(document).ready(function() {
	$(".container").on("click", "#beginTest", function() {
		nextElement();
		startSpeedTest();
	});
});

/*
* ----------------------------------------------------------------------------------------
* 01. CAROUSEL FUNCTIONS
* ----------------------------------------------------------------------------------------
*/

function nextElement() {
	var activeId = $("#connectionTest").find(".active").attr("id");
	
	if(activeId != "testVideo") {$('#connectionTest').carousel('next');}
}

function previousElement() {
	var activeId = $("#connectionTest").find(".active").attr("id");
	
	if(activeId != "testDebit") {$('#connectionTest').carousel('previous');}
}

/*
* ----------------------------------------------------------------------------------------
* 02. SPEED TEST FUNCTIONS
* ----------------------------------------------------------------------------------------
*/

function I(id){return document.getElementById(id);}

var w = null; //speedtest worker

function startSpeedTest() {
	if(w!=null){
		//speedtest is running, abort
		w.postMessage('abort');
		w = null;
	}else{
		//test is not running, begin
		w=new Worker('./vendor/speedtest/speedtest_worker.min.js');
		w.postMessage('start'); //Add optional parameters as a JSON object to this command
		w.onmessage=function(e){
			var data=e.data.split(';');
			var status=Number(data[0]);
			if(status>=4){
				//test completed
				w = null;
				isValidBandwidth();
			}
			
			var prog = (Number(data[6])*2+Number(data[7])*2+Number(data[8]))/5;
			I("progress").style.width = (100*prog)+"%";
			I("testPurcent").textContent = parseInt(100*prog) + " %";
			
			//I("ip").textContent=data[4];
			I("ulText").value =(status==1&&data[1]==0)?"...":data[1];
			I("dlText").value =(status==3&&data[2]==0)?"...":data[2];
			//I("pingText").textContent=data[3];
			//I("jitText").textContent=data[5];
		};
	}
}
//poll the status from the worker every 200ms (this will also update the UI)
setInterval(function(){
	if(w) w.postMessage('status');
},200);

/*
* ----------------------------------------------------------------------------------------
* 03. SMILEY FUNCTION
* ----------------------------------------------------------------------------------------
*/

function isValidBandwidth() {
	var download 	= parseFloat($("#dlText").val());
	var upload 		= parseFloat($("#ulText").val());
}