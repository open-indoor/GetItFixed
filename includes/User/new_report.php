
<?php
	require_once('_func/myfunctions.php');
	require_once ('_func/db_connect.php');

	if ( !logged())	{
		header('Location: home_page.php'); //in case there is allready a user logged redirect to home
	}	else	{

		if (isset($_POST['newreport'])) {
			

			$newreportdata = array(trim($_POST['reportname']),$_SESSION['user_id'],trim($_POST['reportcategory']),trim($_POST['lat']),trim($_POST['lng'])); /*,trim($_POST['reportcomment']));*/
			//create the report
			create_report($newreportdata);		
			echo "</br>Rapport créé avec succès!";

			$reportsfolder= last_report_id();
			

			
			if (isset($_FILES['Filename1']) || isset($_FILES['Filename2']) || isset($_FILES['Filename3']) || isset($_FILES['Filename4'])  ){


				if (isset($_FILES['Filename1'])){
					$filesarray[]=$_FILES['Filename1'];
				}
				if (isset($_FILES['Filename2'])){
					$filesarray[]=$_FILES['Filename2'];
				}
				if (isset($_FILES['Filename3'])){
					$filesarray[]=$_FILES['Filename3'];
				}
				if (isset($_FILES['Filename4'])){
					$filesarray[]=$_FILES['Filename4'];
				}

				rep_upload_files(last_report_id(),$filesarray);
			}
			
		}	else	{	
		
?>

<div id="forms" >
	<form name="myForm" method="post" action="make_a_report_page.php" enctype="multipart/form-data">
		</br> <span class="main_titles">New report</span> </br> </br>	
	
		<div class="line_height">

		Give a brief description:</br> <input type="text" name="reportname" placeholder="" pattern="^[a-zA-ZαβγδεζηθικλμνξοπρστυφχψωςάέίύόώΑΒΓΔΕΖΗΘΙΚΛΜΝΞΟΠΡΣΤΥΦΧΨΩ{2,50}$" required>	</br></br>
		<?php include('includes/category_radio_buttons.php'); ?> </br>
		
		<div id="latlong">
		Latitude:</br> <input type="text"  id="latbox" name="lat" placeholder="" pattern="^[0-9.-]{1,30}$"  required>	</br>
		Longitude:</br> <input type="text" id="lngbox" name="lng"  placeholder="" pattern="^[0-9.-]{1,30}$" required>	</br></br>
		 </div>
		
		
		<?php 
		include('./includes/Maplibre/maplibre-gl-js-samples-main/maplibre_make_report.html')
		//include('includes/Gmaps/gmap_new_report.html'); ?> </br>


		<input type='file'   name='Filename1' accept="image/*" capture></br>
		<input type='file'   name='Filename2' accept="image/*" capture></br>
		<input type='file'   name='Filename3' accept="image/*" capture></br>
		<input type='file'   name='Filename4' accept="image/*" capture></br>  <!-- accept="image/*;capture=camera" /></br>-->
<!-- -->



		</div>
<!--		Any other comment? :</br> <input type="text" name="reportcomment" placeholder="" style="width: 80%;" > </br></br>
-->		</br>	</br>	
		<input type="submit" name="newreport" value="New report"> </br></br></br>
	</form>

	</br>	
</div>

<?php
		}	 
	}

?>

