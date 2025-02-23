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


			<div class=" px-3 py-10 pt-20 bg-blue-400 flex justify-center">
				<div class="lg:flex bg-white shadow-md rounded px-8 pt-8 pb-10 mb-8 " >
				<div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden">
					<img src="../imgs/avatar.png" />

				</div>
				<div class="w-full xl:w-3/5 py-6 overflow-y-hidden">
					<div class="mb-4">
						<label class="block text-gray-700 text-sm font-bold mb-2" >
							Professional Details:
						</label>
						<p class="text-gray-700 text-base">Username: <?php echo $row['username'];?></p>
					</div>
					<div class="mb-6">
						<label class="block text-gray-700 text-sm font-bold mb-2" >
							Personal Details:
						</label>
						<p class="text-gray-700 text-base">Name: <?php echo $row['name'];?></p>
						<p class="text-gray-700 text-base">Email ID: <?php echo $row['email'];?></p>
						<p class="text-gray-700 text-base">Qualification: <?php echo $row['qualification'];?></p>
					</div>
					<div class="flex items-center justify-between">
						<a href="edit.php"><button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded focus:outline-none focus:shadow-outline" >
							Edit Profile
						</button></a>
					</div>
				</div>
					
			</div>
		</div>
</body>
</html>