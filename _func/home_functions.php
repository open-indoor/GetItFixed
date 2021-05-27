<?php
	function total_reports()
	{
		global $dbconnection;
		$exists= mysqli_query($dbconnection,"SELECT COUNT(*) AS isthere FROM greports"); 
		$count  = mysqli_fetch_array ( $exists , MYSQLI_NUM );
		return $count[0];	
	}

	function total_users()
	{
		global $dbconnection;
		$exists= mysqli_query($dbconnection,"SELECT COUNT(*) AS isthere FROM gusers"); 
		$count  = mysqli_fetch_array ( $exists , MYSQLI_NUM );
		return $count[0];	
	}

	function total_none_reports()
	{
		global $dbconnection;
		$exists= mysqli_query($dbconnection,"SELECT COUNT(*) AS isthere FROM greports WHERE rep_stat='none' "); 
		$count  = mysqli_fetch_array ( $exists , MYSQLI_NUM );
		return $count[0];	
	}

	function total_fixed_reports()
	{
		global $dbconnection;
		$exists= mysqli_query($dbconnection,"SELECT COUNT(*) AS isthere FROM greports WHERE rep_stat='fixed' "); 
		$count  = mysqli_fetch_array ( $exists , MYSQLI_NUM );
		return $count[0];	
	}

	function total_deleted_reports()
	{
		global $dbconnection;
		$exists= mysqli_query($dbconnection,"SELECT COUNT(*) AS isthere FROM greports WHERE rep_stat='deleted' "); 
		$count  = mysqli_fetch_array ( $exists , MYSQLI_NUM );
		return $count[0];	
	}
/*
	function average_time_to_get_fixed()
	{
		global $dbconnection;
		$exists= mysqli_query($dbconnection,"SELECT  SUM(time_to_sec(TIMEDIFF (rep_date_fixed,rep_date))) AS timedif FROM greports WHERE rep_stat='fixed' "); 
		$row  = mysqli_fetch_array ( $exists , MYSQLI_ASSOC );
		while ($row)	{
			$total_time+=$row['timedif'];
		}
		$aver=$total_time/count($row);
		return $aver;	
	}
*/

	 function average_time_to_get_fixed()
        {   
            global $dbconnection;
            $times= "SELECT count(*) as totalReports,SUM(TIMESTAMPDIFF(SECOND,rep_date,rep_date_fixed )) AS totalTime FROM greports WHERE rep_stat='fixed'";
            $row = mysqli_query($dbconnection,$times);
            $times_array= mysqli_fetch_array ( $row , MYSQLI_NUM );
           
            if( $times_array[0] == 0 )	{
            	$goal= " - - - ";
            }	else 	{
            	/*
            	$days = ((($times_array[1]/$times_array[0])/60)/60)/24;
            	$days = round($days);
            	$hours = (($times_array[1]/$times_array[0])/60)/60;
            	$hours = round($hours);
				*/



            	$inhours = (($times_array[1]/$times_array[0])/60)/60;
            	$inhours = round($inhours);
            	$hours = $inhours%24;
            	$inhours-=$hours;
            	$days = $inhours/24;
            	$days = round($days);

            	$goal = $days;
            	$goal .="d ";
            	$goal .=$hours;
            	$goal .="h ";

            }
            
            return  $goal;
        }
?>