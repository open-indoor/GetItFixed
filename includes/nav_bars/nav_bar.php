

   <div class="container">
      <div class="header clearfix">
         <h1 class="myhead">GetItFixed</h1>

         <div class="nav">
            <input type="checkbox" id="toggle" />
            
            <div>
               <label for="toggle" class="toggle" data-open="Μενού" data-close="Κλείσιμο Μενού" onclick></label>
               
               <ul class="menu">
                  <li><a href="home_page.php"><b>Home</b></a></li>
                                  
                  <!--IF STATEMENT 
                  get in here only IF someone is logged -->
                  <?php    
                     if(isset($_SESSION['user_fname']))  {
                  ?>
                  
                  <li><a href="make_a_report_page.php">Report</a></li>
                  <li><?php echo "<a href='edit_user_page.php' id='iflogged' >User : ".$_SESSION['user_fname']."</a>"; ?></li>
                  <li><a href="includes/logout.php" id="logout" >Logout</a></li>
                  
                  <!--END IF STATEMENT <img src='/img/user_pic.png' alt='yo' width='20px' height='20px'>  -->
                  <?php
                     }  else  {
                  ?> 
                  <!--ELSE STATEMENT
                  if none is loged -->
                  <li><a href="#">About us</a></li>  
                  <li><a href="login_page.php" id="login">Login</a></li>
                  <?php
                     }
                  ?>

               </ul>
            </div>
         </div><!-- End of Navigation -->

      </div><!-- End of Header --> 

   </div><!-- End of Container -->

