<?php
        //Se va realiza conectarea la baza de date 
        define("server", 'localhost');
        define("username", 'root');
        define("password", '');
        define("DB_Name", 'facultate');

        $conectare = mysqli_connect(server, username, password, DB_Name);
      

        if($conectare == false){
            die("ERROR: NU S-A PUTUT CONECTA." . mysqli_connect_error());  
        }
    ?>