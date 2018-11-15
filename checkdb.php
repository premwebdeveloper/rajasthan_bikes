<?php

   $dbhost = 'MYSQL5017.Smarterasp.net';
   $dbuser = '9bbcd4_rajbike';
   $dbpass = 'rajbike#123';
   

   $conn = mysqli_connect($dbhost, $dbuser, $dbpass);

   if (!$conn) {
      die('Could not connect: ' . mysql_error());
   }

   echo 'Connected Successfully<br/>';

   mysqli_close($conn);
   echo 'Connection Closed Successfully';

?>





