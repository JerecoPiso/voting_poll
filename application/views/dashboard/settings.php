<?php 

  $data['username'] = $username;
  $data['password'] = $password;
  $ret = $this->dashboard_model->loginAdmin($data);
              
  //for the top nav of the admin dashboard pages
  include 'top_nav.php'; ?>

<div class="row" id="admin_setting" style="margin-right: 0;">

    <div class="col-lg-2" class="bg-color">
      
       <?php include 'side_nav.php'; ?>

    </div>
   
    <div class="col-lg-3 m-4">
       <div v-if="modal" id="modalDelete" style=""> <button class="close pull-right mr-3 mt-2" @click="modal = false">&times;</button>
                  <div class="modalHeader" style="">
                    <h5 class="p-1">Change Profile</h5>

                  </div>
                    <div class="modalBody"> 
                       <input type="file" id="file"  ref="file" v-on:change="handleFileUpload()" class="form-control-file">
                       <button class="mt-2" style="width: 100%;" @click="id = '<?php echo $ret['id'];?>';submitFile()" >Change</button>
                    </div>
                </div>
                


          <img class="mt-2 profile" style="" v-bind:src="'<?php echo base_url();?>assets/images/' + securityInfo.photo" ><br>
          <button class="change-profile" @click="modal = true;">Change Profile</button>
          <h6 class="mt-3 text-center"><b><?php echo $ret['username'];?></b></h6>
           

           <h5 class="mt-4" style="border-top: 1px solid black;"><b>Security</b></h5>
          <label class="mt-2"><b>New Password</b></label><br>
          <input type="password" class="input" v-model="securityInfo.pass" value="" v-bind:disabled="securityDisable" placeholder="New Password ..."><br>

          <label class="mt-2"><b>Re-Type New Password</b></label><br>
          <input type="password" v-model="securityInfo.pass2"  class="input" value="" v-bind:disabled="securityDisable" placeholder="Re-type Password ..."><br>

          <label  class="mt-2"><b>Hint</b></label>
          <input type="text" class="input" v-model="securityInfo.hint" name="" value="securityInfo.hint" v-bind:disabled="securityDisable" >

          <button v-if="securityDisable" class="btn btn-success pull-right mt-2" @click="securityDisable = false; securityInfo.hint = '<?php echo $ret['hint'];?>'">Edit Security </button>
          <button v-if="!securityDisable" @click="securityInfo.id = '<?php echo $ret['id'];?>';editSecurity()" class="btn btn-primary pull-right mt-2">Save</button>

   </div>

    <div class="col-lg-4 m-4">
          <h5 class="mt-4" style="border-bottom: 1px solid black"><b>Personal Information</b></h5></br>
          <label  class="mt-2"><b>Name</b></label>
          <input type="text" class="input" v-model="personalInfo.uname" v-bind:disabled="inputDisable">

          <label  class="mt-2"><b>Birthdate</b></label>
          <input type="text" class="input"  v-model="personalInfo.birthdate"  v-bind:disabled="inputDisable">

          <label  class="mt-2"><b>Contact No.</b></label>
          <input type="number" class="input"  v-model="personalInfo.contact"  v-bind:disabled="inputDisable">

          <button v-if="inputDisable" class="btn btn-success pull-right mt-2" @click="inputDisable = false; ">Edit Information</button>
          
          <button v-if="!inputDisable" class="btn btn-primary pull-right mt-2" @click="personalInfo.id = <?php echo $ret['id'];?>;editPersonalInfo();">Save New Information</button>

   </div>

    <div class="col-lg-3">
          
   </div>
</div>
