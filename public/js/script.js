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
testCall();
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

function getUserData() {
	var array = "";
    $.ajax({
        url: './ajax/getUserData.php',
        type: "GET",
		async: false,
        dataType: "json",
        success: function(data)
        {
			array = data;
        },
        error: function(jqXHR, textStatus, errorThrown){}
    });
	
	return array;
}

function mirrorTest() {
	var CONFERENCE_ROOM = "conference_demo";
	var localStream;

	// Initialize API client with application keys
	bc.init( {
		appId: "ea4ca2cc",
		appKey: "025b9c2ed0b585445504b3a8d66cac1f"
	} );

	// Test if the browser is WebRTC compatible
	if ( !bc.isCompatible() ) {
		alert( "your browser is not WebRTC compatible !" );
		return;
	}

	// When local user is connected to the server
	bc.signaling.bind("onConnected", function () {
		// Ask the user to access to his webcam and set the resolution to 340x220
		bc.startStream("400x300", function(stream){
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

/*
* ----------------------------------------------------------------------------------------
* 02. CALL FUNCTIONS
* ----------------------------------------------------------------------------------------
*/

var idUser 			= getUserData()['idUser'];
var username 		= getUserData()['userName'];
var idRemoteUser	= getUserData()['idRemoteUser'];

function testCall() {
	var room;
	
	var CONFERENCE_ROOM = "school_room";

	onBistriConferenceReady = function () {

		var localStream;

		// test if the browser is WebRTC compatible
		if ( !bc.isCompatible() ) {
			alert( "your browser is not WebRTC compatible !" );
			return;
		}

		// initialize API client with application keys
		bc.init( {
			appId: "ea4ca2cc",
			appKey: "025b9c2ed0b585445504b3a8d66cac1f",
			userId: idUser,
			userName: username,
			debug: true
		} );

		// when local user is connected to the server
		bc.signaling.bind( "onConnected", function () {
			// show pane with id "pane_1"
			showPanel( "pane_1" );
		} );

		// when an error occured on the server side
		bc.signaling.bind( "onError", function ( error ) {
			// display an alert message
			alert( error.text + " (" + error.code + ")" );
		} );

		// when the user has joined a room
		bc.signaling.bind( "onJoinedRoom", function ( data ) {
			// set the current room name
			room = data.room;
			// then, for every single members present in the room ...
			for ( var i=0, max=data.members.length; i<max; i++ ) {
				// ... request a call
				bc.call( data.members[ i ].id, data.room, { stream: localStream } );
			}
		} );

		// when an error occurred while trying to join a room
		bc.signaling.bind( "onJoinRoomError", function ( error ) {
			// display an alert message
		   alert( error.text + " (" + error.code + ")" );
		} );

		// when the local user has quitted the room
		bc.signaling.bind( "onQuittedRoom", function( room ) {
			// reset the current room name
			room = undefined;
			// show pane with id "pane_1"
			showPanel( "pane_1" );
			// stop the local stream
			bc.stopStream( bc.getLocalStreams()[ 0 ], function( stream ){
				// remove the local stream from the page
				bc.detachStream( stream );
			} );
		} );

		// when a new remote stream is received
		bc.streams.bind( "onStreamAdded", function ( remoteStream ) {
			bc.attachStream( remoteStream, q( "#cameras" ) );
		} );

		// when a local or a remote stream has been stopped
		bc.streams.bind( "onStreamClosed", function ( stream ) {
			// remove the remote stream from the page
			bc.detachStream( stream );
			// if room has not been quitted yet
			if( room ){
				// quit room
				bc.quitRoom( room );
			}
		} );

		// when a remote user presence status is received
		bc.signaling.bind( "onPresence", function ( result ) {
			if( result.presence != "offline" ){
				// ask the user to access to his webcam and set the resolution to 340x220
				bc.startStream( "340x220", function( stream ){
					// when webcam access has been granted
					// show pane with id "pane_2"
					showPanel( "pane_2" );
					// insert the local webcam stream into the page body, mirror option invert the display
					bc.attachStream( stream, q( "#cameras" ), { mirror: true } );
					// invite user
					bc.call( result.id, CONFERENCE_ROOM, { stream: stream } );
				} );
			}
			else{
				alert( "The user you try to reach is currently offline" );
			}
		} );

		// when a call request is received from remote user
		bc.signaling.bind( "onIncomingRequest", function ( request ) {
			// ask the user to accept or decline the invitation
			if( confirm( request.name + " is inviting you to join his conference room. Click \"Ok\" to start the call." ) ){
				// invitation has been accepted
				// ask the user to access to his webcam and set the resolution to 340x220
				 bc.startStream( "340x220", function( stream ){
					// when webcam access has been granted
					// show pane with id "pane_2"
					showPanel( "pane_2" );
					// set "localStream" variable with the local stream
					localStream = stream;
					// insert the local webcam stream into the page body, mirror option invert the display
					bc.attachStream( stream, q( "#cameras" ), { mirror: true } );
				   // then join the room specified in the "request" object
					bc.joinRoom( request.room );
				} );
			}
		} );

		// bind function "callUser" to button "Call XXX"
		q("#call").addEventListener("click", callUser);

		// bind function "stopCall" to button "Stop Call"
		q("#quit").addEventListener("click", stopCall);

		// open a new session on the server
		bc.connect();
	}
}

function callUser(){
    bc.getPresence(idRemoteUser);
}

function stopCall(){
    bc.quitRoom(room);
}

function getRandomRoomName(){
    var chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_";
    var randomId = "";
    for( var i=0; i<20; i++ ){
        randomId += chars.charAt( Math.random() * 63 );
    }
	
    return randomId;
}

function showPanel(id){
    var panes = document.querySelectorAll(".pane");
    // for all nodes matching the query ".pane"
    for( var i=0, max=panes.length; i<max; i++ ){
        // hide all nodes except the one to show
        panes[ i ].style.display = panes[ i ].id == id ? "block" : "none";
    };
}

function q(query){
	// return the DOM node matching the query
	return document.querySelector(query);
}