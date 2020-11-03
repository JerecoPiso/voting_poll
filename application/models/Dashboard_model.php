<?php
 	
 	class Dashboard_model extends CI_Model{
 		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		public function insertfile($file, $id){
			$array = array('photo' => $file);
			$this->db->where('admin.id', $id);
			return $this->db->update('admin', $array);
		}
 		//function for the login of the admin
 		public function loginAdmin($data){
 			$query = $this->db->get_where('admin', array('username'=>$data['username']));
 			if($query->num_rows() >= 1){
 				 return	$query->row_array();

 			}else{

 				return false;
 			}
 		

 			
 		}
 		//getadmin info
 		public function getAdminInfo($id){
 			$this->db->where('admin.id', $id);
 			$ret = $this->db->get('admin');
 			
 			//return $ret->row_array();
 			if($ret->num_rows() < 1){

 				return false;

 			}else{

 				return $ret->row_array();
 			}
 		}
 		public function adminAdd($data){
 			$array = array(
 				'username' => $data['name'],
 				'password' => $data['pass']
 			);

 			$this->db->where('admin.username', $data['name']);
 			$ret = $this->db->get('admin');

 			if($ret->num_rows() >= 1){

 					return  $data['name']. " is already taken";
 			}else{

 				if($this->db->insert('admin', $array)){

 				return true;

 			}else{

 				return false;
 			}

 			}

 			

 		}
 		//edit info of the admin user
 		public function infoEdit($data,$id){
 			$array = array(
 				'username' => $data['name'],
 				'bdate' => $data['bdate'],
 				'contact_no' => $data['contact']
 			);
 			$this->db->where('admin.id !=', $id);
 			$this->db->where('admin.username', $data['name']);

 			$return = $this->db->get('admin');

 			if($return->num_rows() >= 1){

 				return $data['name']. " is already taken!";

 			}else{
 				
 				$this->db->where('admin.id', $id);
 			
	 			if($this->db->update('admin', $array)){

	 				return "Updated";

	 			}else{

	 				return "Error";

	 			}


 			}




 		}
 		//edit password na hint of admin
 		public function securityEdit($data,$id){
 			$array = array(
 				'password' => $data['pass'],
 				'hint' => $data['hint'],
 			);

 			$this->db->where('admin.id', $id);
 			if($this->db->update('admin', $array)){

 				return true;

 			}else{

 				return false;

 			}

 		}
 		//getting all position from database
		public function candidates(){
			$this->db->select('candidates.id, candidates.name, candidates.votes, position.position, poll.poll_name, poll.id  AS poll_id');
			$this->db->from('candidates');
			$this->db->join('position', 'candidates.position_id = position.id');
			$this->db->join('poll', 'candidates.poll_id = poll.id');
			$this->db->order_by('candidates.id ASC');
			$query = $this->db->get();
			return $query->result(); 
		}
		//get all the position in the database
		public function position(){
			$this->db->select('position.id, position.position, position.winner, poll.poll_name, poll.id as poll_id');
			$this->db->from('position');
			$this->db->join('poll', 'position.poll_id = poll.id');
			$this->db->order_by('poll.poll_name');
			$query = $this->db->get();
			return $query->result();

		}

		public function positionToBePrint($poll_id){
			$this->db->where('poll_id', $poll_id);
			$query = $this->db->get('position');

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return false;
			}
			 

		}

		public function candidatesToBePrint($position_id){
			$this->db->select("candidates.name, candidates.votes, ");
			$this->db->from('candidates');
			$this->db->join('position', 'candidates.position_id=position.id');
			$this->db->order_by('candidates.id', 'asc');
			$this->db->where('candidates.position_id', $position_id);
			$sql = $this->db->get();
			
			if($sql->num_rows() > 0){

				return $sql->result();

			}else{

				return false;

			}
		    
		   
		}
		//get all the position in the database
		public function voter(){
			
			$query = $this->db->get('voters');
			return $query->result();

		}
		//add new candidate in a position in a poll
		function newCandidate($data){
			//check if the position of the candidate exist in a particular poll
			$this->db->where('position.id',$data['position_id']);
			$this->db->where('position.poll_id', $data['poll_id']);
			$query = $this->db->get('position');
			if($query->num_rows() >= 1){
				
		
				 if($this->db->insert('candidates', $data)){
				 	return "Added succesfully";

				 }else{

				 	return "Something went wrong!";
				 }
			}else{
				return "No position in that poll/Poll and position didn't matched!";
			}
		}
		//add new  position in a particular poll
		function newPosition($data){
			$this->db->where('position', $data['position']);
			$this->db->where('poll_id', $data['poll_id']);
			$query = $this->db->get('position');

			if($query->num_rows() > 0){

				return $data['position'] . " position already exist in this poll";

			}else{

				if($this->db->insert('position', $data)){

					return "Added succesfully";

				}else{

					return "Error";
				}
			}
			
		}
		//delete candidate
		function del($data){
			 $this->db->where('candidates.id', $data);
			 if($this->db->delete('candidates')){
			 	return "Deleted succesfully";
			 }else{
			 	return "Error";
			 }
			
		}
		//delete Position
		function delet($data){

			 $this->db->where('position.id', $data);

			if($this->db->delete('position')){

			 	return "Deleted succesfully";

			 }else{

			 	return "Error";
			 }
		}
		//delete Poll
		public function pollDelete($poll_id){
			$this->db->where('poll.id', $poll_id);
			if($this->db->delete('poll')){

				return "Deleted succesfully";

			}else{

				return "Eror in deleting the poll!";
			}
		}
		//edit candidate
		function editCandidate($data, $id){
			//check if the new position of the candidate exist in a particular poll
			$this->db->where('position.id',$data['position_id']);
			$this->db->where('position.poll_id', $data['poll_id']);
			$query = $this->db->get('position');
			if($query->num_rows() >= 1){
				 $this->db->where('candidates.id', $id);
		
				 if($this->db->update('candidates', $data)){
				 	return "Updated succesfully";

				 }else{

				 	return "Something went wrong!";
				 }

			}else{

				return "No position in that poll";

			}

		}
		//edit position
		function positionEdit($data,$id){
			$this->db->where('position.id', $id);
			if($this->db->update('position', $data)){
			 	return "Updated succesfully";

			 }else{
			 	return "Something went wrong!";
			 }

		}
		//edit Poll
		public function pollEdit($data){
			$this->db->where('poll.id', $data['id']);
			if($this->db->update('poll', $data)){

				return "Updated succesfully";

			}else{

				return "Something went wrong!";
			}
		}
		//create a new poll
		function createPoll($data){
			//check if the poll already exist
			$this->db->where('poll_name', $data['poll_name']);
			$query = $this->db->get('poll');
			if($query->num_rows() > 0){

				return $data['poll_name'] . " already exist!";

			}else{

				//create the poll if it is not existed
				if($this->db->insert('poll', $data)){

					return "Poll added succesfully";

				}else{

					return "error";

				}

			}
			
		}
		//get all the polls in the database
		public function poll(){

			$query = $this->db->get('poll');
			return $query->result();

		}

		//change the used poll
		public function usePoll($data){
			//check if there is already in used poll if there is update it to unused because this system can only used only one poll in voting
			$this->db->where('status', 'used');
			$query = $this->db->get('poll');
			if($query->num_rows() > 0){

				$poll_data = array('status' => 'unused');
				//check if the updating of the used poll has been doned succesfully if true change the used poll according to the selection of the admin
				if($this->db->update('poll', $poll_data)){

					$poll_data = array('status' => 'used');
					$this->db->where('poll.id', $data['poll_id']);
					$this->db->update('poll', $poll_data);
				}

			}else{

					$poll_data = array('status' => 'used');
					$this->db->where('poll.id', $data['poll_id']);
					$this->db->update('poll', $poll_data);

			}

		}
		//unUsed poll
		public function unUsedPoll($data){
			$poll_data = array('status' => 'unused');
			$this->db->where('poll.id', $data['id']);
			$this->db->update('poll', $poll_data);
		}
		
 	}