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
    <meta name="description" content="This allows you to search for volunteers by skill/experience">
    <meta name="author" content="Ramit Malhotra">

    <title>Volunteers by skill</title>

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
            <h1>Find volunteers with specific skills</h1>
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
                <h3>Please select skills you want to search by</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
         <!-- start form -->
        <div>
        <?php
          $q = 'Select distinct skill from skills';          
		  $resultCity = pg_query($q);		  
		  if (pg_numrows($resultCity) > 0) {
		  	while($row = pg_fetch_array($resultCity, NULL, PGSQL_ASSOC)){
				?>
			<div class="checkbox-inline">
				<label class="checkbox-inline">
					<input class="cb" type="checkbox" value="<?php echo $row['skill']; ?>"/>
					<?php echo $row['skill']; ?>
				</label>
			</div>
		<?php 
			}	
			}					
		?>
		</div>
		<div id="dropdownDiv"> 
        	<select class="form-control" id="dropdown" style="width:50%;margin-top:1em;">
        	<option value='0'>Select a Chapter (optional)</option>
        	<?php 
        	$q = 'Select * from chapter';
        	$resultCity = pg_query($q);
        	if (pg_numrows($resultCity) > 0) {
        		while($row = pg_fetch_array($resultCity, NULL, PGSQL_ASSOC)){
        	?>
        			<option value="<?php echo $row['chapterid']; ?>">
        				<?php echo $row['chaptername']; ?>
        			</option>
        			<?php 
        				}	
        				}	
        	?>
        	</select>
        </div>
        <!-- end form -->
        
        <button id="btn-click" type="submit" class="btn btn-primary btn-lg" style="margin-top:1em;width:50%;">Search!</button>
        
        <hr>
		<div class="table-responsive" style="display:none;">          
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Current City</th>
            <th>Role</th>
            <th>Project</th>
            <th>Chapter</th>
            <th>Skill</th>
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
			$("#btn-click").on("click", function(){
				var chapterID = $('#dropdown').val();
				var skills = $('input:checkbox:checked').map(function() {
				    return this.value;
				}).get();
				if(skills.length == 0){
					alert("You must choose some skill to search by!");
					return false;
				}
				var toSend = {"chapter":chapterID,"skills":skills,"functionName":"getVolunteersBySkill"};
				var jsonToSend = JSON.stringify(toSend);	
				console.log(jsonToSend);			
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
                                alert("Sorry, no current volunteers with those skills right now!");                                
                            }
                            else{
	                            $.each(data, function(key,value){
									$("#tableBody").append('<tr><td>'+value.fname+' '+value.sname+'</td><td>'+value.phone+'</td><td>'+value.email+'</td><td>'+value.city+'</td><td>'+value.role+'</td><td>'+value.projectname+'</td><td>'+value.chaptername+'</td><td><b>'+value.skill+'</b></td></tr>');
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
