<?php 
  //for the top nav of the admin dashboard pages
  include 'top_nav.php'; ?>

<div class="row" style="margin-right: 0;">
  <div class="col-lg-2" class="bg-color">
    
     <?php include 'side_nav.php'; ?>

  </div>
  <div class="col-lg-10" id="cards">
      <a href="<?php echo base_url();?>index.php/dashboard/printVoters" class="btn btn-success mt-4">Print Pdf <span class="fa fa-print"></span></a>
  
      <div class="card mt-4" id="voters" style="">
          <div class="card-header sticky-top" style="">

            <div>
            <!-- Using modifiers -->
           <!-- Using modifiers -->
            <b-button v-b-toggle.collapse-2 class="m-1">List of Voters <span class="fa fa-list ml-2"></span></b-button>
             <input class="form-control" id="myInput" type="text" placeholder="Search..">
          </div>
          
          </div>
           
               
          <div class="card-body">
           
            <div class="table-responsive" style="min-height: 250px;">
        
               <table class="table table-striped table-bordered" >
                    <thead >
                    
                        <th>ID</th>
                        <th>Name</th>
                       
                   
                    </thead>
                    <tbody id="myTable" >
                            <tr  v-for="voter in voters">
                            <td>{{ voter.id }}</td>
                            <td>{{ voter.username }}</td>
                          
                           
                            
                        </tr>
                    </tbody>
               </table>
            </div>
          </div>
                
      </div>
     
     
  </div>

</div>