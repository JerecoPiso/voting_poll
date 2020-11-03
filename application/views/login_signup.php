 <!-- division for the login and sign up form -->
 <div id="app">
	
	<!-- form for the login-->
    <b-card header="Log In" v-if="loginForm">
	  	 <!-- username input field-->
	  	  <div class="alert alert-danger text-center p-1" v-if="errors.login">
				<button type="button" class="close" @click="clearMessages();"><span aria-hidden="true">&times;</span></button>
				<span class="glyphicon glyphicon-alert"></span> {{ errors.login }}
			</div>
			<div class="alert alert-success text-center p-1" v-if="success.login">
				<button type="button" class="close" @click="clearMessages();"><span aria-hidden="true">&times;</span></button>
				<span class="glyphicon glyphicon-check"></span> {{ success.login }}
			</div>
         <div class="input-group mb-3">
			    <div class="input-group-prepend">
			      	<span class="input-group-text fa fa-user"></span>
			    </div>
		    	<input type="number" class="form-control" v-on:keyup="loginMonitor" v-model="loginDetails.voters_id" placeholder="Voter's Id ...">
		  </div> 	
		  <!-- password input field-->
		  <div class="input-group mb-3">
			    <div class="input-group-prepend">
			        <span class="input-group-text fa fa-lock"></span>
			    </div>
		   	    <input type="password" v-on:keyup="loginMonitor"  v-model="loginDetails.password" class="form-control" placeholder="Password ...">
		  </div>
		  <!-- button for the login-->
		  <button class="btn btn-primary btn-login" @click="login">Log In</button><br> 
		  <a  @click="loginForm = false; signupForm = true;">Don't have an account?</a>
		
	</b-card>

	<!-- form for the sign up-->
	<b-card header="Log In" v-if="signupForm">
	  	 <!-- username input field-->
	  	  <div class="alert alert-danger text-center p-1" v-if="errors.signup">
				<button type="button" class="close" @click="clearMessages();"><span aria-hidden="true">&times;</span></button>
				<span class="glyphicon glyphicon-alert"></span> {{ errors.signup }}
			</div>
			<div class="alert alert-success text-center p-1" v-if="success.signup">
				<button type="button" class="close" @click="clearMessages();"><span aria-hidden="true">&times;</span></button>
				<span class="glyphicon glyphicon-check"></span> {{ success.signup }}
			</div>
	  	 
         <div class="input-group">
		    	<div class="input-group-prepend">
			      	<span class="input-group-text fa fa-user"></span>
			    </div>
		    	<input type="text" class="form-control" v-model="signupDetails.username" placeholder="Username ..." v-on:keyup="monitorUsername">

		  </div>		
		   <i class="error mt-1" v-if="errors.username">{{ errors.username }}</i>


		  <!-- password input field-->
		
		  <div class="input-group mt-3">
			    <div class="input-group-prepend">
			     	 <span class="input-group-text fa fa-lock"></span>
			    </div>
		    	<input type="password" class="form-control"  v-model="signupDetails.password" placeholder="Password ..." v-on:keyup="monitorPassword">
		  </div>
		   <i class="error" v-if="errors.password">{{ errors.password }}</i>
		  <!-- re-type password input field-->
		  <div class="input-group mt-3">
			    <div class="input-group-prepend">
			      	<span class="input-group-text fa fa-lock"></span>
			    </div>
		    	<input type="password" class="form-control" v-model="signupDetails.password2" v-on:keyup="monitorPassword2" placeholder="Re-type password ...">
		  </div>
		   <i class="error" v-if="errors.pass2">{{ errors.pass2 }}</i>
		   <i class="matched" v-if="errors.matched">{{ errors.matched }}</i>
		  <!-- button for the login-->
		  <button @click="signUp" class="btn btn-primary btn-login mt-3" v-bind:disabled="btnDisable">Log In</button><br> 
		   <a  @click="signupForm = false; loginForm = true">Already have an account?</a>
	</b-card>
</div>
