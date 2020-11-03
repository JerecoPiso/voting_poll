<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

		function __construct(){
	 			parent::__construct();
				$this->load->helper('url');
				$this->load->library('unit_test');
				$this->load->library('session');
				$this->load->model('files_model');		
				$this->load->model('login_model');

				$this->load->model('voting_model');
				$this->load->library('Pdf');
				//$this->load->view('view_file');	
	 	}
	 	public function fileupload(){
	 		$this->load->view('fileupload');
	 	}

	 	public function upload(){

   
	 		$output = array('error' => false);
        if(!empty($_FILES['file']['name'])){
            $config['upload_path'] = 'upload/';
            $config['file_name'] = $_FILES['file']['name'];
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('file')){
                $uploadData = $this->upload->data();
                $filename = $uploadData['file_name'];

				$file['filename'] = $filename;
				
				$query = $this->files_model->insertfile($file);
				if($query){
					$output['message'] = 'File uploaded successfully';
				}
				else{
					$output['error'] = true;
					$output['message'] = 'File uploaded but not inserted to database';
				}

            }else{
            	$output['error'] = true;
				$output['message'] = 'Cannot upload file';
				//$output['message'] = $_FILES['file']['name'];
            }
        }else{
        	$output['error'] = true;
			$output['message'] = 'Cannot upload empty file';
        }

        echo json_encode($output);

	 	}
	 	public function pdf(){
	 		$this->load->view('templates/header.php');
	 		$this->load->view('pdf');
	 		$this->load->view('templates/footer.php');
	 	}
	 	//index of the user the login page and sign up page
		public function index(){

			$this->load->view('templates/header.php');
			$this->load->view('login_signup');
			$this->load->view('templates/footer.php');
			//$this->load->view('pdf');

		}
		public function voterRoom(){
			//get the info about the current user
			$voter = $this->session->userdata('voters');
			extract($voter);
			$data['username'] = $username;
			if($this->session->userdata('voters')){	

				$this->load->view('templates/header');
				//call the function usedPoll to checked the poll that status is in used
				$data['usedPoll'] = $this->login_model->usedPoll();
				
				if($data['usedPoll'] == false){

					echo "<h1 class='text-center alert alert-danger p-2' style='width: 50%;margin-left: 25%;border-radius: 2rem;margin-top: 15%;'> No poll was in used!</h1>";
			    	echo "<a href='".base_url()."index.php/login/logout'class='nav-link' style='margin-left: 40%;font-size: 25px;'><span class='fa fa-sign-out mr-1'></span>You can just logout</a>";
				}else{

					//$name;
					//get the values of the used poll
					foreach($data['usedPoll'] as $var) {
						$data['position'] = $this->login_model->getPositions($var->id);
						$data['poll_id'] = $var->id;
						$data['poll_name'] = $var->poll_name;
					}


				//check if the user is done in voting
				$voted = $this->voting_model->checkVoted($id, $data['poll_id']);
				//check if the user done voting in the poll that is in used
				if($voted == false){

					$this->load->view('voterroom', $data);


				}else{

					echo "<h1 class='text-center alert alert-danger p-2' style='width: 50%;margin-left: 25%;border-radius: 2rem;margin-top: 15%;'> You can only vote once!</h1>";
		    		echo "<a href='".base_url()."index.php/login/logout'class='nav-link' style='margin-left: 40%;font-size: 25px;'><span class='fa fa-sign-out mr-1'></span>You can just logout</a>";
				}

			 }


			}else{

				redirect('/');
			}

		}
		
		//function for the registration of the voter
		function signup(){

			$data['username'] = $_POST['username'];
			$data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
			//check if the username's value contains only string
			if($this->unit->run($data['username'], 'is_string')){

				//check if the two password is matched
				if($_POST['password'] == $_POST['password2']){

					//call the function for the adding of voters
					$return = $this->login_model->addVoter($data);

						if($return === false){

							$ret_msg['error'] = 'True';
							$ret_msg['msg'] = "Name is already taken!";

						}else{

							$ret_msg['msg'] = "Registered. Your voter's id is ".$return;
						}

				}else{

					$ret_msg['error'] = 'True';
					$ret_msg['msg'] = "Password didn't matched!";

				}

			}else{

				$ret_msg['error'] = 'True';
				$ret_msg['msg'] = "Username must be letters only!";


			}
			
			echo json_encode($ret_msg);
		}

		public function login(){
			$ret = array(
				'error' => array(),
				'msg' => array()
			);	

			$usedPoll = $this->login_model->usedPoll();
			$poll_id;
			//get the values of the used poll
			if ($usedPoll != false) {
				
				foreach($usedPoll as $var) {

					$poll_id = $var->id;
				}

			//check if the user already voted in the poll that in used
			$checker = $this->voting_model->checkVoted($_POST['voters_id'], $poll_id);

			if($checker === false){

				$data = $this->login_model->votersLogin($_POST['voters_id']);

				if($_POST['voters_id'] == ""){

					$ret['error'] = "Voters Id is empty!";

				}else if($_POST['password'] == ""){

					$ret['error'] = "Password Id is empty!";
				}else{

				if($data != ""){

					if(password_verify($_POST['password'], $data['password'])){

						$this->session->set_userdata('voters', $data);
						$ret['msg'] = "Logging in...";

					}else{
						$ret['error'] = "Password didn't matched!";
					}

				}else{

					$ret['error'] = "Voters id not found!";
				}

			}

			}else{
				$ret['error'] = "You can vote only once!";
			}

			}else{

				$ret['error'] = "There's no poll that in used!";
			
			}

			echo json_encode($ret);
		}
		//for user logout
		public function logout(){
			
			$this->session->unset_userdata('voters');
			redirect('/');
		}
}
