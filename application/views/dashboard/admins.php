<?php 
  //for the top nav of the admin dashboard pages
  include 'top_nav.php'; ?>

<div class="row" style="margin-right: 0;">
  <div class="col-lg-2" class="bg-color">
    
     <?php include 'side_nav.php'; ?>

  </div>
  <div class="col-lg-10" id="cards">
   
  
      <div class="card mt-4" id="admin" style="">
          <div class="card-header sticky-top" style="">

           
            <div>
            <!-- Using modifiers -->
            <b-button v-b-toggle.collapse-2 class="m-1 btn btn-success"><span class="fa fa-plus mr-4"></span><span class="fa fa-user-secret"></span></b-button>
             <input class="form-control" id="myInput" type="text" placeholder="Search..">
          </div>
            <!-- Element to collapse -->
            <b-collapse id="collapse-2" style="position: absolute;">
              <div class="add-form">
                <label>Username</label>
                <input type="text" class="form-control" v-model="adminInfo.name" name="">
                <label>Password</label>
                <input type="password" v-model="adminInfo.pass"  class="form-control" name="">
                 <label>Re-Type Password</label>
                <input type="password" v-model="adminInfo.pass2"  class="form-control" name="">
                  <button type="button" class="add mt-2" @click="addAdmin()">Add Admin</button>
             </div>
             
            </b-collapse>

               

           
          </div>         
        <div class="card-body">
           
          <div class="table-responsive" style="min-height: 500px;">
         
              <div style="width: 80%;margin-left: 10%;">
            <b-card-group columns>
               <b-card style=""  img-src="<?php echo base_url();?>assets/images/images.jpeg" img-alt="Image" img-top>
                <h6>TGP</h6>
                <b-card-text>
                    jfgjhgfjsdf
                </b-card-text>
                <b-card-text class="small text-muted">bio</b-card-text>
              </b-card>

              <b-card  img-src="<?php echo base_url();?>assets/images/images.jpeg" img-alt="Image" img-top>
                <b-card-text>
                  This card has supporting text below as a natural lead-in to additional content.
                </b-card-text>
                <b-card-text class="small text-muted">bio</b-card-text>
              </b-card>

              <b-card  img-src="<?php echo base_url();?>assets/images/images.jpeg" img-alt="Image" img-top>
                <b-card-text>
                  This card has supporting text below as a natural lead-in to additional content.
                </b-card-text>
                <b-card-text class="small text-muted">bio</b-card-text>
              </b-card>
               
              

            
            </b-card-group>
      </div>
            </div>
          </div><!-- class card body end-->
                
      </div>
         
   </div>

</div>