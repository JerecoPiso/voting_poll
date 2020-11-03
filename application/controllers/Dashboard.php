<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

		function __construct(){
	 			parent::__construct();
				$this->load->helper('url');
				$this->load->library('session');
				$this->load->model('dashboard_model');
				$this->load->library('Pdf');
				$this->load->library('unit_test');
	 	}
	 	//index of the user the login page and sign up page
		public function index(){

			$this->load->view('templates/admin_header');
			$this->load->view('dashboard/admin_login');
			$this->load->view('templates/footer');

		}
		public function dashboard(){
			if($this->session->userdata('admin')){
				$this->load->view('templates/admin_header');
				$this->load->view('dashboard/dashboard');
				$this->load->view('templates/footer');
			}else{
				redirect('/dashboard/');
			}
			
		}
		public function adminInfo(){

   			$data = $this->session->userdata('admin');
   			extract($data);

   			$ret = $this->dashboard_model->getAdminInfo($id);

   			if($ret === false){

   				echo "Empty session id";

   			}else{

   				echo json_encode($ret);

   			}
			
   			 
		}
		public function upload(){

   			$data = $this->session->userdata('admin');
   			extract($data);
	 		$output = array('error' => false);
        if(!empty($_FILES['file']['name'])){
            $config['upload_path'] = 'assets/images/';
            $config['file_name'] = $_FILES['file']['name'];
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('file')){
                $uploadData = $this->upload->data();
                $filename = $uploadData['file_name'];

				$file['filename'] = $filename;
				
				$query = $this->dashboard_model->insertfile($file['filename'], $id);
				if($query){
					$output['message'] = 'Profile changed successfully';
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

		//function for the login of the admin
		public function adminLogin(){
			//$response = array('msg' => array());
			$data['username'] = $_POST['username'];
			$data['password'] = $_POST['password'];

			$return = $this->dashboard_model->loginAdmin($data);
			

			if($_POST['username'] == ""){

				$ret['msg'] = "Username must not be empty!";

			}else if($_POST['password'] == ""){

				$ret['msg'] = "Password must not be empty!";

			}else{

				if($return != false){
					
					if(password_verify($_POST['password'], $return['password'])){
					
						$this->session->set_userdata('admin', $return);
						$ret['msg'] = 'Logging in...';


					}else{
							
						$ret['msg'] = "Password is incorrect!";
					}

				}else{

					$ret['msg'] = "No username found";
				}

			}

			echo json_encode($ret);
		}
		//page for the account settings of the admin user
		public function settings(){
			//get the info about the current user
			$admin = $this->session->userdata('admin');
			extract($admin);
			$data['id'] = $id;
			$data['username'] = $username;
			$data['password'] = $password;
			$data['hint'] = $hint;
			$data['bdate'] = $bdate;
			$data['contact'] = $contact_no;
			$data['photo'] = $photo;
			$this->load->view('templates/admin_header');
			$this->load->view('dashboard/settings', $data);
			$this->load->view('templates/footer', $data);

		}
		//page for the admin management
		public function admins(){
			if($this->session->userdata('admin')){

				$this->load->view('templates/admin_header');
				$this->load->view('dashboard/admins');
				$this->load->view('templates/footer');

			}else{

				redirect('/dashboard/');
			}

		}
		//page for the managing of the position
		public function position(){
			if($this->session->userdata('admin')){

				$this->load->view('templates/admin_header');
				$this->load->view('dashboard/position');
				$this->load->view('templates/footer');

			}else{

				redirect('/dashboard/');
			}
			
		}
		//page for the managing of the candidates
		public function candidates(){
			if($this->session->userdata('admin')){

				$this->load->view('templates/admin_header');
				$this->load->view('dashboard/candidates');
				$this->load->view('templates/footer');

			}else{

				redirect('/dashboard/');
			}
			
		}
		//page for the list of the voters
		public function voters(){
			$this->load->view('templates/admin_header');
			$this->load->view('dashboard/voters');
			$this->load->view('templates/footer');


		}
		//function for getting the VOTERS to be display in the ADMIN PAGE FOR VOTERS
		public function getVoters(){

			$ret = $this->dashboard_model->voter();
			echo json_encode($ret);
		}
		//function for getting the poll to display in the main page of admin dashboard
		public function getPoll(){
			$ret = $this->dashboard_model->poll();
			echo json_encode($ret);
		}
		//function for getting the candidates to be display in the UI
		public function getCandidates(){
			$ret = $this->dashboard_model->candidates();
			echo json_encode($ret);
		}

		//function for getting the POSITION to be display in the UI
		public function getPosition(){
			$ret = $this->dashboard_model->position();
			echo json_encode($ret);
		}
		//print to pdf all the position of each poll in the database
		public function printPosition(){
			$ret = $this->dashboard_model->position();

				$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);


				$pdf->AddPage();
				$pdf->Cell(50,10,'Date:'.date('d-m-Y').'',0,"R");
				$pdf->Ln(10);
				$pdf->Cell(0,10,'Position',1,2,"C");
				$pdf->SetTitle('My Title');
				$pdf->SetHeaderMargin(30);
				$pdf->SetTopMargin(20);
				$pdf->setFooterMargin(20);
				$pdf->SetAutoPageBreak(true);
				$pdf->SetAuthor('Author');
				$pdf->SetDisplayMode('real', 'default');
				$pdf->Cell(20,8,'No.',1);
				$pdf->Cell(60,8,'Position',1);
				$pdf->Cell(45,8,'Number of Winner',1);
				$pdf->Cell(65,8,'Poll',1);
				
				$no=0;
				foreach($ret as $values){
					$no=$no+1;
					$pdf->Ln(8);
					
					$pdf->Cell(20,8,$no,1);
					$pdf->Cell(60,8,$values->position,1);
					$pdf->Cell(45,8,$values->winner,1);
					$pdf->Cell(65,8,$values->poll_name,1);
					
				}

				$pdf->Output('My-File-Name.pdf', 'I');

			
		}

		//print to pdf all of the candidates
		public function printCandidates(){
			$ret = $this->dashboard_model->candidates();

				$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);


				$pdf->AddPage();
				$pdf->Cell(50,10,'Date:'.date('d-m-Y').'',0,"R");
				$pdf->Ln(10);
				$pdf->Cell(0,10,'Candidates',1,2,"C");
				$pdf->SetTitle('My Title');
				$pdf->SetHeaderMargin(30);
				$pdf->SetTopMargin(20);
				$pdf->setFooterMargin(20);
				$pdf->SetAutoPageBreak(true);
				$pdf->SetAuthor('Author');
				$pdf->SetDisplayMode('real', 'default');
				$pdf->Cell(10,8,'No.',1);
				$pdf->Cell(40,8,'Name',1);
				$pdf->Cell(45,8,'Position',1);
				$pdf->Cell(45,8,'Total Votes',1);
				$pdf->Cell(50,8,'Poll',1);
				
				$no=0;
				foreach($ret as $values){
					$no=$no+1;
					$pdf->Ln(8);
					
					$pdf->Cell(10,8,$no,1);
					$pdf->Cell(40,8,$values->name,1);
					$pdf->Cell(45,8,$values->position,1);
					$pdf->Cell(45,8,$values->votes,1);
					$pdf->Cell(50,8,$values->poll_name,1);
					
				}

				$pdf->Output('My-File-Name.pdf', 'I');


		}
		public function printVoters(){
			$ret = $this->dashboard_model->voter();

				$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);


				$pdf->AddPage();
				$pdf->Cell(50,10,'Date:'.date('d-m-Y').'',0,"R");
				$pdf->Ln(10);
				$pdf->Cell(0,10,'List of Voters',1,2,"C");
				$pdf->SetTitle('Voters');
				$pdf->SetHeaderMargin(30);
				$pdf->SetTopMargin(20);
				$pdf->setFooterMargin(20);
				$pdf->SetAutoPageBreak(true);
				$pdf->SetAuthor('Author');
				$pdf->SetDisplayMode('real', 'default');
				$pdf->Cell(20,8,'No.',1);
				$pdf->Cell(170,8,'Name',1);
				
				
				$no=0;
				foreach($ret as $values){
					$no=$no+1;
					$pdf->Ln(8);
					
					$pdf->Cell(20,8,$no,1);
					$pdf->Cell(170,8,$values->username,1);
				
				}

				$pdf->Output('My-File-Name.pdf', 'I');

		}
		//function for printing the result of voting
		public function printResult(){

			

				$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);


				$pdf->AddPage();
				$pdf->Cell(50,10,'Date:'.date('d-m-Y').'',0,"R");
				$pdf->Ln(10);
				$pdf->Cell(0,10,$_GET['poll_name'] . ' Voting Result',1,2,"C");
				$pdf->SetTitle($_GET['poll_name']);
				$pdf->SetHeaderMargin(20);
				$pdf->SetTopMargin(20);
				$pdf->SetFooterMargin(10);
				$pdf->SetAutoPageBreak(true);
				$pdf->SetAuthor('Author');
				$pdf->SetDisplayMode('real', 'default');
			
				$ret = $this->dashboard_model->positionToBePrint($_GET['poll_id']);
				if($ret != false){

					foreach($ret as $values){

					$pdf->Ln(8);
					$pdf->Cell(95,8,$values->position,1);
					$pdf->Cell(95,8,'Total Votes',1);
					$pdf->Ln(8);
					
					$candidates = $this->dashboard_model->candidatesToBePrint($values->id);

					if($candidates != false){

						foreach ($candidates as $key => $candidate) {
								 	
						 $pdf->Cell(95,8,($key + 1).') '.$candidate->name,1);
						 $pdf->Cell(95,8,$candidate->votes,1);
						 $pdf->Ln(8);

						}
					    
					}else{

						
						$pdf->Cell(95,8,"No candidate/s",1);
					    $pdf->Cell(95,8,"",1);
						
					}
												
				}

		   }else{

		   	$pdf->Cell(190,8,"No position has been put in this poll.",1,2,"C");


		   }
				
				$data = $pdf->Output('My-File-Name.pdf', 'I');


		}
		//function for adding admin
		public function addAdmin(){
			$data['name'] = $_POST['name'];
			$data['pass'] = password_hash($_POST['pass'], PASSWORD_DEFAULT);


			if($this->unit->run($data['name'], 'is_string')){

				if($_POST['pass'] == $_POST['pass2']){

					$return = $this->dashboard_model->adminAdd($data);

					if($return === true){

						$ret['msg'] = "Added";

					}else if($return === false){

						$ret['msg'] = "Error";
					}else{

						$ret['msg'] = $return;
					}


				}else{

					$ret['msg'] = "Password didn't matched!";
				}

			}else{

				$ret['msg'] = "True";
			}

			echo json_encode($ret);

		}
		//function for adding candidate
		public function addCandidate(){
			$data['name'] = $_POST['name'];
			$data['position_id'] = $_POST['position'];
			$data['poll_id'] = $_POST['poll_id'];
			$ret = $this->dashboard_model->newCandidate($data);
			echo $ret;
		}
		//function for adding position
		public function addPosition(){
			$data['position'] = $_POST['position'];
			$data['winner'] = $_POST['winner'];
			$data['poll_id'] = $_POST['poll_id'];
			$ret = $this->dashboard_model->newPosition($data);
			echo $ret;
		}
		//function for deleting candidate
		public function delete(){
			$id = $_POST['id'];
			$ret = $this->dashboard_model->del($id);

	    	echo $ret;
		}
		//function for deleting poll
		public function deletePoll(){
			$id = $_POST['id'];
			$ret = $this->dashboard_model->pollDelete($id);

			echo $ret;
		}
		//function for deleting position
		public function deletePosition(){
			$id = $_POST['id'];
			$ret = $this->dashboard_model->delet($id);

	    	echo $ret;
		}
		//edit security of the admin like password and hint
		public function editSecurity(){
			$id = $_POST['id'];
			$data['hint'] = $_POST['hint'];
			$data['pass'] = password_hash($_POST['pass'], PASSWORD_DEFAULT);

			if($_POST['hint'] == ""){

				$ret['msg'] = "Hint must not be empty!";
			}else if($_POST['pass'] == ""){
				$ret['msg'] = "Password must not be empty!";
			}else{

				if($_POST['pass'] == $_POST['pass2']){

					$return = $this->dashboard_model->securityEdit($data, $id);

					if($return === true){

						$ret['msg'] = "Updated succesfully";

					}else{

						$ret['msg'] = "Error";
					}


				}else{

					$ret['msg'] = "Password didn't matched!";
				}



			}

				
			

			echo json_encode($ret);
		}
		//editing the personal info of the admin
		public function editInfo(){

			$data['name'] = $_POST['uname'];
			$data['bdate'] = $_POST['birthdate'];
			$data['contact'] = $_POST['contact'];
			$id = $_POST['id'];
			$ret = $this->dashboard_model->infoEdit($data,$id);
			echo $ret;

		}
		//function for editing candidate
		public function editCandidates(){
			$data['name'] = $_POST['name'];
			$data['position_id'] = $_POST['position'];
			$data['poll_id'] = $_POST['poll_id'];
			$id = $_POST['id'];
			$ret = $this->dashboard_model->editCandidate($data,$id);
			echo $ret;
		}
		//editing the poll
		public function editPoll(){
			$data['id'] = $_POST['id'];
			$data['poll_name'] = $_POST['poll_name'];
			$ret = $this->dashboard_model->pollEdit($data);
			echo $ret;
		}
		//function for editing position
		public function editPosition(){
			$data['position'] = $_POST['position'];
			$data['winner'] = $_POST['winner'];
			$id = $_POST['id'];
			$ret = $this->dashboard_model->positionEdit($data,$id);
			echo $ret;
		}
		//function for adding new POLL of voting
		public function addPoll(){
			$data['poll_name'] = $_POST['poll_name'];
			$data['status'] = $_POST['status'];
			$ret = $this->dashboard_model->createPoll($data);
			echo $ret;
		}
		
		//function for selecting a particualar poll to be used in voting
		public function usedPoll(){
			$data['poll_id'] = $_POST['poll_id'];
		    $this->dashboard_model->usePoll($data);

		}
		//function for disabling the used poll
		public function unusedPoll(){
			$data['id'] = $_POST['poll_id'];
		    $this->dashboard_model->unUsedPoll($data);
		}

		//for admin logout
		public function logout(){
			
			$this->session->unset_userdata('voters');
			redirect('/dashboard');
		}
}
