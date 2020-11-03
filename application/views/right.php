<div class="col-lg-4">
		<h6><strong>Notice's in voting: <span class="ml-2 fa fa-level-down"></span></strong></h6>
		<div class="alert alert-danger sticky-top vote-error text-center p-2">
			
		</div>

		<h4 class="text-center"><b>Total votes of candidates</b></h4>


					<?php foreach ($ret as $value) { ?>
										
					<ul class="lnist-group mt-3">
					    <h6><b><?= $value->position;?></b></h6>

					<?php $candidates = $this->login_model->getCandidates($value->id); ?>

					 <?php
					   if($candidates != ""){

					    foreach ($candidates as $values) { ?>

						 <li class="list-group-item"><?= $values->name?> ( <?= $values->votes?> )</li>
							  
							
						
					 <?php  }//foreach end of candidates

					  }//if end en checking if candidates are none

					  ?>
    					  							
					</ul>

				<?php }// foreach end for the positions ?>

	 </div>