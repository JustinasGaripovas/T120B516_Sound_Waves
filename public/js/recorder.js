const playButtonId = "play";

navigator.getUserMedia = navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia;

audioUrl = document.currentScript.getAttribute("data-file-path");

let canvas;
let canvasContext;
let centerX;
let centerY;
let xPos;
let yOld;

let recorderAverage = 0;
let finalScore = 0;
let scoredSum = 0;
let tickCount = 0;

window.addEventListener('DOMContentLoaded', (event) => {
    canvas = document.querySelector("canvas");
    canvasContext = canvas.getContext("2d");
    centerX = canvas.width / 2;
    centerY = canvas.height / 2;
    xPos = 0;
    yOld = centerY * 1.8;

    handleVoiceRecordingAndDrawing();
});

function normalize(val, max, min){ return (val - min) / (max - min); }

function drawFollowingBar() {
    canvasContext.beginPath();
    canvasContext.fillRect(0, centerY + 140, xPos, 15);
    canvasContext.fillStyle = '#42FF00';
    canvasContext.fill();
    canvasContext.lineWidth = 2;
    canvasContext.closePath();
}

function getAverageAudioY(analyser) {
    let array = new Uint8Array(analyser.frequencyBinCount);
    analyser.getByteFrequencyData(array);
    let values = centerY;

    let length = array.length;
    for (let i = 0; i < length; i++) {
        values += (array[i]);
    }

    return -1 * ((values / length) - centerY * 1.8);
}

function drawActiveVoiceWave(average) {
    canvasContext.beginPath();
    canvasContext.moveTo(xPos, yOld);
    canvasContext.lineTo(xPos += 10, average);
    yOld = average
    canvasContext.strokeStyle = '#0b49e6';
    canvasContext.lineWidth = 2;

    canvasContext.stroke();
    canvasContext.closePath();
}

function changeBackgroundColorAccordingToVoiceFrequency(average) {
    let precentage = (average - 240) / (410 - 240) * -100;

    if(precentage > 100)
        precentage = 100;

    if(precentage <= 0)
        precentage = 0;


    precentage = Math.abs(100-Math.abs(precentage));

    if(precentage > 100)
        precentage = 100;

    if(precentage <= 0)
        precentage = 0;

    let volumeBar = document.getElementById("volume-bar");
    volumeBar.style.height = canvas.height;
    volumeBar.style.backgroundColor = greenToRedGradiant(precentage);
}

function handleAudioProcess(analyser) {
    let average = getAverageAudioY(analyser);
    recorderAverage = average;

    let canvas = document.querySelector("canvas");
    let ctx = canvas.getContext("2d");

    drawActiveVoiceWave(average);
    drawFollowingBar();
    changeBackgroundColorAccordingToVoiceFrequency(average)

    ctx.rect(xPos - (150/2), canvas.height/2 - (canvas.height/2), 500, canvas.height)

    let averageOfSong = (displayerPoints[(xPos/10)-1].y);
    let newAverage = -1 * ((average) - centerY * 1.8)+65;
    scoredSum += Math.abs(newAverage - averageOfSong);
    tickCount++;
    finalScore = scoredSum/tickCount;
    console.log(finalScore);
    document.getElementById('score').innerHTML = finalScore.toString()
}

function greenToRedGradiant(perc) {
    var r, g, b = 0;
    if(perc < 50) {
        r = 255;
        g = Math.round(5.1 * perc);
    }
    else {
        g = 255;
        r = Math.round(510 - 5.10 * perc);
    }
    var h = r * 0x10000 + g * 0x100 + b * 0x1;
    return '#' + ('000000' + h.toString(16)).slice(-6);
}

function successCallback(stream) {
    audioContext = new AudioContext();

    var audio = new Audio(audioUrl);
    var didPlayAudio = false;

    let analyser = audioContext.createAnalyser();
    let microphone = audioContext.createMediaStreamSource(stream);
    let javascriptNode = audioContext.createScriptProcessor(2048, 1, 1);

    analyser.smoothingTimeConstant = 0.1;
    analyser.fftSize = 1024;

    microphone.connect(analyser);
    analyser.connect(javascriptNode);
    javascriptNode.connect(audioContext.destination);

    javascriptNode.onaudioprocess = function () {
        handleAudioProcess(analyser);

        if(!didPlayAudio)
        {
            audio.play();
            didPlayAudio = true;
        }
    }
}

function handleVoiceRecordingAndDrawing() {
    if (navigator.getUserMedia) {
        navigator.getUserMedia({
                audio: true
            },
            function (stream) {
                document.getElementById(playButtonId).onclick = function () {
                    successCallback(stream);

                    document.getElementById(playButtonId).onclick = null;
                }
            },
            function (err) {
                console.log("The following error occured: " + err.name)
            });
    } else {
        console.log("getUserMedia not supported");
    }
}

// -     ----------------------------------------------------------------

canvas.onmousewheel = function (event){
    var mousex = event.clientX - canvas.offsetLeft;
    var mousey = event.clientY - canvas.offsetTop;
    var wheel = event.wheelDelta/120;//n or -n

    var zoom = 1 + wheel/2;

    context.translate(
        originx,
        originy
    );
    context.scale(zoom,zoom);
    context.translate(
        -( mousex / scale + originx - mousex / ( scale * zoom ) ),
        -( mousey / scale + originy - mousey / ( scale * zoom ) )
    );

    originx = ( mousex / scale + originx - mousex / ( scale * zoom ) );
    originy = ( mousey / scale + originy - mousey / ( scale * zoom ) );
    scale *= zoom;
}