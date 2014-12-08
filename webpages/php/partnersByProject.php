<?php 
session_start();
if(!isset($_SESSION['username'])){
        header("location:login.php");
    }

// Connect to server and select databse.
$conn_string = "host=localhost port=5432 dbname=becomingidb user=becomingidb password=t49jfd";
$dbconn = pg_connect($conn_string)
or die('Could not connect: ' . pg_last_error());
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Partners By Project</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/heroic-features.css" rel="stylesheet">
</head>

<body>
    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1>Find partner contact information</h1>
        </header>
		<div>
			<button class="btn" onclick="window.location.href='logout.php'" style="
    float: right;
    margin-top: -2em;
    background-color: rgb(255, 124, 124);
    padding: 2px;
">Logout</button>
		</div>
		
        <hr>

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Please select a city and project</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div>
        <?php
          $q = 'Select * from chapter';          
		  $resultCity = pg_query($q);		  
		  if (pg_numrows($resultCity) > 0) {
		  	while($row = pg_fetch_array($resultCity, NULL, PGSQL_ASSOC)){
				?>
			<div class="radio">
				<label>
					<input type="radio" name="cityName" value="<?php echo $row['chapterid']; ?>"/>
					<?php echo $row['chaptername']; ?>
				</label>
			</div>
		<?php 
			}	
			}					
		?>
		</div>
        
        <div id="dropdownDiv"> 
        	<select class="form-control" id="dropdown" style="display:none;width:50%;"></select>
        </div>
        <div>
        	<button id="btn-click" type="submit" class="btn btn-primary btn-lg" style="display:none;margin-top:1em;width:50%;">Search!</button>
        </div>
        <!-- /.row -->

        <hr>
		
		<div class="table-responsive" style="display:none;">          
      <table class="table">
        <thead>
          <tr>
            <th>Partner Name</th>
            <th>Contact Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>City</th>
          </tr>
        </thead>
        <tbody id="tableBody">
        
        </tbody>
      </table>
      </div>
    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.0 -->
    <script src="../js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$("input[name=cityName]").on("change", function(){
				var selected = $(this).val();
				var toSend = {"city":selected,"functionName":"getProjects"};
				var jsonToSend = JSON.stringify(toSend);
				$.ajax({
                    type: 'POST',
                    url: 'queryScript.php',
                    data: {mydata:jsonToSend},
                    dataType: 'json',
                    success: function (data) {
                            console.log(data);
                            $("#dropdown").html('');
                            $.each(data, function(key,value){
								$("#dropdown").append('<option value="'+value.projectid+'">'+value.projectname+'</option>');								
                                });     
                            $("#dropdown").show("fast");   
                            $("#btn-click").show("fast");                                                                                   
                    	}
            		});
				});

			$("#btn-click").on("click", function(){
				var projectId = $('#dropdown').val();
				var toSend = {"project":projectId,"functionName":"getPartners"};
				var jsonToSend = JSON.stringify(toSend);				
				$.ajax({
                    type: 'POST',
                    url: 'queryScript.php',
                    data: {mydata:jsonToSend},
                    dataType: 'json',
                    success: function (data) {
                            console.log(data);
                            $("#tableBody").html('');
                            if(data.length === 0){
                            	$(".table-responsive").hide("fast");
                                alert("Sorry, no partners in this project right now!");
                            }
                            else{
	                            $.each(data, function(key,value){
									$("#tableBody").append('<tr><td>'+value.name+'</td><td>'+value.fname+' '+value.sname+'</td><td>'+value.phone+'</td><td>'+value.email+'</td><td>'+value.city+'</td></tr>');
	                                });
	                            $(".table-responsive").show("fast");
                            }                                                                                                                                                  
                    	}
            		});
				});

			});
    </script>
</body>

</html>
