<?php include 'top_nav.php'; ?>

<div class="row" style="margin-right: 0;">
  <div class="col-lg-2" class="bg-color">
    
     <?php include 'side_nav.php'; ?>

  </div>
  <div class="col-lg-10" >
    <div class="row mt-4"> 
      <div class="col-lg-4">
        <div class="card">
         
          <div class="card-body voters-card">
            <h4>Total Voters   <span class="fa fa-user pull-right card-logos" style="font-size: 180%;"></span></h4>
            <strong>100</strong>

          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card">
         
          <div class="card-body candidates-card">
             <h4>Total Candidates   <span class="fa fa-users pull-right card-logos" style="font-size: 180%;"></span></h4>
            <strong>100</strong>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card">
          
          <div class="card-body position-card">
             <h4>Positions  <span class="fa fa-male pull-right card-logos" style="font-size: 180%;"></span></h4>
            <strong>100</strong>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
     
      
       <div class="col-lg-12">

         <div id="poll" class="mt-4">
           <div v-if="modalDelete" id="modalDelete" style=""> <button class="close pull-right mr-3 mt-2" @click="modalDelete = false">&times;</button>
                  <div class="modalHeader" style="">
                    <h5 class="p-1">Delete Poll</h5>

                  </div>
                    <div class="modalBody"> 
                       <h6 style="color: red;">Are you sure you want to delete this poll?</h6>
                       <button class="cancel" @click="modalDelete = false">No</button>
                       <button class="yes" @click="deletePoll(); modalDelete = false;" >Yes</button>
                    </div>
            </div>

            <div v-if="modalEdit" id="modalDelete" style=""> <button class="close pull-right mr-3 mt-2" @click="modalEdit = false">&times;</button>
                <div class="modalHeader" style="">
                    <h5 class="p-1">Edit Poll</h5>

                </div>
                <div class="modalBody"> 
                        
                  <label class="pull-left">Poll Name</label>
                  <input type="text" v-model="printPoll.poll_name" class="form-control"  placeholder="Poll name...">
                 
                    <button type="button" class="edit mt-2" @click="editPoll(); modalEdit = false;">Edit</button>
                     
                  </div>
             </div>

             <div>
             <!-- Using modifiers -->
            <b-button v-b-toggle.collapse-2 class="m-1" style="width: 24%;">Create Poll</b-button>
          
           </div>
           <!-- Element to collapse -->
           <b-collapse id="collapse-2" style="position: absolute;z-index: 10">
                <div class="add-form">
                 <label>Poll Name</label>
                 <input type="text"  class="form-control" v-model="poll.poll_name" name="" placeholder="Poll name...">
                
                 <button type="button" class="add mt-2" @click="createPoll">Add Poll</button>
               </div>
               
           </b-collapse>

          <ul class="list-group ml-1 polls-list">
            <li class="list-group-item text-center"><b>POLLS</b> 
              <h6 v-if="messages" class="pull-right alert alert-info">{{messages}}</h6>
            </li>
            <li class="list-group-item" v-for="pol in poll_names">{{pol.poll_name}}

              <button  @click="printPoll.id = pol.id; modalDelete = true;"  class="poll_delete pull-right" ><span class="fa fa-trash"></span> Delete</button>
              <button @click="modalEdit = true;printPoll.poll_name = pol.poll_name; printPoll.id = pol.id;" class="poll_edit pull-right"><span class="fa fa-pencil"></span> Edit</button>
              <button v-if="pol.status == 'used'"  @click="polls_id.poll_id = pol.id; unusedPoll();" class="pull-right unused mr-2">Unused <span class="  fa fa-toggle-off"></span></button> 

              <button v-else class="pull-right used mr-2" @click="polls_id.poll_id = pol.id; usedPoll(); ">Used <span class="  fa fa-toggle-on"></span></button>
              <button class="pull-right print-result" @click="printPoll.id = pol.id; printPoll.poll_name = pol.poll_name; printResult();">Print Result<span class="fa fa-print ml-2"></span></button><br><br>
            

            </li>
          </ul>
      </div>
      </div>
    </div>
      


   
   
     
  </div>
 
</div>