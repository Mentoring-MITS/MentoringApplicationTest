<?php
    require '..\vendor\autoload.php';
    session_start();
    require_once('../dbconfig/config.php');
    if(!isset($_SESSION['username'])){
        echo "<script>window.location.href='../index.php';</script>";
    }
    $username=$_SESSION['username'];
    $query="select * from counselor where username='$username'";
    $query_run = mysqli_query($con,$query);
    if($query_run)
    {
        $row=$query_run->fetch_assoc();
        $counselor = $row['name']; 
    }
    if(isset($_GET['user'])){
        $student = $_GET['user'];
        $query = 'select * from form where name = "'.$student.'";';
        $query_run = mysqli_query($con,$query);
        if($query_run){
            if(mysqli_num_rows($query_run)>0){
                $row=$query_run->fetch_assoc();
                $name       = $row['name'];
                $dob        = $row['dob'];
                $gender     = $row['gender'];
                $cause      = $row['cause'];
                $expstress  = $row['expstress'];
                $factors    = $row['factors'];
                $cognitive  = $row['cognitive'];
                $emotional  = $row['emotional'];
                $socialeff  = $row['socialeff'];
                $regno      = $row['regno'];
                $batch      = $row['batch'];
                $department = $row['branch'];
            }
        }
    }else{
        //echo '<script type="text/javascript">alert("no get")</script>';
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Counselor</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/tailwind.min.css">
</head>
<body class=" bg-blue-400 ">
	<nav class=" flex items-center justify-between flex-wrap bg-white p-6">
		    <div class="flex items-center flex-shrink-0 text-blue-600 mr-6 ">
			    	<span class="font-semibold text-xl tracking-tight"><?php echo $username; ?>(<?php echo $counselor;?>)</span>
		    </div>
		    <div class=" w-full block flex-grow lg:flex lg:items-center lg:w-auto">
				<div class="text-sm lg:flex-grow">
                    <a href="home.php" class="block mt-4 lg:inline-block lg:mt-0 text-blue-600 hover:text-blue-200 mr-4">
                        Profile
                    </a>
                    <a href="../include/rqststudents.php" class="block mt-4 lg:inline-block lg:mt-0 text-blue-600 hover:text-blue-200 mr-4">
                        Requested Students
                    </a>
                    <a href="student_list.php" class="block mt-4 lg:inline-block lg:mt-0 text-blue-600 hover:text-blue-200 mr-4">
                        Student List
                    </a>
                    <a href="manage_chat.php" class="block mt-4 lg:inline-block lg:mt-0 text-blue-600 hover:text-blue-200 mr-4">
                        Manage Chat
                    </a>
                    <a href="ChangePassword.php" class="block mt-4 lg:inline-block lg:mt-0 text-blue-600 hover:text-blue-200">
                        Change Password
                    </a>
				</div> 
				<div>
				    <a href="../logout.php" class="inline-block text-sm px-4 py-2 leading-none border rounded text-blue-600 border-blue-600 hover:border-transparent hover:text-blue-600 hover:bg-blue-200 mt-4 lg:mt-0">Logout</a>
				</div>
			</div>
	</nav>

		    <div class=" px-3 py-10 pt-20 bg-blue-400 flex justify-center">
            
				<div class="lg:flex bg-white shadow-md rounded px-8 pt-8 pb-10 mb-8 float-right" >
                
                    <!-- <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden">
					    <img src="../imgs/avatar.png" /> 
				    </div> -->
				    <div class="w-full  py-6 overflow-y-hidden">
                    <form action="student_details.php" method="post">
                        <!-- input begin -->
                        <input type="hidden" name="name" value=<?php echo $name;?>>
                        <input type="hidden" name="dob" value=<?php echo $dob;?>>
                        <input type="hidden" name="gender" value=<?php echo $gender;?>>
                        <input type="hidden" name="cause" value=<?php echo $cause;?>>
                        <input type="hidden" name="expstress" value=<?php echo $expstress;?>>
                        <input type="hidden" name="factors" value=<?php echo $factors;?>>
                        <input type="hidden" name="cognitive" value=<?php echo $cognitive;?>>
                        <input type="hidden" name="emotional" value=<?php echo $emotional;?>>
                        <input type="hidden" name="socialeff" value=<?php echo $socialeff;?>>
                        <input type="hidden" name="regno" value=<?php echo $regno;?>>
                        <input type="hidden" name="batch" value=<?php echo $batch;?>>
                        <input type="hidden" name="department" value=<?php echo $department;?>>
                        <!-- input end -->
                        <button type="submit" name="submit_pdf" class="uppercase p-3 flex items-center bg-blue-600 text-blue-50 max-w-max shadow-sm hover:shadow-lg rounded-full w-10 h-10 ">
                            <!-- <input type="submit" name="submit_pdf"> -->
                            <svg width="32" height="32"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                        </button>
                    </form>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-md font-bold mb-2" >
                                STUDENT DETAILS
                            </label>
                            <p class="text-gray-700 text-base"><b>Name    : </b><?php echo $name;?></p>
                            <p class="text-gray-700 text-base"><b>Admission No:</b> <?php echo $regno;?></p>
                            <p class="text-gray-700 text-base"><b>Batch: </b><?php echo $batch;?> - <?php echo $batch + 4;?></p>
                            <p class="text-gray-700 text-base"><b>Department:</b> <?php echo $department;?></p>
                            <p class="text-gray-700 text-base"><b>Gender  : </b><?php echo $gender;?></p>
                            <p class="text-gray-700 text-base"><b>DOB     : </b><?php echo $dob;?></p>
                            <p class="text-gray-700 text-base"><b>Age     : </b>
                            <?php 
                            //age calculations
                            $dob=new DateTime($dob);
                            $today=date('Y-m-d');
                            $age=$dob -> diff(new DateTime);
                            echo $age->y;
                            ?></p>
                        </div>
                        <br />
                        <div class="mb-6">
                            <label class="block text-gray-700 text-md font-bold mb-2" >
                                SUBMITTED INFORMATION
                            </label>
                            <p class="text-gray-700 text-base"><b>Usual Causes of Stress in your Life : </b><?php echo $cause;?></p>
                            <p class="text-gray-700 text-base"><b>How do you usually experience stress (in the situations selected from the above list)? : </b><?php echo $expstress;?></p>
                            <p class="text-gray-700 text-base"><b>What are the most pressing stress factors in your current academic context
(related to this program of study)? : </b><?php echo $factors;?></p>
                            <p class="text-gray-700 text-base"><b>What are the usual cognitive effects of stress you've noticed at yourself?  : </b><?php echo $cognitive;?></p>
                            <p class="text-gray-700 text-base"><b>What are the usual emotional effects of stress you've noticed at yourself?  : </b><?php echo $emotional;?></p>
                            <p class="text-gray-700 text-base"><b>What are the usual social effects of stress you've noticed at yourself?  : </b><?php echo $socialeff;?></p>
                        </div>
                    </div>
                </div>
            </div>
</body>
</html>