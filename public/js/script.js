$(document).ready(function() {
	$(".container").on("click", "#beginTest", function() {
		nextElement();
		startSpeedTest();
	});
	
	$(".container").on("click", "#secondTest", function() {
		nextElement();
		mirrorTest();
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
				saveDataToDb();
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
	
	if(download > 3 && upload > 3) {
		$("#testDebit").find(".smiley-vert").css("display", "block");
		$("#secondTest").css("display", "block");
		$("#firstTestContent").html("C'est parfait, on peut continuer !");
	}
	else if(download < 0.1 && upload < 0.1) {
		$("#testDebit").find(".smiley-rouge").css("display", "block");
		$("#secondTest").css("display", "block");
		$("#firstTestContent").html("Ouch ! La connexion n'est pas bonne mon capichef !");
	}
	else {
		$("#testDebit").find(".smiley-jaune").css("display", "block");
		$("#secondTest").css("display", "block");
		$("#firstTestContent").html("Ca pourrait être mieux mais on peut poursuivre.");
	}
}

function saveDataToDb() {
	var upload 		= $("#ulText").val();
	var download 	= $("#dlText").val();
	
	var formData = "upload=" + parseFloat(upload) + "&download=" + parseFloat(download);
	
    $.ajax({
        url: './ajax/saveBandwidth.php',
        type: "POST",
        dataType: "text",
        data : formData,
        success: function(data)
        {
			
        },
        error: function(jqXHR, textStatus, errorThrown){}
    });
}

/*
* ----------------------------------------------------------------------------------------
* 02. MIRROR FUNCTIONS
* ----------------------------------------------------------------------------------------
*/

function mirrorTest()
{
	var CONFERENCE_ROOM = "conference_demo";
	var localStream;

	// Initialize API client with application keys
	bc.init( {
		appId: "ea4ca2cc",
		appKey: "025b9c2ed0b585445504b3a8d66cac1f"
	} );

	// Test if the browser is WebRTC compatible
	if ( !bc.isCompatible() ) {
		// If the browser is not compatible, display an alert
		alert( "your browser is not WebRTC compatible !" );
		return;
	}

	// When local user is connected to the server
	bc.signaling.bind("onConnected", function () {
		// Ask the user to access to his webcam and set the resolution to 640x480
		bc.startStream("320x240", function(stream){
			// Set "localStream" variable with the local stream
			localStream = stream;
			// Insert the local webcam stream into the page body, mirror option invert the display
			bc.attachStream(localStream, q("#myCamera"), {mirror: true} );
			// Join a conference room called "conference_demo"
			bc.joinRoom(CONFERENCE_ROOM);
		});
	});

	// When the user has joined a room
	bc.signaling.bind("onJoinedRoom", function(result) {
		// Set room members array in a var "roomMembers"
		var roomMembers = result.members;
		 // Then, for every single members already present in the room ...
		for ( var i=0, max=roomMembers.length; i<max; i++ ) {
			// Request a call
			bc.call( roomMembers[i].id, CONFERENCE_ROOM, {stream: localStream, 'video-codec': 'H264/9000' } );
		}
	});

	// When a new remote stream is received
	bc.streams.bind("onStreamAdded", function (remoteStream) {
		// Insert the new remote stream into the page body
		bc.attachStream(remoteStream, q("#myCamera"));
	});

	// When a stream has been stopped
	bc.streams.bind("onStreamClosed", function(stream) {
		// Remove the stream from the page
		bc.detachStream(stream);
	});

	// Open a new session on the server
	bc.connect();
}

function q(query){
	// return the DOM node matching the query
	return document.querySelector( query );
}