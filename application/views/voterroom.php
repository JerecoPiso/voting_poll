<div  class="text-center p-2" style="background-color: dodgerblue;color: white;font-size: 30px;letter-spacing: 3px;text-transform: uppercase;">
			<h4><b><?php echo $poll_name; ?></b></h4>
			<h4>( Voting Poll )</h4>

		</div>
		
		<div class="row mt-4" style="margin: 0;">
			
			<div class="col-lg-2">
				<!--side nav bar of the voting page-->
				<nav class="navbar">
				   <ul class="navbar-nav">
					<li class="nav-item"><a href="<?php echo base_url();?>index.php/" class="nav-link"><span class="fa fa-newspaper-o"></span> Platforms</a></li>
					 <li class="nav-item"><a href="<?php echo base_url();?>index.php/login/logout" class="nav-link"><span class="fa fa-sign-out mr-1"></span> Logout</a></li>
				   </ul>
		       </nav>
		       <!--notice on voting at the side of the voting page-->
		      <p><strong>Note:</strong>
		        <ol>
		          <li> Do not refresh the page or else your vote will be cleared.</li>
		          <li> You will be automatically logout to this page after voting.</li>
		        </ol> 
		      </p>
		   </div><!--end of the class col-lg-2-->
		   <div class="col-lg-6">
			 	<!-- the division for th voting part of the page-->
     			<div class="card">
     				<!-- voters name -->
					<div class="card-header text-center">
						 <b>Voter's Name: <?php echo $username; ?></b>
					</div>

				    <div class="card-body" style="overflow: auto;max-height: 600px;">

					<?php 
					//get the each position in the particular poll
					foreach ($position as $value) { ?>
					

					<ul class="list-group p-2">

						 <li class="list-group-item">
					     <h4><?= $value->position;?></h4>

					<?php 
					//get the candidates in a particular position in a poll
					$candidates = $this->login_model->getCandidates($value->id); ?>

					 <?php
					 	//check if the candidates is not equal to none
					   if($candidates != ""){
					   	//get the each candidate in the particular position
					    foreach ($candidates as $values) { ?>
					   	<!--check box-->
					    <div class="form-check">
							<label class="form-check-label">

							 <input type="checkbox" class="form-check-input" value="<?= $values->position?>" data-ids="<?=$values->id?>" data-limit="<?= $values->winner?>">
							  <?= $values->name?>
							</label>
						 </div>
					
						 
					 <?php  }//foreach end of candidates

					 	 }//if end en checking if candidates are none
					    
					  ?>
    					  </li>					
					</ul>

				<?php }// foreach end for the positions 


				?>	
				<!--button for the sending of votes-->
				<button type="button" class="btn btn-primary" id="vote" value="<?php echo $poll_id;?>">Vote</button>
				</div>

			</div><!--div class card end-->	
	   </div><!-- div col-lg-6 class end-->

		<div class="col-lg-4">
			<!--error for the voting  (limiting the vote and checking if vote is none)-->
			<h6><strong>Notice's in voting: <span class="ml-2 fa fa-level-down"></span></strong></h6>
			<!--the error will be display here-->
			<div class="alert alert-danger sticky-top vote-error text-center p-2">
				
			</div>

			<h4 class="text-center"><b>Total votes of candidates</b></h4>
				<div style="overflow: auto;max-height: 550px;">		

					<?php foreach ($position as $value) { ?>
							
					<ul class="list-group mt-2" >

					    <h6><b><?= $value->position;?></b></h6>

					<?php $candidates = $this->login_model->getCandidates($value->id); 

					?>

					 <?php
					   if($candidates != ""){

					    foreach ($candidates as $values) { ?>

						 <li class="list-group-item"><?= $values->name?>  <b class="pull-right"><?= $values->votes?> vote/s</b> </li>
							  						
					 <?php  }//foreach end of candidates

					  }//if end en checking if candidates are none

					 ?>
    					  							
					</ul>
				
				<?php }// foreach end for the positions ?>
				</div>
	      </div><!--col-lg-4 class end-->
      </div><!-- div class row end-->
	<?php	
		//load the footer
		$this->load->view('templates/footer.php');