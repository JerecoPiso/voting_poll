<?php
 	
 	class Login_model extends CI_Model{
 		function __construct(){
			parent::__construct();
			$this->load->database();
		}
 		//function for adding the voter
 		public function addVoter($data){
 			$this->db->where('username',$data['username']);
			$query = $this->db->get('voters');

			    if ($query->num_rows() > 0){

			        return false;
			    }else{

			        $this->db->insert('voters', $data);

			       	return $this->db->insert_id();

			    }	
 		}
 		//login of the voter
 		public function votersLogin($data){

 			$query = $this->db->get_where('voters', array('id'=>$data));
 			return $query->row_array();

 		}

 		public function usedPoll(){

 			$this->db->where('status', 'used');
 			$this->db->limit(1);
 			$query = $this->db->get('poll');
 			if($query->num_rows() == 0){

 				return false;

 			}else{
 				return $query->result(); 
 			}
 		}

 		//getting all position from database
		public function getPositions($poll_id){
			$this->db->where('poll_id', $poll_id);
			$query = $this->db->get('position');
			return $query->result(); 
		}
		//getting all post from database
		public function getCandidates($id){
			$this->db->select("candidates.id, candidates.name, candidates.votes, position.position, position.winner");
			$this->db->from('candidates');
			$this->db->join('position', 'candidates.position_id=position.id');
			$this->db->order_by('candidates.id', 'asc');
			$this->db->where('candidates.position_id', $id);
			$sql = $this->db->get();
			if($sql->num_rows() != 0){
		        return $sql->result();
		    }else{
		        return false;
		    }
		}
 	}