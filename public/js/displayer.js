window.AudioContext = window.AudioContext || window.webkitAudioContext;
let audioContext = new AudioContext();
let vibrationPattern = [];
let displayerPoints = [];
let duration = 0;

const drawAudio = url => {
    fetch(url)
        .then(response => response.arrayBuffer())
        .then(arrayBuffer => audioContext.decodeAudioData(arrayBuffer))
        .then(audioBuffer => {duration = audioBuffer.duration; return audioBuffer})
        .then(audioBuffer => handleWave(normalizeData(filterData(audioBuffer))));
};

const filterData = audioBuffer => {
    const rawData = audioBuffer.getChannelData(0);
    const samples = Math.floor(canvas.width / 2);

    const blockSize = Math.floor(rawData.length / samples);
    const filteredData = [];
    for (let i = 0; i < samples; i++) {
        let blockStart = blockSize * i;
        let sum = 0;
        for (let j = 0; j < blockSize; j++) {
            sum = sum + Math.abs(rawData[blockStart + j]);
        }
        filteredData.push(sum / blockSize);
    }
    return filteredData;
};

const normalizeData = filteredData => {
    const multiplier = Math.pow(Math.max(...filteredData), -1);
    return filteredData.map(n => n * multiplier);
}

const getPoints = (normalizeData, canvasY) => {
    let points = [];
    let xStep = 0;

    for (let i = 0; i < normalizeData.length; i++) {
        points.push(
            {
                y: -1*(normalizeData[i] * canvasY) + canvasY*1.8,
                x: xStep += 10
            }
        )
    }
    return points;
}

function draw(ctx, points) {

    ctx.beginPath();
    ctx.moveTo(points[0].x, points[0].y);

    if (typeof (f) == 'undefined') f = 0.3;
    if (typeof (t) == 'undefined') t = 0.6;

    ctx.beginPath();
    ctx.moveTo(points[0].x, points[0].y);

    var m = 0;
    var dx1 = 0;
    var dy1 = 0;

    var preP = points[0];

    for (var i = 1; i < points.length; i++) {
        var curP = points[i];
        nexP = points[i + 1];
        if (nexP) {
            m = gradient(preP, nexP);
            dx2 = (nexP.x - curP.x) * -f;
            dy2 = dx2 * m * t;
        } else {
            dx2 = 0;
            dy2 = 0;
        }

        ctx.bezierCurveTo(
            preP.x - dx1, preP.y - dy1,
            curP.x + dx2, curP.y + dy2,
            curP.x, curP.y
        );

        dx1 = dx2;
        dy1 = dy2;
        preP = curP;
    }
    ctx.stroke();



}

function drawSeq(normalizeData) {
    let canvas = document.querySelector("canvas");
    let ctx = canvas.getContext("2d");
    let centerX = canvas.width / 2;
    let centerY = canvas.height / 2;

    ctx.moveTo(0, centerY);

    const points = getPoints(normalizeData, centerY);
    displayerPoints = points;
    draw(ctx, points);
}

function setupVibration(normalizeData) {
    let count = normalizeData.reduce((a, b) => a + b, 0)


    let durationx = duration*1000

    let buckets = durationx / 50;

    let thingsPerBatch = Math.floor(normalizeData.length / buckets)

    let result = [];
    let lastI = 0;
    for (let i = 0; i < normalizeData.length; i+=thingsPerBatch) {
        result.push(normalizeData.slice(lastI, i).reduce((a, b) => a + b, 0));
        lastI = i;
    }

    for (let i = 0; i < result.length; i++) {
        result[i] = result[i]*200;
    }

    vibrationPattern = result.reduce((r, a) => r.concat(Math.round(a), 50), []);
    let vibrationPatternDurationMs = vibrationPattern.reduce((a, b) => a + b, 0)

    // vibrationPattern = [500,100,100,405,540,10,400,10];
    debugger
}

const handleWave = normalizeData => {
    drawSeq(normalizeData);
    setupVibration(normalizeData);
}


function gradient(a, b) {
    return (b.y-a.y)/(b.x-a.x);
}

audioUrl = document.currentScript.getAttribute("data-file-path");

console.log(audioUrl)

drawAudio(audioUrl);
