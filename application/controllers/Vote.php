<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote extends CI_Controller {

		function __construct(){
	 			parent::__construct();
				$this->load->helper('url');
				$this->load->library('session');
				$this->load->model('voting_model');
				$this->load->library('Pdf');
	 	}
	 	//function for the voting process
		public function votes(){

	 		$candidate_id = json_decode($_POST['id']);
	 		//check if the vote is empty
	 		if($candidate_id != ""){
	 			//getting the array data of the vote which is the id of the candidates
	 			foreach($candidate_id as  $value) {
	 				//calling the function for getting the info  of the candidates
	 				$ret = $this->voting_model->candidatesInfo($value);

	 				foreach ($ret as $values) {
	 				  //calling the function for the adding of votes
	 				  $return = $this->voting_model->vote($values->votes,$values->id);

	 				}

	 			}

	 			//getting the id of the user to be insert in the table for the voters who is done voting
				$voter = $this->session->userdata('voters');
				extract($voter);

		        $data['voters_id'] = $id;
		        $data['poll_id'] = $_POST['poll_id']; 
		        //calling the function for saving the voters info to the table for the users who done in voting 
			    $checker = $this->voting_model->doneVote($data);
			    if($checker === true){

			    	echo "Voted successfully.";

			    }else{

			    	echo "Something went wrong!";

			    }

	 		}else{

	 			echo "Error";
	 		}
	 		

	 	}



}