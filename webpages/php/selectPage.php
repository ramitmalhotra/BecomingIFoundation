<?php
session_start();
if(!isset($_SESSION['username'])){
        header("location:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This allows you to select queries">
    <meta name="author" content="Ramit Malhotra">

    <title>Query Selection</title>

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
            <h1><?php echo "Hi ".$_SESSION['name'].",";?>what do you want to do?</h1>
            <p>Please select your query.</p>
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
                <h3>Options</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="../images/address_file.jpg" alt="">
                    <div class="caption">
                        <h3>Get Volunteer Contacts by Project</h3>
                        <p>Obtain volunteer contact information for a project.</p>
                        <p>
                            <a href="volunteersByProject.php" class="btn btn-primary">Select</a> 
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="../images/A-grade.jpg" alt="">
                    <div class="caption">
                        <h3>View Project Assessment Metrics </h3>
                        <p>Evaluate projects by their assessment metrics</p>
                        <p>
                            <a href="assessmentMetrics.php" class="btn btn-primary">Select</a> 
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="../images/pocket_knife.jpg" alt="">
                    <div class="caption">
                        <h3>Find Volunteers by Skill and Experience</h3>
                        <p>Find continuing volunteers with specific skills.</p>
                        <p>
                            <a href="volunteersBySkill.php" class="btn btn-primary">Select</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="../images/handshake.jpg" alt="">
                    <div class="caption">
                        <h3>Get Partner Contacts by Project</h3>
                        <p>Obtain contact information for project partners.</p>
                        <p>
                            <a href="partnersByProject.php" class="btn btn-primary">Select</a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->

        <hr>

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.0 -->
    <script src="../js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
	<?php include 'footer.php';?>
</body>

</html>
