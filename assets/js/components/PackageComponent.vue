<template>
  <div class="container-fluid center">
    <!--    style="border:1px solid #000000;"-->
    <canvas id="wave" height="500px" width="1000px"></canvas>
    <br>
    <button class="play" id="play">Play</button>
    <br>
    <a @click="$router.go(-1)" class="back">Back</a>
    <br>
  </div>
</template>

<script>
//app.js
window.AudioContext = window.AudioContext || window.webkitAudioContext;
let audioContext = new AudioContext();

const audioUrl = '/files/vienas.mp3';

//recorder.js
const playButtonId = "play";

navigator.getUserMedia = navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia;

let canvas;
let canvasContext;
let centerX;
let centerY;
let xPos;
let yOld;

const recordingWaveColor = '#1438ba';
const backgroundWaveColor = '#ffffff';
const followingBarColor = 'green';

export default {
  name: "PackageComponent",
  methods: {
    //app.js
    drawAudio(url) {
      fetch(url)
          .then(response => response.arrayBuffer())
          .then(arrayBuffer => audioContext.decodeAudioData(arrayBuffer))
          .then(audioBuffer => this.drawSeq(this.normalizeData(this.filterData(audioBuffer))));
    },
    filterData(audioBuffer) {
      const rawData = audioBuffer.getChannelData(0);
      const samples = 70;
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
    },
    normalizeData(filteredData) {
      const multiplier = Math.pow(Math.max(...filteredData), -1);
      return filteredData.map(n => n * multiplier);
    },
    getPoints(normalizeData, canvasHeight) {
      let points = [];
      let xStep = 0;

      for (let i = 0; i < normalizeData.length; i++) {
        points.push(
            {
              y: -1 * (normalizeData[i] * canvasHeight) + canvasHeight * 1.8,
              x: xStep += 10
            }
        )
      }
      return points;
    },
    draw(ctx, points) {
      let f;
      let t;
      ctx.beginPath();
      ctx.moveTo(points[0].x, points[0].y);

      if (typeof (f) == 'undefined') f = 0.3;
      if (typeof (t) == 'undefined') t = 0.6;

      ctx.beginPath();
      ctx.moveTo(points[0].x, points[0].y);

      let m = 0;
      let dx1 = 0;
      let dy1 = 0;
      let dx2;
      let dy2;

      let preP = points[0];
      let nexP;

      for (let i = 1; i < points.length; i++) {
        let curP = points[i];
        nexP = points[i + 1];
        if (nexP) {
          m = this.gradient(preP, nexP);
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
      ctx.fillStyle = backgroundWaveColor;
      ctx.stroke();
    },
    drawSeq(normalizeData) {
      let canvas = document.querySelector("canvas");
      let ctx = canvas.getContext("2d");

      let canvasHeight = canvas.height / 2;

      ctx.moveTo(0, canvasHeight / 2);

      const points = this.getPoints(normalizeData, canvasHeight);

      this.draw(ctx, points);
    },
    gradient(a, b) {
      return (b.y - a.y) / (b.x - a.x);
    },

    //recorder.js

    normalize(val, max, min) {
      return (val - min) / (max - min);
    },

    drawFollowingBar() {

      let offsetFromWave = 20;

      canvasContext.beginPath();
      canvasContext.fillRect(0, (centerY * 1.8) + offsetFromWave, xPos, 20);
      canvasContext.fillStyle = followingBarColor;
      canvasContext.fill();
      canvasContext.lineWidth = 2;
      canvasContext.closePath();
    },
    getAverageAudioY(analyser) {
      let array = new Uint8Array(analyser.frequencyBinCount);
      analyser.getByteFrequencyData(array);
      let values = centerY;

      let length = array.length;
      for (let i = 0; i < length; i++) {
        values += (array[i]);
      }

      return -1 * ((values / length) - centerY * 1.8);
    },
    drawActiveVoiceWave(average) {
      canvasContext.beginPath();
      canvasContext.moveTo(xPos, yOld);
      canvasContext.lineTo(xPos += 6, average);
      yOld = average
      canvasContext.strokeStyle = recordingWaveColor;
      canvasContext.lineWidth = 2;

      canvasContext.stroke();
      canvasContext.closePath();
    },
    changeBackgroundColorAccordingToVoiceFrequency(average) {
      let percentage = (average - 240) / (440 - 240) * 100;
      canvas.style.backgroundColor = this.greenToRedGradiant(percentage);
    },
    handleAudioProcess(analyser) {
      let average = this.getAverageAudioY(analyser);

      this.drawActiveVoiceWave(average);
      this.drawFollowingBar();
      this.changeBackgroundColorAccordingToVoiceFrequency(average)
    },
    greenToRedGradiant(perc) {
      let r, g, b = 0;
      if (perc < 50) {
        r = 255;
        g = Math.round(5 * perc);
      } else {
        g = 255;
        r = Math.round(510 - 5 * perc);
      }
      let h = r * 0x10000 + g * 0x100 + b * 0x1;
      return '#' + ('000000' + h.toString(16)).slice(-6);
    },
    successCallback(stream) {
      let comp = this;
      audioContext = new AudioContext();
      let analyser = audioContext.createAnalyser();
      let microphone = audioContext.createMediaStreamSource(stream);
      let javascriptNode = audioContext.createScriptProcessor(2048, 1, 1);

      analyser.smoothingTimeConstant = 0.1;
      analyser.fftSize = 1024;

      microphone.connect(analyser);
      analyser.connect(javascriptNode);
      javascriptNode.connect(audioContext.destination);

      javascriptNode.onaudioprocess = function () {
        comp.handleAudioProcess(analyser);

      }
    },
    handleVoiceRecordingAndDrawing() {
      let temp = this;
      if (navigator.getUserMedia) {
        navigator.getUserMedia({
              audio: true
            },
            function (stream) {
              document.getElementById(playButtonId).onclick = function () {
                temp.successCallback(stream);
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
  },
  mounted() {
    window.addEventListener('DOMContentLoaded', (event) => {
      canvas = document.querySelector("canvas");
      canvasContext = canvas.getContext("2d");
      centerX = canvas.width / 2;
      centerY = canvas.height / 2;
      xPos = 0;
      yOld = centerY * 1.8;

      this.handleVoiceRecordingAndDrawing();
    });

    this.drawAudio(audioUrl);
    //this.
  },
  created() {
    this.$emit('flag')
  }
}
</script>

<style scoped>

.center {
  text-align-last: center;
}

.play {
  margin-top: 1.3em;
  margin-bottom: 1.3em;
  background-color: #0d3545;
  padding: 0.3em 3em;
  border: none;
  color: white;
}

.back {
  margin-top: 1em;
  background-color: #0B7FC7;
  padding: 0.3em 3em;
  border: none;
  color: white;
}
</style>