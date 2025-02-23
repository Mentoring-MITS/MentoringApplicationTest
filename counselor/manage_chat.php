<?php
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
    }
?>
<?php
    if(isset($_POST['chat_select'])){
        $username   = $_POST['username'];
        $start_yr   = $_POST['start_yr'];
        $dept       = $_POST['dept'];
        $reason     = 'Counselor requested the chat';
        $approve    = 2;

        $query = 'select username from request where username = "'.$username.'";';
        $query_run = mysqli_query($con,$query);
        if($query_run){
            if(mysqli_num_rows($query_run) == 0){
                $query = 'insert into request(`username`,`reason`,`approve`,`dept`,`start_yr`) values("'.$username.'","'.$reason.'","'.$approve.'","'.$dept.'","'.$start_yr.'");';
                $query_run = mysqli_query($con,$query);
                if($query_run){
                    echo '<script type="text/javascript">alert("Successfully Added!!")</script>';
                    echo "<script>window.location.href='../include/rqststudents.php';</script>";
                }else{
                    echo '<script type="text/javascript">alert("Error Adding student to Chat!!")</script>';
                }

            }else{
                echo '<script type="text/javascript">alert("Chat already exists!!")</script>';
            }

        }else{
            echo '<script type="text/javascript">alert("Error!!")</script>';
        }


    }
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage_chat</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/tailwind.min.css">
</head>
<body class=" bg-blue-400 ">
<nav class=" flex items-center justify-between flex-wrap bg-white p-6">
		    <div class="flex items-center flex-shrink-0 text-blue-600 mr-6 ">
				<span class="font-semibold text-xl tracking-tight"><?php echo $_SESSION['username']; ?>(<?php echo $row['name'];?>)</span>
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
            <div class=" px-2 py-2 bg-blue-400 flex justify-center">
                <div class="w-3/4 bg-white shadow-md rounded px-4 mb-2 " >
                    <div class="w-full overflow-y-hidden"> 
                        <div class="mb-2">
                            <h2>Select Department & Batch(Open Chat):</h2></br>
                            <form class="form" action="manage_chat.php" method="post">
                                <label class="text-gray-700 text-md font-bold mb-2" for="department">
                                    Department:
                                </label>
                                <select id="department" class="border border-gray-lighter" name="department" required>
                                    <option value="CSE">CSE</option>
                                    <option value="CE">CE</option>
                                    <option value="ECE">ECE</option>
                                    <option value="EEE">EEE</option>
                                    <option value="ME">ME</option>
                                </select>
                                <label class=" text-gray-700 text-md font-bold mb-2" for="batch">
                                    Batch:
                                </label>
                                <select id="batch" class="border border-gray-lighter" name="batch" required>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                </select>
                                <!-- <div class="flex items-center justify-between"> -->
                                <button class="inline-block text-sm px-4 py-2 leading-none border rounded text-blue-600 border-blue-600 hover:border-transparent hover:text-white hover:bg-blue-600 mt-4 lg:mt-0" type="submit" name="chat">
                                        Submit
                                </button>
                            <!-- </div> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php
            if(isset($_POST['chat'])){
                $department = $_POST['department'];
                $batch = $_POST['batch'];

                // retrieve all students corresponding to department & batch 
                $query = 'select * from `student` where dept = "'.$department.'" AND start_yr = "'.$batch.'" ;';
                $query_run = mysqli_query($con,$query);
                if($query_run)
                {
                    if(mysqli_num_rows($query_run)>0){                         
                                            //looping through all students
                        ?>
                        <div class=" px-1 py-2 bg-blue-400 flex justify-center shadow-md rounded">
                            <div class="w-3/4 lg:flex bg-white shadow-md rounded px-4 py-4 mb-4 " >
                                <div class="w-full  py-2 ">
                                    <table class="text-left w-full ">
                                        <thead class="bg-blue-400 flex text-white w-full"> 
                                            <tr class="flex w-full mb-2">
                                                <th class="p-2 w-1/4">Name</th>
                                                <th class="p-2 w-1/4">Department</th>  
                                                <th class="p-2 w-1/4">Batch</th>  
                                                <th class="p-2 w-1/4">Chat</th> 
                                            </tr>  
                                        </thead>
                                        <tbody class="bg-grey-light flex flex-col items-center justify-between overflow-y-scroll w-full" style="height: 50vh;">
                                            <?php
                                            //end of div
                                            while($row=mysqli_fetch_assoc($query_run)){
                                                $name       = $row['name'];
                                                $username   = $row['username'];
                                                //printing 
                                                ?>
                                                    <tr class="flex w-full mb-2">
                                                            <td class="p-1 w-1/4 overflow-hidden"><?php echo $name; ?></td>
                                                            <td class="p-1 w-1/4 overflow-hidden"><?php echo $department; ?></td>
                                                            <td class="p-1 w-1/4 overflow-hidden"><?php echo $batch; ?></td>
                                                        </div> 
                                                        <td class="p-1 w-1/4 overflow-hidden">
                                                            <form action="manage_chat.php"  method="post">
                                                                <input type="hidden" name="username" value=<?php echo $username; ?>>
                                                                <input type="hidden" name="dept" value=<?php echo $department; ?>>
                                                                <input type="hidden" name="start_yr" value=<?php echo $batch; ?>>
                                                                <button type="submit" name="chat_select" class="inline-block text-sm px-4 py-1 leading-none border rounded text-green-600 border-green-600 hover:border-transparent hover:text-white hover:bg-green-700 mt-4 lg:mt-0">
                                                                    Chat
                                                                </button>
                                                            </form>
                                                         </td>
                                                        </tr>  
                                                <?php
                                            }
                        ?>  
                                        </div>
                                    </div>
                                </div>
                        <?php
                    }else{
                        echo '<script type="text/javascript">alert("Student Details Not available!")</script>';
                    }
                }
            }else{
                //homepage
            }
        ?>

		 
</body>
</html>