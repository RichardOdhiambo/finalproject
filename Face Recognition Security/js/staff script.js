const video = document.getElementById('video')
let i=0;
Promise.all([
  faceapi.nets.tinyFaceDetector.loadFromUri('/Face Recognition Security/models'),
  faceapi.nets.faceLandmark68Net.loadFromUri('/Face Recognition Security/models'),
  faceapi.nets.faceRecognitionNet.loadFromUri('/Face Recognition Security/models'),
  faceapi.nets.faceExpressionNet.loadFromUri('/Face Recognition Security/models')
]).then(startVideo)

function startVideo() {
  navigator.getUserMedia(
    { video: {} },
    stream => video.srcObject = stream,
    err => console.error(err)
  )
}

video.addEventListener('play', () => {
  const canvas = faceapi.createCanvasFromMedia(video)
  document.body.append(canvas)
  const displaySize = { width: video.width, height: video.height }
  faceapi.matchDimensions(canvas, displaySize)
  setInterval(async () => {
    const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceExpressions()
    const resizedDetections = faceapi.resizeResults(detections, displaySize)
/*    canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height)
    faceapi.draw.drawDetections(canvas, resizedDetections)
    faceapi.draw.drawFaceLandmarks(canvas, resizedDetections)
    faceapi.draw.drawFaceExpressions(canvas, resizedDetections)*/

if (resizedDetections.length > 0 && resizedDetections[0].detection.score > 0.2 /*&& resizedDetections[0].expressions.happy > 0.5*/) {
for (i ; i < 1; i++) {
  const canvas = document.createElement('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    canvas.getContext('2d').drawImage(video, 0, 0);

    const img = document.createElement("img");
    img.src = canvas.toDataURL('image/jpg');
    localStorage.setItem("photo",img.src)
    localStorage.setItem("myValue", "a");
    /*document.getElementById('demo').appendChild(img);*/
const mediaStream = video.srcObject;
const tracks = mediaStream.getTracks();
tracks.forEach(track => track.stop());
window.open("staff recognition.php", "_blank");
/*window.close();*/



//this are the codes for stopping the stream... they make it hang


/*window.location="index.html"*/
}


            }

  }, 100)
})