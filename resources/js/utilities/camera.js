import Webcam from "webcam-easy";

export default () => ({
  mywebcam: '',
  textPicture: '',

  startCamera(){
    const webcamElement = document.getElementById('webcam');
    const canvasElement = document.getElementById('canvas');
  
    this.mywebcam = new Webcam(webcamElement, 'user', canvasElement);
  
    this.mywebcam.start()
    .then(result =>{
      console.log("camera started");
    })
    .catch(err => {
      console.log("camera not ready");
    });
  },

  takePicture(){
    // const location = document.getElementById('location');
    // jalankan fungsi snap dari webcam easy untuk mendapatkan image 
    // hasil image sudah di encode base64
    let picture = this.mywebcam.snap();

    this.textPicture = picture;
    document.getElementById('webcam').hidden = true;
    document.getElementById('canvas').hidden = false;
    // this.mywebcam.stop();
  }

})