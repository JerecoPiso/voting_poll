
<div id = "app">
  <div class="container">
    <div class="large-12 medium-12 small-12 cell">
      <label>File
        <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
      </label>
      <button v-on:click="submitFile()">Submit</button>
    </div>
  </div>
</div>

<script src="<?php echo base_url();?>assets/bootstrap_vuejs/js/vue.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap_vuejs/js/bootstrap_vue.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap_vuejs/js/axios.js"></script>
<script>
  new Vue ({
    el: "#app",
    /*data(){
      return {
        file: ''
      }*/
      data: {
        file: ''
      },
    

    methods: {
     
      submitFile(){
        /*
                Initialize the form data
            */
            let formData = new FormData();

            formData.append('file', this.file);
            axios.post( 'http://localhost/voting/index.php/login/upload',
                formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
              }
            ).then(function(response){
                   alert(response.data.message);
        })
        
      },

      /*
        Handles a change on the file upload
      */
      handleFileUpload(){
        this.file = this.$refs.file.files[0];
      }
    }
  });
</script>
