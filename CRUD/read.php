<?php
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        require_once "conectareSQL.php";

        $id = trim($_GET["id"]);
        $query = mysqli_query($conectare, "SELECT * FROM `studenti` WHERE `id` = $id");

        if($student = mysqli_fetch_assoc($query)){
            $nume = $student['Nume'];
            $prenume = $student['Prenume'];
            $specializare = $student['Specializare'];
        }
        else{
            die("ERROR:MAI ÎNCEARCĂ: " . mysqli_error($conectare));
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afișare student</title>

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
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Afișare înregistrare</h1>
                    </div>

                        <div class="form-group">
                            <label>Nume student</label>
                            <p class="form-control-static"><?php echo $nume ?></p>
                        </div>

                        <div class="form-group">
                            <label>Prenume student</label>
                            <p class="form-control-static"><?php echo $prenume ?></p>
                        </div>

                        <div class="form-group">
                            <label>Specializare student</label>
                            <p class="form-control-static"><?php echo $specializare ?></p>
                        </div>

                        <p> <a href="index.php" class="btn btn-info">Pagina principală</a> </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>