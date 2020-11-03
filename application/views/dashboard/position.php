 <?php include 'top_nav.php'; ?>

<div class="row" style="margin: 0;">
  <div class="col-lg-2"  style="background-color: rgb(57, 115, 172);
   ">
    
     <?php include 'side_nav.php'; ?>

  </div>

  <div class="col-lg-10" id="cards">
       <a href="<?php echo base_url();?>index.php/dashboard/printPosition" class="btn btn-success mt-4">Print Pdf <span class="fa fa-print"></span></a>
      <div class="card mt-4" id="position" style="">
       
          <div class="card-header sticky-top" style="">

            <div>
            <!-- Using modifiers -->
            <b-button v-b-toggle.collapse-2 class="m-1">Add Position</b-button>

             <input class="form-control" id="myInput" type="text" placeholder="Search..">
          </div>
            <!-- Element to collapse -->
            <b-collapse id="collapse-2" style="position: absolute;">
              <div class="add-form">
               <label>Position</label>
               <input type="text" v-model="position.position"  class="form-control" name="" placeholder="Position...">
                <label>Total Winner</label>
                <input type="number" v-model="position.winner" class="form-control">
                <label>Poll</label>
                <select class="custom-select" v-model="position.poll_id">
                  <option v-for="polls in poll" v-bind:value="polls.id">{{polls.poll_name}}</option>
                </select>
             


                  <button type="button" class="add mt-2" @click="addPosition">Add</button>
             </div>
             
            </b-collapse>
          </div>
           
                <div v-if="modal" id="modalDelete" style=""> <button class="close pull-right mr-3 mt-2"  @click="modal = false; clear();">&times;</button>
                  <div class="modalHeader" style="">
                    <h5 class="p-1">Delete Position</h5>

                  </div>
                    <div class="modalBody"> 
                       <h6 style="color: red;">Are you sure you want to delete this position?</h6>
                       <button class="cancel" @click="modal = false">No</button>
                       <button class="yes" @click="del" ref="id">Yes</button>
                    </div>
                </div>

                 <div v-if="edit" id="modalDelete" style=""> <button class="close pull-right mr-3 mt-2" @click="edit = false; clear();">&times;</button>
                  <div class="modalHeader" style="">
                    <h5 class="p-1">Edit Position</h5>

                  </div>
                    <div class="modalBody"> 
                        
                         <label class="pull-left">Name</label>
                         <input type="text" v-model="position.position" class="form-control" name="" placeholder="Position...">
                       <label class="pull-left">Winner</label>
                       <input type="number" v-model="position.winner" class="form-control">
                         
                          <button type="button" class="edit mt-2" @click="editPosition">Edit</button>
                     
                    </div>
                </div>
          <div class="card-body">
           
            <div class="table-responsive" style="min-height: 220px;">
              <p class="pull-right alert alert-info p-2" v-if="message">{{message}}</p>
               <table class="table table-striped table-bordered" >
                    <thead >
                    
                        <th>ID</th>
                        <th>Position</th>
                        <th>Winner</th>
                        <th>Poll</th>
                        <th>Action</th>
                   
                    </thead>
                    <tbody id="myTable" >
                      <tr  v-for="pos in positions">
                        <td>{{ pos.id }}</td>
                        <td>{{ pos.position }}</td>
                        <td>{{ pos.winner }}</td>
                         <td>{{ pos.poll_name }}</td>
                      
                        <td>
                           <button @click="edit = true; position.position = pos.position; position.winner = pos.winner; position.id = pos.id;" class="btn-edit"><span class="fa fa-pencil"></span> Edit</button>
                           <button  @click="modal = true; position.id = pos.id;"  class="btn-delete" ><span class="fa fa-trash"></span> Delete</button>
                        </td>
                      </tr>
                    </tbody>
               </table>
            </div>
          </div>
                
      </div>
     
     
  </div>

</div>