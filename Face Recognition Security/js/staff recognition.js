const verifybutton = document.getElementById('verify')
const imageview = document.getElementById('imgPreview')
const passedimage=localStorage.getItem("photo")
var membername="";
const trimmedname=[];


Promise.all([
  faceapi.nets.faceRecognitionNet.loadFromUri('/Face Recognition Security/recog models'),
  faceapi.nets.faceLandmark68Net.loadFromUri('/Face Recognition Security/recog models'),
  faceapi.nets.ssdMobilenetv1.loadFromUri('/Face Recognition Security/recog models')
]).then(start)

async function start() {
  const container = document.createElement('div')
  container.style.position = 'relative'
  document.body.append(container)
  const labeledFaceDescriptors = await loadLabeledImages()
  const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6)
  let image
  let canvas
  document.getElementById("verify").disabled = false;
  document.getElementById("loadingdiv").style.display = "none";


var url = localStorage.getItem("photo");

/*fetch(url)
.then(res => res.blob())
.then(blob => console.log(blob))
*/

  verifybutton.addEventListener('click', async () => {
    if (image) image.remove()
    if (canvas) canvas.remove()

const imagepic= localStorage.getItem("photo");
document.querySelector("#imgPreview").setAttribute("src",imagepic)

    image = await faceapi.fetchImage(url);
    /*container.append(image)*/ //Stopping it from creating an image
    canvas = faceapi.createCanvasFromMedia(image)
    /*container.append(canvas)*/ //Stopping it from creating an image
    const displaySize = { width: image.width, height: image.height }
    faceapi.matchDimensions(canvas, displaySize)
    const detections = await faceapi.detectAllFaces(image).withFaceLandmarks().withFaceDescriptors()
    const resizedDetections = faceapi.resizeResults(detections, displaySize)

    const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))
    const results2 = detections.map(fd => faceMatcher.findBestMatch(fd.descriptor))
    var membername = localStorage.getItem("membername");
results2.forEach((bestMatch, i) => {
  const text = bestMatch.toString()

  const name= text.trim();
  const trimmedname=name.slice(0, -6)


  })
results2.forEach((bestMatch, i) => {
  const text = bestMatch.toString()

  const nametrim= text.trim();
  const nameslice=nametrim.slice(0, -6);
  console.log("namesliced"+nameslice)
  trimmedname.push(nameslice);
/*localStorage.setItem("verifiedname",nameslice)*/


  })
membername=localStorage.getItem("membername");
console.log("trimmedname"+trimmedname[0].trim());
console.log("membername"+membername.trim());
/*const trimmedname= localStorage.getItem("verifiedname");*/
if (trimmedname[0].trim()===membername){
  console.log("You have Been verified successfully")
  window.location.href = "staff dashboard.html"
}else{
  console.log("Sorry we could not verify you")
}



/*    results.forEach((result, i) => {
      const box = resizedDetections[i].detection.box
      const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
      drawBox.draw(canvas)
    })*/
  })
}

function loadLabeledImages() {
  const labels = [document.getElementById("helper").getAttribute("data-name")]
  return Promise.all(
    labels.map(async label => {
      const descriptions = []
      for (let i = 1; i <= 2; i++) {
        const img = await faceapi.fetchImage(`face images/${label}/${i}.jpg`)
        const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
        descriptions.push(detections.descriptor)
      }

      return new faceapi.LabeledFaceDescriptors(label, descriptions)

    })
  )
}

function verifyperson(membername,trimmedname){
  if (membername.trim() === trimmedname[0]) {
  console.log("Verified successfully")
  /*console.log(membername.trim()+trimmedname)*/
} else if (trimmedname[0]=== "") {
  console.log("Sorry you could not be Verified")
  console.log(membername.trim()+trimmedname[0])
} else{
  greeting = "Good evening";
}
}


