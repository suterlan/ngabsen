export default () => ({
  url: '',
  preview: '',
  size: '',

  showPreview(event) {
    let file = event.target.files[0];
    // console.log(file);
    if(event.target.files.length > 0 ){
      this.url = URL.createObjectURL(file);
      // console.log(this.url);
      this.preview = ['jpg', 'jpeg', 'png', 'gif'].includes(file.name.split('.').pop().toLowerCase());
      // console.log(this.preview);
      this.size = file.size > 1024 ? file.size > 1048576 ? Math.round(file.size / 1048576) + ' MB' : Math.round(file.size / 1024) + ' KB' : file.size + ' B';
      // console.log(this.size);
    }
  },
})