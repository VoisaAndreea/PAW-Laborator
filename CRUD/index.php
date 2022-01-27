<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operații CRUD</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

</head>
<body>

    <style>
        .wrapper {
            width: 1000px;
            margin: 0 auto;
        }
    </style>

    <?php
        require_once "conectareSQL.php";
        //CREARE TABEL SI AFISAREA CONTINUTULUI
        $data = "SELECT * FROM studenti";

        //Daca conectarea la baza de date a reusit, se va crea un tabel cu datele existente in sql
        if($studenti = mysqli_query($conectare, $data)){
            if(mysqli_num_rows($studenti) > 0){
                echo "<table class='table table-bordered table-striped'>
                        <thead> 
                        <tr class='warning'> 
                            <th> Nr. crt </th>
                            <th> Nume </th>
                            <th> Prenume </th>
                            <th> Specializare </th>
                            <th> Operații </th>
                        </tr>
                        </thead>
                        <tbody>" ;
                while($student = mysqli_fetch_array($studenti)){ //se va parcurge toate inregistrarile
                    echo "<tr>
                            <td class='warning'>" . $student['id'] . "</td>
                            <td>" . $student['Nume'] . "</td>
                            <td>" . $student['Prenume'] . "</td>
                            <td>" . $student['Specializare'] . "</td>
                            <td>
                            <a href='read.php?id=". $student['id'] ."' title='View User' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>
                            <a href='edit.php?id=". $student['id'] ."' title='Editare student' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>
                            <a href='delete.php?id=". $student['id'] ."' title='Șterge student' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>
                            </td>
                        </tr>";
                }
                echo "</tbody>
                    </table>";

                mysqli_free_result($studenti);
            }
            else{
                echo "<p class='lead'><em>Nu s-au găsit înregistrări</em></p>";
            }
        }
        else{
            echo "ERROR: Nu s-a putut executa $sql." . mysqli_error($conectare);
        }

        //mysqli_close($conectare);
    ?>

    <!--ADAUGAREA A NOI ELEMENTE IN TABELUL CREAT-->
    <?php
        $nume = $prenume = $specializare = "";
        $nume_error = $prenume_error = $specializare_error = "";
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){

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
                $sql = "INSERT INTO `studenti`(`Nume`, `Prenume`, `Specializare`) VALUES ('$nume', '$prenume', '$specializare')";

                //Se adauga valorile introduse in tabel
                if (mysqli_query($conectare, $sql)) {
                    header("location: index.php");
                } else {
                    die("ERROR:MAI ÎNCEARCĂ: " . mysqli_error($conectare));
                }
            }

            mysqli_close($conectare);
        }
    ?>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
            <div class="page-header">
                        <h2>Adăugare student</h2>
                    </div>
                <form class='form-inline' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>

                    <div class="form-group <?php echo (!empty($nume_error)) ? 'has-error' : ''; ?>">
                        <label>Nume: </label>
                        <input type="text" name="Nume" class="form-control" value="">   
                        <span class="help-block"><?php echo $nume_error;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($prenume_error)) ? 'has-error' : ''; ?>">
                        <label>Prenume: </label>
                        <input type="text" name="Prenume" class="form-control" value="">
                        <span class="help-block"><?php echo $prenume_error;?></span>
                    </div>

                    <div class="form-group <?php echo (!empty($specializare_error)) ? 'has-error' : ''; ?>">
                        <label>Specializare: </label>
                        <input type="text" name="Specializare" class="form-control" value="">
                        <span class="help-block"><?php echo $specializare_error;?></span>
                    </div>

                    <input type="submit" class="btn btn-info" value="Adăugare">
                </from>
            </div>
        </div>  
    </div>

</body>
</html>