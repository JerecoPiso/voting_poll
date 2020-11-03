<?php 
  //for the top nav of the admin dashboard pages
  include 'top_nav.php'; ?>

<div class="row" style="margin-right: 0;">
  <div class="col-lg-2" class="bg-color">
    
     <?php include 'side_nav.php'; ?>

  </div>
  <div class="col-lg-10" id="cards">
    <a href="<?php echo base_url();?>index.php/dashboard/printCandidates" class="btn btn-success mt-4">Print Pdf <span class="fa fa-print"></span></a>
  
      <div class="card mt-4" id="candidates" style="">
          <div class="card-header sticky-top" style="">

            <div>
            <!-- Using modifiers -->
            <b-button v-b-toggle.collapse-2 class="m-1">Add Candidate</b-button>
             <input class="form-control" id="myInput" type="text" placeholder="Search..">
          </div>
            <!-- Element to collapse -->
            <b-collapse id="collapse-2" style="position: absolute;">
              <div class="add-form">
               <label>Name</label>
               <input type="text" v-model="candidates.name" class="form-control" name="" placeholder="Candidates name...">
                <label>Position</label>
              
                <select class="custom-select"  v-model="position_poll">

                  <option  v-for="position in positions" v-bind:value="position.id + ' ' + position.poll_id" >{{position.position + ' ( ' + position.poll_name + ' )'}}</option>
                </select>
               
                <button type="button" class="add mt-2" @click="addCandidate">Add</button>
             </div>
             
            </b-collapse>
          </div>
           
                <div v-if="modal" id="modalDelete" style=""> <button class="close pull-right mr-3 mt-2" @click="modal = false; clear();">&times;</button>
                  <div class="modalHeader" style="">
                    <h5 class="p-1">Delete Candidate</h5>

                  </div>
                    <div class="modalBody"> 
                       <h6 style="color: red;">Are you sure you want to delete this candidate?</h6>
                       <button class="cancel" @click="modal = false">No</button>
                       <button class="yes" @click="del" ref="id">Yes</button>
                    </div>
                </div>

                <div v-if="modal_edit" id="modalDelete" style=""> <button class="close pull-right mr-3 mt-2" @click="modal_edit = false; clear();">&times;</button>
                <div class="modalHeader" style="">
                    <h5 class="p-1">Edit Candidate</h5>

                </div>
                <div class="modalBody"> 
                        
                  <label class="pull-left">Name</label>
                  <input type="text" v-model="candidates.name" class="form-control" name="" placeholder="Candidates name...">
                  <label class="pull-left">Position</label>
                  <select class="custom-select" v-model="candidates.position">
                      <option  v-for="position in positions" v-bind:value="position.id" >{{position.position}}</option>
                  </select>
                  <label class="pull-left">Poll Name</label>
                    <select class="custom-select" v-model="candidates.poll_id">
                       <option  v-for="polls in poll" v-bind:value="polls.id" >{{polls.poll_name}}</option>
                    </select>
                    <button type="button" class="edit mt-2" @click="editCandidate">Edit</button>
                     
                  </div>
             </div>
          <div class="card-body">
           
          <div class="table-responsive" style="min-height: 250px;">
            <p class="pull-right alert alert-info p-2" v-if="message">{{message}}</p>
            <table class="table table-striped table-bordered" >
              <thead >
                    
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                <th>Votes</th>
                <th>Poll Name</th>
                <th>Action</th>
                   
              </thead>
              <tbody id="myTable" >
                <tr  v-for="candidat in candidate">
                  <td>{{ candidat.id }}</td>
                  <td>{{ candidat.name }}</td>
                  <td>{{ candidat.position }}</td>
                  <td>{{ candidat.votes }}</td>
                  <td>{{ candidat.poll_name }}</td>
                  <td>
                    <button @click="modal_edit = true; candidates.name = candidat.name; candidates.position = candidat.position; candidates.id = candidat.id; candidates.poll_id = candidat.poll_id;" class="btn-edit"><span class="fa fa-pencil"></span> Edit</button>
                    <button  @click="modal = true; ids.id = candidat.id"  class="btn-delete" ><span class="fa fa-trash"></span> Delete</button>
                  </td>
                 </tr>
              </tbody>
               </table>
            </div>
          </div><!-- class card body end-->
                
      </div>
         
   </div>

</div>