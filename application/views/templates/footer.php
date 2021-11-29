
<script src="<?php echo base_url();?>assets/bootstrap_vuejs/js/vue.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap_vuejs/js/bootstrap_vue.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap_vuejs/js/axios.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap_vuejs/js/jquery.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

<script>

    $(document).ready(function(){
      $('.del').click(function(){
        	alert("sdfsdf	")
      })
    })
 
	$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
$(document).ready(function(){

 //for the limiting of the votes 
 var value, limit;
 $('input[type=checkbox]').click(function(){
  
 	value = $(this).val();
 	limit = $(this).data('limit')
 	 $('input[value="'+value+'"]').on('change', function (e) {

     if ($('input[value="'+value+'"]:checked').length > limit) {
        $(this).prop('checked', false);
       
        $('.vote-error').text("You can on only vote " + limit +" "+value);
    }
    });

 });
 
 //for adding the vote
 var votes = new Array();
 $('#vote').click(function(){
 		 var link = "http://localhost/voting/"
         $.each($("input[type='checkbox']:checked"), function(){            
                votes.push($(this).data('ids'));
                   
         });
         JSON.stringify(votes)
         if(votes.length == 0){
         	   $('.vote-error').text("You should vote at least one candidate!");
         }else{

         	var ids = JSON.stringify(votes);
        		//alert(votes)
         	 $.ajax({
         	 	url: link + "index.php/vote/votes",
         	 	type: "POST",
         	 	data: {
         	 		id: ids,
         	 		poll_id: $(this).val()
         	 	},
         	 	success: function(res){

         	 		alert(res)
         	 		
         	 		window.location.href = link +'index.php/login/logout'

         	 	}


         	 });

         }
        
 });
});
	
</script>

<script type="text/javascript">
	//VUE JS FOR THE SIGNUP ANFD LOGIN
	var loginSignup = new Vue({
	  el: "#app",
	  data: {
	    loginForm: true,
	    signupForm: false,
	    //variables for the sign up input fields
	    signupDetails: {username: '', password: '', password2: ''},
	    //variables for the login form
	    loginDetails: {voters_id: '', password: ''},
	    //errors for the signup 
	    errors: {username: '', password: '', pass2: '', matched: '', login:'', signup: ''},
	    btnDisable: true,
	    success: {signup: '', login: ''}
	  },
	   
	   methods: {
	   		  //validating the username
	   		  monitorUsername: function(event){
	   		  	var password = loginSignup.signupDetails.password;   		  	
	   		   	var password2 = loginSignup.signupDetails.password2; 
	   		  	var uname = loginSignup.signupDetails.username;
	   		  	var letters = /^[a-zA-Z ]+$/;

	   		    if(uname === ""){

	   		  		loginSignup.errors.username = '';

	   		  	}else if(uname.length < 8){

					loginSignup.errors.username = 'Name is too short!';

				}else if(!uname.match(letters)){

					loginSignup.errors.username = 'Username must contain only letters!';
					loginSignup.btnDisable = true;	
				}else{

					loginSignup.errors.username = '';
					if(uname != "" && password2 != "" && password != "" && uname.length >= 8 && uname.match(letters)){

	   		  				loginSignup.btnDisable = false;	
	   		  					if(event.key == "Enter"){
         							loginSignup.signUp();
        						}   		  				
	   		  			}


				}

	   		  },
	   		  //validating the password
	   		  monitorPassword: function(event){
	   		  	
	   		  	var password = loginSignup.signupDetails.password;
	   		  	
	   			if(password == "" || password.length >= 8){

	   				loginSignup.errors.password = '';

	   			}else{

	   				loginSignup.errors.password = 'Password must contain at least 8 characters!';
	   			}
	   			
	   		  },
	   		   //validating the re-type password
	   		   monitorPassword2: function(event){
	   			   	var password = loginSignup.signupDetails.password;   		  	
	   		   		var password2 = loginSignup.signupDetails.password2; 
	   		   		var uname = loginSignup.signupDetails.username;  
	   		   		var letters = /^[a-zA-Z ]+$/;				
	   		
	   				if(password != password2){

	   					loginSignup.errors.pass2 = 'Password didnt matched!';
	   					loginSignup.errors.matched = '';

	   		  		}else{

	   		  			loginSignup.errors.pass2 = '';
	   		  			
	   		  			if(uname != "" && password2 != "" && password != "" && uname.length >= 8 &&  uname.match(letters)){

	   		  				loginSignup.btnDisable = false;	
	   		  					if(event.key == "Enter"){
         							loginSignup.signUp();
        						}   		  				
	   		  			}
	   		  			
	   		  		}
	   		  },
	   		  loginMonitor: function(){
	   		  			if(event.key == "Enter"){
	   		  				loginSignup.login();
	   		  			}

	   		  },
	   		  //sign up of the user
	   		  signUp: function () {
	   		  	  	
	   		  	 var logForm = loginSignup.toFormData(loginSignup.signupDetails);
	   			 var url = "http://localhost/voting/"
	   		  	 axios.post(url + 'index.php/login/signup', logForm).then(function(res){

	   		  	      if(res.data.error == 'True'){

	   		  	      	//alert(res.data.msg)
	   		  	      	loginSignup.errors.signup = res.data.msg;
	   		  	      	loginSignup.success.signup = '';


	   		  	      }else{

	   		  	      	//alert(res.data.msg)
	   		  	      	loginSignup.success.signup = res.data.msg;
	   		  	      	loginSignup.errors.signup = ''
	   		  	      	//loginSignup.clearMessages();
	   		  	      }   		  

	   		  	 });

	   		  },
	   		  //function for the login 
	   		  login: function() {
	   		  	var url = "http://localhost/voting/"
	   		  	if (loginSignup.loginDetails.voters_id != "" && loginSignup.loginDetails.password != ""){

	   		  		
		   		  	var logForm = loginSignup.toFormData(loginSignup.loginDetails);
		   		  	axios.post(url + 'index.php/login/login', logForm).then(function(res){

		   		  		if(res.data.error != ""){
		   		  			//alert(res.data.error)
		   		  			loginSignup.errors.login = res.data.error;

		   		  		}else{

		   		  			//alert(res.data.msg)
		   		  			window.location.href = url + 'index.php/login/voterroom';


		   		  		}

		   		  	});
	   		  	}
	   		  	
	   		  },
	   		  toFormData: function(obj){
					var form_data = new FormData();
					for(var key in obj){
						form_data.append(key, obj[key]);
					}
					return form_data;
			  },
			  //clearing the input fields and the error messages
			  clearMessages: function(){

			  	    loginSignup.signupDetails.password = '';   		  	
	   		   		loginSignup.signupDetails.password2 = ''; 
	   		   		loginSignup.signupDetails.username = '';  	
	   		   		loginSignup.errors.login = '';  
	   		   		loginSignup.errors.matched = '';
	   		   		loginSignup.success.signup = '';  	
	   		   	
			  },
		onPageDown: function(){
			alert("haha")
		}


	     }
	});
 var candidates = new Vue({
 	el: "#candidates",
 	data: {
 		candidate : [],
 		candidates: {name: '', position: '', id: '', poll_id: ''},
 		positions: [],
 		ids: {id: ''},
 		modal: false,
 		modal_edit: false,
 		message: '',
 		poll: [],
 		position_poll: ''

 	},

	mounted: function(){
		this.getAllCandidates();
		this.getPosition();
		this.getPoll();
	},
 	methods:{
 		getPoll: function(){

 			axios.post("http://localhost/voting/index.php/dashboard/getPoll").then(function(response){
 				
 				candidates.poll = response.data;
	
 			});

 		},
		getAllCandidates: function(){
			axios.get("http://localhost/voting/index.php/dashboard/getcandidates")
				.then(function(response){
					//console.log(response);

					candidates.candidate = response.data;
				});
		},
		addCandidate: function(){
			 
			 var selected = candidates.position_poll;	
			 var pos = selected.split(' ')
		     candidates.candidates.position = pos[0];
		     candidates.candidates.poll_id = pos[pos.length - 1];	     
			var logForm = loginSignup.toFormData(candidates.candidates);
			if(candidates.candidates.name !="" && candidates.candidates.position != ""){
				axios.post("http://localhost/voting/index.php/dashboard/addCandidate", logForm).then(function(response){
				//alert(response.data);
				candidates.message = response.data;
				candidates.getAllCandidates();	
				candidates.clear();
				
			});
			}
			
		},
		editCandidate: function(){

			var datas = loginSignup.toFormData(candidates.candidates);
			axios.post("http://localhost/voting/index.php/dashboard/editCandidates", datas).then(function(response){
				candidates.message = response.data;
				candidates.modal_edit = false;
				candidates.getAllCandidates();	

			});
		},
		getPosition: function(){
			axios.get("http://localhost/voting/index.php/dashboard/getPosition")
				.then(function(response){
					//console.log(response);
					candidates.positions = response.data;
				});
		},
		del: function(){

			var c_id = loginSignup.toFormData(candidates.ids)
		
			axios.post("http://localhost/voting/index.php/dashboard/delete", c_id)
				.then(function(response){
					candidates.modal = false;
					candidates.message = "Deleted succesfully"
					candidates.getAllCandidates();	
				});
		},

		clear: function(){
		 	candidates.candidates = {};
		 
		}
	}

 });
 var positions = new Vue({
 	el: "#position",
 	data: {
 		position: {position: '', winner: '', id: '', poll_id: ''},
 		modal: false,
 		edit: false,
 		message: '',
 		positions: [],
 		poll: []

 	},
 	mounted: function(){
 		
 		this.getPosition();
 		this.getPoll();
 	   

 	},
 	methods: {
 		getPoll: function(){

 			axios.post("http://localhost/voting/index.php/dashboard/getPoll").then(function(response){
 				
 				positions.poll = response.data;
	
 			});

 		},
 		getPosition: function(){
			axios.get("http://localhost/voting/index.php/dashboard/getPosition")
				.then(function(response){
					//console.log(response);
					positions.positions = response.data;
				});
		},
		addPosition: function(){
			//candidates.id = this.$refs['id'].value;
			var logForm = loginSignup.toFormData(positions.position);
			if(positions.position.position !="" && positions.position.winner != ""){
				axios.post("http://localhost/voting/index.php/dashboard/addPosition", logForm).then(function(response){
					positions.message = response.data;
					positions.position = {};
					positions.getPosition();
				
			});
			}
			
		},
		del: function(){
			var p_id = loginSignup.toFormData(positions.position)
		
			axios.post("http://localhost/voting/index.php/dashboard/deletePosition", p_id)
				.then(function(response){
					positions.modal = false;
					positions.message = response.data;
					positions.getPosition();	
				});
		},
		editPosition: function(){
			var data = loginSignup.toFormData(positions.position);
			axios.post("http://localhost/voting/index.php/dashboard/editPosition",data).then(function(response){
					positions.edit = false;
					positions.message = response.data;
					positions.getPosition();	
			});
		},

		clear: function(){
			positions.position = {};
		}
 	}
 });
 var polls = new Vue({
 	el: "#poll",
 	data: {
 		poll: {poll_name: '', status: 'unused'},
 		poll_names: [],
 		polls_id: {poll_id: ''},
 		printPoll: {id: 0, poll_name: ''},
 		messages: '',
 		modalDelete: false,
 		modalEdit: false
 	},
 	mounted: function(){
 		this.getPoll();
 	},
 	methods: {
 		editPoll: function(){

 			var pollInfo = loginSignup.toFormData(polls.printPoll);
 			axios.post("http://localhost/voting/index.php/dashboard/editPoll", pollInfo).then(function(response){

 				 polls.messages = response.data;

 				 polls.getPoll();

 			});

 		},
 		deletePoll: function(){

 			var id = loginSignup.toFormData(polls.printPoll);
 			axios.post("http://localhost/voting/index.php/dashboard/deletePoll", id).then(function(response){

 				polls.messages = response.data;

 				polls.getPoll();


 			});
 		},
 		printResult: function(){

 			//alert(polls.printPoll.poll_name);
 			//var toBePrintPoll = loginSignup.toFormData(poll.printPoll);
 			//axios.post('http://localhost/voting/index.php/',toBePrintPoll).then(function(response){

 			//});
 			window.location.href = 'http://localhost/voting/index.php/dashboard/printResult?poll_id='+polls.printPoll.id+'&poll_name='+polls.printPoll.poll_name;

 		},

 		createPoll: function(){
 			var datas = loginSignup.toFormData(polls.poll);
 			if(polls.poll.poll_name != ""){

 				axios.post("http://localhost/voting/index.php/dashboard/addPoll", datas).then(function(response){
			 				polls.messages = response.data;
			 				polls.poll = {};
			 				polls.getPoll();
 				});

 			}
 			
 		},
 		getPoll: function(){
 			axios.post("http://localhost/voting/index.php/dashboard/getPoll").then(function(response){
 				
 				polls.poll_names = response.data;

 				
 			});
 		},
 		usedPoll: function(){
 			var id = loginSignup.toFormData(polls.polls_id);
 			axios.post("http://localhost/voting/index.php/dashboard/usedPoll",id).then(function(response){
 				polls.getPoll()
 				// x

 				
 			});
 		},
 		unusedPoll: function(){
 			var id = loginSignup.toFormData(polls.polls_id);
 			axios.post("http://localhost/voting/index.php/dashboard/unusedPoll",id).then(function(response){
 					
 				alert(response.data)

 				
 			});
 		}

 		
 	}
 })


 var voters = new Vue({
 	el: "#voters",
 	data: {
 		voters: [],
 	

 	},
 	mounted: function(){
 		this.getVoters();
 	},
 	methods: {
 		getVoters: function(){
 			axios.post("http://localhost/voting/index.php/dashboard/getVoters").then(function(response){
 				
 				voters.voters = response.data;

 				
 			});
 		},
 	}

 });
 var adminLogin = new Vue({
 	el: "#adminLogin",
 	data: {
 		//variables for the login form
	    loginDetails: {username: '', password: ''},
	    //errors for the signup 
	    errors: {login:''},
	    btnLogin: "Log In",
	    success: {login: ''}
 	},

 	methods: {
 		login: function(){
 			var url = "http://localhost/voting/";
 			var adminInfo = loginSignup.toFormData(adminLogin.loginDetails);
 			axios.post("http://localhost/voting/index.php/dashboard/adminLogin", adminInfo).then(function(response){

 				if(response.data.msg == "Logging in..."){
 					adminLogin.btnLogin = response.data.msg;
 					setTimeout(function(){ 

 						window.location.href = url + 'index.php/dashboard/dashboard';

 					}, 3000);
		   		  	
 					
 				}else{

 					adminLogin.errors.login = response.data.msg;
 				}
 		
 			});
 		},
 		loginMonitor: function(event){
 			if(event.key == "Enter"){
 				adminLogin.login();
 			}
 		}
 	}
 });
      
 var adminSetting = new Vue({
 	el: "#admin_setting",
 	data: {
 		file: '',
 		id: '',
 		modal: false,
 		inputDisable: true,
 		securityDisable: true,
 		personalInfo: {id: '', uname:'', birthdate: '',contact: 0},
 		securityInfo: {id: '',pass:'',pass2: '', hint: '', photo: ''}

 	},
 	mounted: function(){
 			this.setAdminInfo();
 	},
 	methods: {
 			setAdminInfo: function(){

 				axios.post("http://localhost/voting/index.php/dashboard/adminInfo").then(function(response){

 				   adminSetting.personalInfo.uname = response.data.username;
 				   adminSetting.personalInfo.birthdate = response.data.bdate;
 				   adminSetting.personalInfo.contact = response.data.contact_no;
 				   adminSetting.securityInfo.hint = response.data.hint;
 				   adminSetting.securityInfo.photo = response.data.photo;


 				});

 			},
 			editPersonalInfo: function(){
 								
 				var infos = loginSignup.toFormData(adminSetting.personalInfo);
 				//alert(adminSetting.personalInfo.uname)
 				axios.post("http://localhost/voting/index.php/dashboard/editInfo", infos).then(function(response){

 						alert(response.data)
 						adminSetting.setAdminInfo();

 				});

 			},

 			editSecurity: function(){

 				var infos = loginSignup.toFormData(adminSetting.securityInfo);

 				axios.post("http://localhost/voting/index.php/dashboard/editSecurity", infos).then(function(response){

 					alert(response.data.msg);
 				    adminSetting.setAdminInfo();
 				});
 			},


      submitFile(){
        /*
                Initialize the form data
            */
            let formData = new FormData();

            formData.append('file', this.file);

            axios.post('http://localhost/voting/index.php/dashboard/upload',
                formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
              }
            ).then(function(response){
            	adminSetting.modal = false;
                   alert(response.data.message);
                  	adminSetting.setAdminInfo();
        })
        
      },

      /*
        Handles a change on the file upload
      */
      handleFileUpload(){
        this.file = this.$refs.file.files[0];
      }

 	},



 });

 var admin = new Vue({
 	el: "#admin",
 	data: {
 		adminInfo: {name: '', pass: '', pass2: ''}
 	},
 	methods: {

 		addAdmin: function(){

 			var infos = loginSignup.toFormData(admin.adminInfo);
 			axios.post("http://localhost/voting/index.php/dashboard/addAdmin", infos).then(function(response){

 				alert(response.data.msg)

 			});

 		}

 	}

 });
</script>
</body>
</html>