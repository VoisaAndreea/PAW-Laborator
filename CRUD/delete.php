<?php
    if(isset($_POST["id"]) && !empty($_POST["id"])){
        require_once "conectareSQL.php";
        $id = $_POST["id"];

        $query = "DELETE FROM `studenti` WHERE `id` = '$id'";
        if(mysqli_query($conectare, $query)){
            header("location: index.php");
        }
        else{
            die("ERROR:MAI ÎNCEARCĂ: " . mysqli_error($conectare));
        }
    }
    else{
        if(empty(trim($_GET["id"]))){
            die("ERROR:ÎNCEARCĂ MAI TÂRZIU: " . mysqli_error($conectare));
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Șterge student</title>

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
                        <h1>Șterge înregistrarea</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Ești sigur că vrei să ștergi?</p><br>
                            <p>
                                <input type="submit" value="DA" class="btn btn-danger">
                                <a href="index.php" class="btn btn-default">NU</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>