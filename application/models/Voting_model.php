<?php
 	
 	class Voting_model extends CI_Model{
 		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		//getting the information of the candidate
		public function candidatesInfo($c_id){
			$this->db->select('votes, id');
			$this->db->from('candidates');
			$this->db->where('id', $c_id);
			$this->db->limit(1);
			
			$result = $this->db->get();

			if($result->num_rows() == 0){

			    return "Candidate didn't found!";

			}else{

			   return $result->result();

			}			

		}
		//aading the the vote of the candidate
		public function vote($t_vote,$id){
			$data['votes'] = $t_vote + 1;
			$this->db->where('candidates.id', $id);
			return $this->db->update('candidates', $data);
		}
		//inserting the voters id to the table for the voters who done voting
		public function doneVote($id){
			
			if($this->db->insert('voted', $id)){
				return true;
			}else{
				return false;
			}
		}
		//checking if the user tries to login is already voted
		public function checkVoted($id, $poll_id){
	 		$this->db->where('voted.voters_id', $id);
	 		$this->db->where('voted.poll_id', $poll_id);
	 		$ret = $this->db->get('voted');

	 		if($ret->num_rows() >= 1){

	 			return true;

	 		}else{

	 			return false;
	 			
	 		}
	 	}
 		
 		
 	}