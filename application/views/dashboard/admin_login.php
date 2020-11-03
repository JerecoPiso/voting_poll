 <!-- division for the login and sign up form -->
 <div id="adminLogin">
	
	<!-- form for the login-->
    <b-card header="Admin Login" >
	  	 <!-- username input field-->
	  	  <div class="alert alert-danger text-center p-1" v-if="errors.login">
				<button type="button" class="close" @click=""><span aria-hidden="true">&times;</span></button>
				<span class="glyphicon glyphicon-alert"></span> {{ errors.login }}
			</div>
			<div class="alert alert-success text-center p-1" v-if="success.login">
				<button type="button" class="close" @click=""><span aria-hidden="true">&times;</span></button>
				<span class="glyphicon glyphicon-check"></span> {{ success.login }}
			</div>
         <div class="input-group mb-3">
			    <div class="input-group-prepend">
			      	<span class="input-group-text fa fa-user"></span>
			    </div>
		    	<input type="text" class="form-control" v-on:keyup="loginMonitor" v-model="loginDetails.username" placeholder="Username...">
		  </div> 	
		  <!-- password input field-->
		  <div class="input-group mb-3">
			    <div class="input-group-prepend">
			        <span class="input-group-text fa fa-lock"></span>
			    </div>
		   	    <input type="password" v-on:keyup="loginMonitor"  v-model="loginDetails.password" class="form-control" placeholder="Password ...">
		  </div>
		  <!-- button for the login-->
		  <button class="btn btn-primary btn-login" @click="login">{{btnLogin}}</button><br> 
		 
		
	</b-card>

</div>
