<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<link href="../css/login.css" rel='stylesheet' type='text/css' />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/font-awesome.min.css">
		<link href="../css/heroic-features.css" rel="stylesheet">
		<title>Log in</title>

		<!--webfonts-->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text.css'/>
		<!--//webfonts-->
</head>
<body>
	<div class="container">
		<header class="jumbotron hero-spacer">
	      <h1>Becoming I Foundation</h1>
	    </header>
		<div class="main">
			<?php
						        if(isset($_SESSION['username'])){
						          echo   
						          '<script type="text/javascript">
	        							$(".main").css("width","55%");
	        							$(".header").text("Oops!");
	        						</script>';
	        						echo '<div class = "alert-error"> 
				            			<i class = "fa fa-exclamation-triangle info"></i>
				                		You are already logged in!<br/>
	        							Nothing to see here - Watch this instead.
	        							</div>
	        							<iframe width="100%" height="450" src="//www.youtube.com/embed/dkU_Kx4SevA" frameborder="0" allowfullscreen></iframe>			                
				             		';					                  					         
						          
						        }
						      ?>
				<?php if(isset($_SESSION['username'])){
					echo '</div></div></div></div>';
					include 'footer.php';
					echo '</body></html>';
					die();
					}			
				?>
			<div class="header">
				<h1>Login or Create a Free Account!</h1>
			</div>
			<p>Please sign in to your Becoming I Account. If you have not created one, please register. </p>
	
			<div class="container" style="width: 50%;">
				<div id="alertDiv" style="color:red;display:none;"></div>
		      	<form id = "loginForm" class="form-horizontal" action="checklogin.php" method="post">
		        	
		        	<div class="form-group">
		          		<div class="col-sm-10">
		            		<input type="Text" class="form-control" id="username" name="username" placeholder="Enter username" required/>
		          		</div>
		        	</div>
	
			        <div class="form-group">
			          	<div class="col-sm-10">
			            	<input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required/>
			          	</div>
			        </div>
	
		        	<div class="row"> 
		        		<div class="col-sm-offset-2 col-sm-2">
				        	<div class="form-group">
					            <div class="checkbox">
					           	   	<label><input type="checkbox"> Remember me</label>
					           	</div>    
					        </div>
					    </div>
					    <div class="col-sm-4">
					    	<h5>Don't have an account?</h5>  
					    </div>    
			    	</div>
	
			    	<div class="row">
				       	<div class="col-sm-offset-2 col-sm-2">
			        		<div class="form-group">
					       	  	<input type="submit" class ="btn btn-primary btn-lg" value="Login">
					       	</div>
				    	</div>
			          	<div class="col-sm-4">
			          		<div class="form-group">        
								<input type="button" class="btn btn-secondary btn-lg" onclick="location.href='registration.php'" value="Become I !" >
			          		</div>
			        	</div>
		        	</div>
		      	</form>
		      	
			</div>
		</div>
	</div>
	<!-- JAVASCRIPT -->
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script type="text/javascript" src= "../js/jquery-blockui.js"></script>
        <script type="text/javascript" src= "../js/jquery-ui.min.js"></script>
        <script type="text/javascript">
        	$(document).ready(function () {        		
        		$("#loginForm").submit(function(e) {
			    	var username = $("#username").val();
			    	var password = $("#password").val();
				    if(!username.match(/\S/)) {
				        alert ('Your username can not be empty!');
				        return false;
				    } else if (!password.match(/\S/)) {
				        alert ('Your password can not be empty!');
				        return false;
				    }        	                	                	               
  	            $.blockUI({ message: '<h1><img src="../images/spinner.gif" /> Just a moment...</h1>' });
        		$.ajax({
                    type: 'POST',
                    url: 'checklogin.php',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (data) {
                            console.log(data);
                            if(data['s']){
                              window.location.href = "selectPage.php";                          	  	                                                                                                  
                            	//$("#info_content2").html("<div class=\"alert-success\"><i class = \"fa fa-info-circle info\"></i> Thank you for registering for UCBMUN XIX. We look forward to seeing you in February.</div>");
                            	}
                            else if(data['e']){                                
                          	  $("#alertDiv").removeClass("alert-success").addClass("alert-error").html("<i class = \"fa fa-exclamation-triangle info\"></i> "+data['e']).show();                          	 
                            }
                            $.unblockUI();
                            $("html, body").animate({ scrollTop: 0 }, "slow");
                            setTimeout(function(){
									$("#alertDiv").fadeOut("slow");									
                            },10000);                                                                                           
                    }
            		});
	              e.preventDefault();
        		});
        	});	
        </script>
	<?php include 'footer.php';?>
</body>
</html>

