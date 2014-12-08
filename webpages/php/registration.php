<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Registration Page for Becoming I DB">
  <meta name="author" content="Ramit Malhotra">

  <title>Sign up</title>
  
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <!-- Bootstrap Core CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="../css/heroic-features.css" rel="stylesheet">
  <link href="../css/registration.css" rel="stylesheet">
    
</head>

<body>
  <!-- Container -->
  <div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron hero-spacer">
      <h1>Becoming I Foundation</h1>
    </header>  
    <!-- End Jumbotron Header -->
	
	<?php
    	session_start();
        if( isset($_SESSION['username']) ){
          	echo '  
          	<div class="alert-error">
        		<i class = "fa fa-info-circle info"></i>
            Hold up! You can not register twice! <br />
            But if you really want something else to do you can watch this!
          	</div>
        		<iframe width="100%" height="450" src="//www.youtube.com/embed/nOzAETbJ5lM" frameborder="0" allowfullscreen></iframe> 
        		<script src = "js/script.js"></script>                		
        		<script src="http://code.jquery.com/jquery.js"></script>
          		';          				
        	}
      ?>
      <?php 
		if(isset($_SESSION['username'])){
			echo '</div>';
			include 'footer.php';
			echo '</body></html>';
			die();
				}		
	  ?>
	
    <!-- Title -->
    <div class="row">
      <div class="col-lg-12">
        <h2>Register for an account</h2>
      </div>
    </div>
    <!-- End Title -->
        
    <!-- Page Features -->
    <div id="questions" style="width:50%;">
      <form id="registrationForm" method="POST" action="register.php">
      	<div id="alertDiv" style="display:none;"></div>
        <div class="form-group">
          <label for="FName">First name*</label>
          <input id="FName" name="fname" class="form-control" type="text" placeholder="Enter your first name" required>
        </div>

        <div class="form-group">
          <label for="SName">Last name*</label>
          <input id="SName" name="lname" class="form-control" type="text" placeholder="Enter your last name" required>
        </div>

        <div class="form-group">
          <label for="Email">Email*</label>
          <input id="Email" name="email" class="form-control" type="email" placeholder="Enter email address" required>
        </div>

        <div class="form-group">
          <label for="UserID">Username*</label>
          <input id="UserID" name="username" class="form-control" type="text" placeholder="Choose a username" required>
        </div>

        <div class="form-group">
          <label for="password">Password*</label>
          <input id="password" name="password" class="form-control" type="password" placeholder="Select a password" onChange="checkPasswordLength();" data-toggle="tooltip" data-placement="right" title="Passwords must be atleast 7 characters long" required>
          <div style="display:inline-block" id="pwlong" class="iconCheck">
         	<i class="icon-ok" id="pwlong"></i>
       	  </div>
       	  <div style="display:inline-block" id="pwshort" class="iconCheck">
         	<i class="icon-remove"id="pwshort"></i>
       	  </div>
        </div>

        <div class="form-group">
          <label for="confirmPass">Confirm password*</label>
          <input id="confirmPass" name="confirmPass" class="form-control" type="password" placeholder="Re-enter password" onChange="checkPasswordMatch();" data-toggle="tooltip" data-placement="right" title="Passwords must match" required>
          <div style="display:inline-block" id="match">
	      	<i class="icon-ok" id="pwmatch"></i>
	      </div>
   		  <div style="display:inline-block" id="nomatch">
       		<i class="icon-remove"id="pwnomatch"></i>
   		  </div>
        </div>

        <div class="form-group">
          <label for="dob">Date of Birth*</label>
          <input id="dob" name="dob" class="form-control" type="date" max="10" required> 
        </div>

        <div class="form-group">
          <label for="Gender">Gender*</label><br>
            <input type="radio" name="sex" value="Male" required>Male<br>
            <input type="radio" name="sex" value="Female">Female<br><br>
          </div>
          
        <div class="form-group">
          <label for="Student">Current student status*</label><br>
              <input type="radio" name="student" value="Nonstudent" required>Not a student<br>
              <input type="radio" name="student" value="High school student">High school student<br>
              <input type="radio" name="student" value="Undergraduate student">Undergraduate student<br>
              <input type="radio" name="student" value="Graduate Student">Graduate student<br>
              <br>
        </div>
		<div id="student" style="display: none;">
	        <div class="form-group">
	          <label for="SInstName">Educational institution</label>
	          <input id="SInstName" name="instName" class="form-control" type="text" placeholder="Educational institution or school" required>
	        </div>
	    </div>
		<div id="employee" style="display: none;">
	        <div class="form-group">
	          <label for="OccupationDetail">Current occupation</label>
	          <input id="OccupationDetail" name="occDetail" class="form-control" type="text" placeholder="Occupation" required>
	        </div>
	
	        <div class="form-group">
	          <label for="EInstName">Employer</label>
	          <input id="EInstName" name="einstName" class="form-control" type="text" placeholder="Employer or place of work" required>
	        </div>
	
	        <div class="form-group">
	          <label for="InstType">Type of employer </label><br>
	            <input type="radio" name="InstType" value="Nonprofit organization" required>Non-profit institution<br>
	            <input type="radio" name="InstType" value="For profit company">For-profit institution or company<br>
	            <input type="radio" name="InstType" value="Government institution">Governmental Institution<br>
	            <input type="radio" name="InstType" value="Other">Other<br>
	            <br>
	        </div>
	    </div>
        <div class="form-group">
          <label for="Continue">Do you plan to continue volunteering with Becoming I Foundation?</label><br>
            <input type="radio" name="Continue" value="Yes for short term" required>Yes, for the short-term (<1 year)<br>
            <input type="radio" name="Continue" value="Yes for long term">Yes, for the long-term (>1 year)<br>
            <input type="radio" name="Continue" value="No">No<br>
            <input type="radio" name="Continue" value="Undecided">Undecided<br>
              <br>
          </div>
          
        <div class="form-group">
          <label for="SkillDesc">Please list and describe specific skills that you have that may be helpful for project work</label>
          <textarea cols="50" rows="4" name="SkillDesc" class="form-control" placeholder="e.g. javascript, teaching, video editing, graphic design, etc" required></textarea>     
        </div>

          
        <div class="form-group">
          <legend>Contact information</legend>
          <p><label for="Phone">Phone number</label>
            <input type="text" id="Phone" name="Phone" class="form-control" maxlength="12" required/>
          </p>                  
          <p><label for="Address">Address</label>
            <input type="text" id="Address" name="Address" class="form-control" required/>
          </p>
          <p><label for="City">City</label>
            <input type="text" id="City" name="City" class="form-control" required/>
          </p>
          <p><label for="State">State</label>
            <input type="text" id="State" name="State" class="form-control" required/>
          </p>
          <p><label for="Zip/Pin" >Zip/Pin</label>
            <input type="text" id="Pin" name="Pin" class="form-control" required/>
          </p>
          <p><label for="Country" >Country</label>
            <input type="text" id="Country" name="Country" class="form-control" required/>
          </p>
        </div>
      	<input id="submit-btn" type="submit" class="btn btn-primary btn-lg" value="Become I"/>
      </form>        
    </div>
  </div>
  <!-- /.container -->  
  <script type="text/javascript" src= "../js/jquery-1.11.0.js"></script>
  <script type="text/javascript" src= "../js/jquery-blockui.js"></script>
  <script type="text/javascript" src= "../js/jquery-ui.min.js"></script>
  <script type="text/javascript" src= "../js/bootstrap.min.js"></script>
  <script type="text/javascript">
	        function checkPasswordMatch() {
	            var password = $("#password").val();
	            var confirmPassword = $("#confirmPass").val();
	            if (password != confirmPassword || confirmPassword == '') {
	                $("#match").addClass('iconCheck');
	                $("#nomatch").removeClass('iconCheck');
	            }              
	            else{
	                $("#match").removeClass('iconCheck');
	                $("#nomatch").addClass('iconCheck');
	            }
	        }

	        function checkPasswordLength() {
	            var password = $("#password").val();
	            var pwLen = password.length;
	            if (pwLen < 7) {
	                $("#pwlong").addClass('iconCheck');
	                $("#pwshort").removeClass('iconCheck');
	            }              
	            else{
	                $("#pwlong").removeClass('iconCheck');
	                $("#pwshort").addClass('iconCheck');
	            }
	        }

	        
	        $(document).ready(function () {
	           var tooltips = $('[data-toggle="tooltip"]').tooltip();			               	
	           $("#password").keypress(checkPasswordLength());
	           $("#confirmPass").keypress(checkPasswordMatch());
	           $("input[name='student']").on("change", function() {		           
	        	    var value = $(this).val();
	        	    if(value == "Nonstudent"){
	        	    	$("#student").hide("slow");
	        	    	$("#SInstName").prop("disabled", true);
	        	    	$("#EInstName").removeAttr("disabled");
	        	    	$("#OccupationDetail").removeAttr("disabled");
	        	    	$("input[name='InstType']").removeAttr("disabled");
		        	    $("#employee").show("fast");	        	    	
	        	    }
	        	    else{
	        	    	$("#employee").hide("slow");
	        	    	$("#OccupationDetail").prop("disabled", true);
	        	    	$("#EInstName").prop("disabled", true);
	        	    	$("input[name='InstType']").prop("disabled", true);
	        	    	$("#SInstName").removeAttr("disabled");
	        	    	$("#student").show("fast");		        	    		        	    		        	    
	        	    }
	        	});
	           $("#registrationForm").submit(function(e) {		          
	              
	              var password = $("#password").val();
	              var confirmPassword = $("#confirmPass").val();
	              if ($('#match').hasClass('iconCheck')) {
	                alert("Your passwords do not match!");
	                return false;
	              }
	              if (password != confirmPassword) {
	                alert("Your passwords do not match!");
	                return false;
	              }
	              if ($('#pwlong').hasClass('iconCheck')) {
	                alert("Your password is not long enough. It has to be at least 7 characters long!");
	                return false;
	              } 
	              
	              var dateSplit = $("#dob").val().split("-");	              
	              var date = new Date(dateSplit[0],dateSplit[1]-1,dateSplit[0]);	              	              
	              var today = new Date();
	              if (date > today){
		              alert("Invalid Date of Birth!");
				      return false;
	              }        		           
	              var todayYear = today.getFullYear();
	              if(todayYear - dateSplit[0] < 13){
		              alert("Minimum age must be 13");
		              return false;
	              } 
	              $.blockUI({ message: '<h1><img src="../images/spinner.gif" /> Just a moment...</h1>' });
	              $.ajax({
                      type: 'POST',
                      url: 'register.php',
                      data: $(this).serialize(),
                      dataType: 'json',
                      success: function (data) {
                              console.log(data);
                              if(data['s'] === 's'){
                                $("#alertDiv").removeClass("alert-error").addClass("alert-success").html("<i class = \"fa fa-info-circle info\"></i> Thank you for registering for Becoming I Foundation.").show();                          	  	                                                                                                                                	
                              	}
                              else if(data['e']){
                            	  $("#alertDiv").removeClass("alert-success").addClass("alert-error").html("<i class = \"fa fa-exclamation-triangle info\"></i> "+data['e']).show();                            	                             	 
                              }
                              $.unblockUI();
                              $("html, body").animate({ scrollTop: 0 }, "slow");
                              setTimeout(function(){
									$("#alertDiv").fadeOut("slow");
									if(data['s'])
									window.location.href="login.php"
                              },5000);                                                                                           
                      }
              		});
	              e.preventDefault();
	           });
	        });
    	</script>
    	<?php include 'footer.php';?>
</body>

</html>
