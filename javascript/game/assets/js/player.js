let DONE_ANGLE = 15;
let START_ANGLE = -9;
// run a timer to simulate a song playing
let secTimePassed = 0;
let minTimePassed = 0;

const moveToRecord = (percentage) => {
	const recAng = recordCompletionAngle(percentage, START_ANGLE, DONE_ANGLE);
	
	document.querySelector(".armBody").style.transform = `rotate(${recAng}deg)`;
	
	$(".record").addClass("rotating");
	// console.log(recAng + 'deg');
};

const stopRecord = (theClass) => {
	secTimePassed = 0;
};

//reverse engineer to get the value given the percentage
const normalize = (val, min, max) => {
	return (val - min) / (max - min);
};

// give back the angle value
const recordCompletionAngle = (percentage, min, max) => {
	return 1 * ((percentage / 100) * (max - min) + min);
};

let slider = document.getElementById("myRange");


// Update the current slider value (each time you drag the slider handle)
slider.onchange = function () {
	moveToRecord(this.value);
};


let secTimer = setInterval(() => {
	
	let today = new Date();
	let hours = today.getHours();
	let minutes = today.getMinutes();
	let seconds = today.getSeconds();
	
	let time = hours + ":" + minutes + ":" + seconds;
	
	slider.value = seconds;
	
	moveToRecord((seconds/60) * 100);

	document.querySelector("#timeMin").innerHTML = minutes;
	document.querySelector("#timeHour").innerHTML = hours;

}, 200);
