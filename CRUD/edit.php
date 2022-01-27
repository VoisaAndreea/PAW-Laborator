     <!--EDITARE TABEL-->
     <?php
     require_once "conectareSQL.php";

     $nume = $prenume = $specializare = "";
     $nume_error = $prenume_error = $specializare_error = "";

        //Se va colecta datele din formular utilizand metoda post
        if(isset($_POST["id"]) && !empty($_POST["id"])){
            $id = $_POST["id"];
            $nume = trim($_POST["Nume"]);
            if(empty($nume)){
                $nume_error = "Este necesar introducerea numelui";
            }
            else{
                $nume = $nume;
            }

            $prenume = trim($_POST["Prenume"]);
            if(empty($prenume)){
                $prenume_error = "Este necesar introducerea prenumelui";
            }
            else{
                $prenume = $prenume;
            }

            $specializare = trim($_POST["Specializare"]);
            if(empty($prenume)){
                $specializare_error = "Este necesar introducerea specializării";
            }
            else{
                $specializare = $specializare;
            }

            if(empty($nume_error) && empty($prenume_error) && empty($specializare_error)){
                $sql = "UPDATE `studenti` SET `Nume` = '$nume', `Prenume` = '$prenume', `Specializare` = '$specializare' WHERE `id` = '$id'";

                //Se adauga valorile introduse in tabel
                if (mysqli_query($conectare, $sql)) {
                    header("location: edit.php");
                } else {
                     //echo "Încearcă dinou";
                     die("ERROR:MAI ÎNCEARCĂ: " . mysqli_error($conectare));
                }
            }
            mysqli_close($conectare);
        }else {
                if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
                    $id = trim($_GET["id"]);
                    $query = mysqli_query($conectare, "SELECT * FROM studenti WHERE id = '$id'");

                if ($student = mysqli_fetch_assoc($query)) {
                        $nume = $student['Nume'];
                        $prenume = $student['Prenume'];
                        $specializare = $student['Specializare'];
                } else {
                        die("TOT NU MERGE: " . mysqli_error($conectare));
                    }
                }
                mysqli_close($conectare);
            }
        
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editare tabel</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     
</head>
<body>
    <style>
        .wrapper {
            width: 900px;
            margin: 0 auto;
        }
    </style>

<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
            <div class="page-header">
                        <h2>Editare student</h2>
                    </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>

                    <div class="form-group <?php echo (!empty($nume_error)) ? 'has-error' : ''; ?>">
                        <label>Nume</label>
                        <input type="text" name="Nume" class="form-control" value="<?php echo $nume; ?>">   
                        <span class="help-block"><?php echo $nume_error;?></span>
                        
                    </div>

                    <div class="form-group <?php echo (!empty($prenume_error)) ? 'has-error' : ''; ?>">
                        <label>Prenume</label>
                        <input type="text" name="Prenume" class="form-control" value="<?php echo $prenume; ?>">
                        <span class="help-block"><?php echo $prenume_error;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($specializare_error)) ? 'has-error' : ''; ?>">
                        <label>Specializare</label>
                        <input type="text" name="Specializare" class="form-control" value="<?php echo $specializare; ?>">
                        <span class="help-block"><?php echo $specializare_error;?></span>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Editare">
                    <a href="index.php" class="btn btn-default">Pagina principală</a>
                </from>
            </div>
        </div>  
    </div>
    
</body>
</html>