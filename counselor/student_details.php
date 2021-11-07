<?php
    require '../vendor/autoload.php';
    if(isset($_POST['submit_pdf'])){
            $name       = $_POST['name'];
            $dob        = $_POST['dob'];
            $gender     = $_POST['gender'];
            $cause      = $_POST['cause'];
            $expstress  = $_POST['expstress'];
            $factors    = $_POST['factors'];
            $cognitive  = $_POST['cognitive'];
            $emotional  = $_POST['emotional'];
            $socialeff  = $_POST['socialeff'];
            $regno      = $_POST['regno'];
            $batch      = $_POST['batch'];
            $department = $_POST['department'];
            //echo($name); test variable
            $batch1 = $batch+4;
            $dob=new DateTime($dob);
            $today=date('Y-m-d');
            $age=$dob -> diff(new DateTime);
            $date_of_birth = $dob->format('Y-m-d');
            //New PDF instance
            $pdf = new \Mpdf\Mpdf();

            //All info into a single string variable
            $content = '';
            $content .=' <div class="mb-4">
            <label class="block text-gray-700 text-md font-bold mb-2" >
                STUDENT DETAILS
            </label>';           //title
            $content .='<p class="text-gray-700 text-base"><b>Name         : </b>'.$name.'</p>';
            $content .='<p class="text-gray-700 text-base"><b>Admission No : </b>'.$regno .'</p>';
            $content .='<p class="text-gray-700 text-base"><b>Batch        : </b>'.$batch.' - '.$batch1.'</p>';
            $content .='<p class="text-gray-700 text-base"><b>Department   : </b>'.$department.'</p>';
            $content .='<p class="text-gray-700 text-base"><b>Gender       : </b>'.$gender.'</p>';
            $content .='<p class="text-gray-700 text-base"><b>DOB          : </b>'.$date_of_birth.'</p>';
            $content .='<p class="text-gray-700 text-base"><b>Age          : </b>'.$age->y.'</p>';
            $content .='</div><br/>';
            $content .='<div class="mb-6">
            <label class="block text-gray-700 text-md font-bold mb-2" >
                SUBMITTED INFORMATION
            </label>';
            $content .='<p class="text-gray-700 text-base"><b>Usual Causes of Stress in your Life : </b>'.$cause.'</p>';
            $content .='<p class="text-gray-700 text-base"><b>How do you usually experience stress (in the situations selected from the above list)? : </b>'. $expstress.'</p>';
            $content .='<p class="text-gray-700 text-base"><b>What are the most pressing stress factors in your current academic context
            (related to this program of study)? : </b>'.$factors.'</p>';
            $content .='<p class="text-gray-700 text-base"><b>What are the usual cognitive effects of stress you\'ve noticed at yourself? : </b>'. $cognitive.'</p>';
            $content .='<p class="text-gray-700 text-base"><b>What are the usual emotional effects of stress you\'ve noticed at yourself?  : </b>'.$emotional.'</p>';
            $content .='<p class="text-gray-700 text-base"><b>What are the usual social effects of stress you\'ve noticed at yourself?  : </b>'.$socialeff.'</p>';
            $content .='</div></div>';
            

            //Writing To PDF
            $pdf->WriteHTML($content);

            //Output to Browser
            $pdf->Output('Student_detail.pdf','D');

    }else{
        //submit again.go back to the student details page
    }
?>