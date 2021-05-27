<?php
	//include('dbconnect.php');

	function if_admin( $logindata )
	{
		global $dbconnection;
		$exists= mysqli_query($dbconnection,"SELECT COUNT(*) AS isthere FROM gadmins WHERE admin_email='$logindata[0]' AND admin_pass='$logindata[1]' "); 
		$count  = mysqli_fetch_array ( $exists , MYSQLI_NUM );
		return $count[0];
	}

		//load user data on session
	function admin_login($logindata){

		global $dbconnection;
		$_SESSION['admin_status'] = 'on';
		$admindata= mysqli_query($dbconnection,"SELECT * FROM gadmins WHERE admin_email='$logindata[0]' "); 
		$adata = mysqli_fetch_array($admindata, MYSQLI_ASSOC);
		$_SESSION['admin_username'] = $adata['admin_username'];
		$_SESSION['admin_email'] = $adata['admin_email'];
		$_SESSION['admin_id'] = $adata['admin_id'];
		header('Location: home_admin_page.php');
	}


	// elegxos email kai password. 1-> komple  2->den yparxei
	//orisma ARRAY(2)!	0->email  1->password
	function login_check( $logindata )
	{
		global $dbconnection;
		$exists= mysqli_query($dbconnection,"SELECT COUNT(*) AS isthere FROM gusers WHERE user_email='$logindata[0]' AND user_pass='$logindata[1]' "); 
		$count  = mysqli_fetch_array ( $exists , MYSQLI_NUM );	
		return $count[0];
	}
	
	// elegxos an yparxei to email sthn database
	// orisma: ena variable
	function email_check( $email )
	{
		global $dbconnection;
		$exists= mysqli_query($dbconnection,"SELECT COUNT(*) AS isthere FROM gusers WHERE user_email='$email'"); 
		$count  = mysqli_fetch_array ( $exists , MYSQLI_NUM );
		return $count[0];	
	}
	
	
	// dhmiourgia kainouriou user
	//orisma ARRAY(4)!  0->fname  1->lname  2->email  3->password
	function create_user($registerdata) 
	{	
		global $dbconnection;
		$newuser="insert into gusers(user_fname,user_lname,user_email,user_pass) values('$registerdata[0]','$registerdata[1]','$registerdata[2]','$registerdata[3]')";
		 
		if (!mysqli_query($dbconnection,$newuser)) {
			die('Error: ' . mysqli_error($dbconnection));
		}		 
	}
	
	
	//epistrefei to onoma tou xrhsth  lamvanontas to email
	function user_who( $email )
	{
		global $dbconnection;
		$whois= mysqli_query($dbconnection,"SELECT user_fname FROM gusers WHERE user_email='$email'"); 		
		$whois = mysqli_fetch_array($whois, MYSQLI_ASSOC);
		$fname=$whois['user_fname'];
		return $fname;	
	}
	
	//epistrefei to id tou xrhsth  lamvanontas to email	
	function user_who_id( $email )
	{
		global $dbconnection;
		$whois= mysqli_query($dbconnection,"SELECT user_id FROM gusers WHERE user_email='$email'"); 		
		//$fname = mysqli_fetch_array($whois, MYSQLI_ASSOC);
		$lalalo = mysqli_fetch_assoc($whois);
		$user_id = $lalalo['user_id'];
		//echo $fname;
		return $user_id;	
	}
	
	//epistrefei ena array me ta stoixeia tou xrhsth lamvanontas to email	
	function user_who_data( $email )
	{
		global $dbconnection;
		$whois= mysqli_query($dbconnection,"SELECT * FROM gusers WHERE user_email='$email'"); 		
		//$fname = mysqli_fetch_array($whois, MYSQLI_ASSOC);
		$udata = mysqli_fetch_assoc($whois);
		//$user_id = $lalalo['user_id'];
		//echo $fname;
		return $udata;	
	}

	function user_data_by_id( $usid )
	{
		global $dbconnection;
		$whois= mysqli_query($dbconnection,"SELECT * FROM gusers WHERE user_id='$usid'"); 		
		//$fname = mysqli_fetch_array($whois, MYSQLI_ASSOC);
		$udata = mysqli_fetch_assoc($whois);
		//$user_id = $lalalo['user_id'];
		//echo $fname;
		return $udata;	
	}
	
	//returns 1 when someone is logged // return 0 when not
	function logged(){
		$logged=0;
		if(isset($_SESSION['user_id'])) {
			$logged=1;
		}
		return $logged;
	}
	
	
	//load user data on session
	function login($userdata){
		$_SESSION['user_status'] = 'on';
		$_SESSION['user_id'] = $userdata['user_id'];
		$_SESSION['user_fname'] = $userdata['user_fname'];
		$_SESSION['user_lname'] = $userdata['user_lname'];
		$_SESSION['user_email'] = $userdata['user_email'];
		header('Location: home.php');
	}
	
	function change_password($newdata)	{
		global $dbconnection;
		$updatepassword= mysqli_query($dbconnection,"UPDATE gusers SET user_pass='$newdata[1]' WHERE user_id='$newdata[0]'");
	}

	
	// update/edit user data
	function update_data($newdata)	{
		global $dbconnection;
		$update1= mysqli_query($dbconnection,"UPDATE gusers SET user_email='$newdata[1]' WHERE user_id='$newdata[0]'");
		$update2= mysqli_query($dbconnection,"UPDATE gusers SET user_fname='$newdata[2]' WHERE user_id='$newdata[0]'");
		$update3= mysqli_query($dbconnection,"UPDATE gusers SET user_lname='$newdata[3]' WHERE user_id='$newdata[0]'");				
	}

	// update/edit admin data
	function update_admin_data($newdata)	{
		global $dbconnection;
		$update= mysqli_query($dbconnection,"UPDATE gadmins SET admin_email='$newdata[1]', admin_username = '$newdata[2]' WHERE admin_id='$newdata[0]'");				
		$_SESSION['admin_email'] = $newdata[1];
		$_SESSION['admin_username'] = $newdata[2];
	}
	




	function create_category($catname) 
	{	
		global $dbconnection;
		$newcategory="insert into gcategories(cat_name) values('$catname')";
		 
		if (!mysqli_query($dbconnection,$newcategory)) {
			die('Error: ' . mysqli_error($dbconnection));
		}		 
	}

	// elegxos an yparxei to onoma ths kathgorias sthn database
	// orisma: ena variable
	function category_check( $catname )
	{
		global $dbconnection;
		$exists= mysqli_query($dbconnection,"SELECT COUNT(*) AS isthere FROM gcategories WHERE cat_name='$catname'"); 
		$count  = mysqli_fetch_array ( $exists , MYSQLI_NUM );
		return $count[0];	
	}

	// dhmiourgia neo report
	//orisma ARRAY(4)!  0->fname  1->lname  2->email  3->password
	function create_report($newreport) 
	{	
		global $dbconnection;
		if(isset($newreport[5])) {
		
		$reportdata="insert into greports(rep_name,rep_userid,rep_cat,rep_lat,rep_lng,rep_file_1) values('$newreport[0]','$newreport[1]','$newreport[2]','$newreport[3]','$newreport[4]','$newreport[5]')";
		 

		}	else 	{
		$reportdata="insert into greports(rep_name,rep_userid,rep_cat,rep_lat,rep_lng) values('$newreport[0]','$newreport[1]','$newreport[2]','$newreport[3]','$newreport[4]')";
		 
		}
		if (!mysqli_query($dbconnection,$reportdata)) {
			die('Error: ' . mysqli_error($dbconnection));
		}	

	}


	function rep_upload_files($reportsid,$uploaddata) 
	{	

		global $dbconnection;
		mkdir("img/reports_pictures/".$reportsid, 0700);
		$targetfolder = "img/reports_pictures/".$reportsid."/";
		if (isset($uploaddata[0]))	{echo "</br>The following files:</br>";}
		for ($x=0; $x<=3; $x++) {
  			if (isset($uploaddata[$x]))	{

  				$newfilename= $x+1;
  				$newfilename.='_pic.';
  				$newfilename.=basename($uploaddata[$x]['type']);

  				$target = $targetfolder . $newfilename;

  				if(move_uploaded_file($uploaddata[$x]['tmp_name'], $target)) {
  					$filenum="rep_file_";
  					$filenum.=$x+1;
  					$whatfile=$uploaddata[$x];
					$savequery="UPDATE greports SET ";
					$savequery.=$filenum;
					$savequery.="=";
					$savequery.="'$target' WHERE rep_id='$reportsid'";
					$savefile= mysqli_query($dbconnection,$savequery); //Tells you if its all ok
				    echo "-> ". basename( ($uploaddata[$x]['name'])). "</br>";
				    // Connects to your Database

				    
				}

  			}
		} 
		 
		 if (isset($uploaddata[0]))	{echo "successfully uploaded to your report.</br>";}
	}
	

	function update_category($newdata)	{
		global $dbconnection;
		$update1= mysqli_query($dbconnection,"UPDATE gcategories SET cat_name='$newdata[1]' WHERE cat_id='$newdata[0]'");			
	}
	
	function category_name( $catid )
	{
		global $dbconnection;
		$whois= mysqli_query($dbconnection,"SELECT cat_name FROM gcategories WHERE cat_id='$catid'"); 		
		$whois = mysqli_fetch_array($whois, MYSQLI_ASSOC);
		$fname=$whois['cat_name'];
		return $fname;	
	}

	function category_id( $catcanme )
	{
		global $dbconnection;
		$whois= mysqli_query($dbconnection,"SELECT cat_id FROM gcategories WHERE cat_name='$catcanme'"); 		
		$whichcat = mysqli_fetch_array($whois, MYSQLI_ASSOC);
		$catid=$whichcat['cat_id'];
		return $catid;	
	}

	function report_data_by_id( $reportid )
	{
		global $dbconnection;
		$whichrep= mysqli_query($dbconnection,"SELECT * FROM greports WHERE rep_id='$reportid'"); 		
		//$fname = mysqli_fetch_array($whois, MYSQLI_ASSOC);
		$rdata = mysqli_fetch_assoc($whichrep);
		//$user_id = $lalalo['user_id'];
		//echo $fname;
		return $rdata;	
	}

		// update/edit user data
	function fix_report($reportdata)	{
		global $dbconnection;
		$update1= mysqli_query($dbconnection,"UPDATE greports SET rep_adminname='$reportdata[1]' WHERE rep_id='$reportdata[0]'");
		$update2= mysqli_query($dbconnection,"UPDATE greports SET rep_comment='$reportdata[2]' WHERE rep_id='$reportdata[0]'");
		$update3= mysqli_query($dbconnection,"UPDATE greports SET rep_stat='fixed' WHERE rep_id='$reportdata[0]'");		
		$update3= mysqli_query($dbconnection,"UPDATE greports SET rep_date_fixed=NOW() WHERE rep_id='$reportdata[0]'");	


	}
	function delete_report($reportdata)	{
		global $dbconnection;
		$update1= mysqli_query($dbconnection,"UPDATE greports SET rep_adminname='$reportdata[1]' WHERE rep_id='$reportdata[0]'");
		$update2= mysqli_query($dbconnection,"UPDATE greports SET rep_comment='$reportdata[2]' WHERE rep_id='$reportdata[0]'");
		$update3= mysqli_query($dbconnection,"UPDATE greports SET rep_stat='deleted' WHERE rep_id='$reportdata[0]'");				
	}

	function is_valid_type($file)	{

	    // This is an array that holds all the valid image MIME types
	    $valid_types = array("image/jpg", "image/jpeg", "image/bmp", "image/gif");

	    if (in_array($file['type'], $valid_types))
	        return 1;
	    return 0;
	}

	function last_report_id()	{
		global $dbconnection;
		$lastid = mysqli_insert_id($dbconnection);
		return $lastid;	
	}

	
	function table_status_title ($stat) {
		switch($stat){
		case 'fixed':
			$table_title = 'Resolved';
			break;
		case 'none':
			$table_title = 'Open';
			break;
		case 'deleted':
			$table_title = 'Deleted';
			break;
		default:
			$table_title = '';
			break;
		}
		return $table_title;
	}


?>