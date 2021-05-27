<?php
   session_start();


   function select_nav_bar()	
   {     
      if (isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == 'on' )   {
   		//if ( $_SESSION['admin_status'] == 'on' )	{
   			include('includes/nav_bars/nav_bar_admin.php');
   		//}
      }	else 	{
   		include('includes/nav_bars/nav_bar.php');
   	}
   }


   function only_admin()
   {     
      if ( !isset($_SESSION['admin_status']) && $_SESSION['admin_status'] != 'on' )	{
   			header('Location: home_page.php');
   		}
   }

   function if_admin_gohome()   {
      if (isset($_SESSION['admin_status']) && $_SESSION['admin_status'] == 'on' )   {
         header('Location: home_admin_page.php');
      }
   }


   function only_user()
   {
      if ( !isset($_SESSION['user_status']) && $_SESSION['user_status'] != 'on' ) {
            header('Location: home_page.php');
         }
   }

   function only_guest()
   {
         if ( isset($_SESSION['admin_status']) || isset($_SESSION['user_status']) )  {
            header('Location: home_page.php');
         }
   }
   
?>