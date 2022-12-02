<?php
    include_once "Connection/connection.php";
    $con = connection();

    $select = "SELECT * FROM `degree`";
    $wip = $con->query($select) or die ($con->error);
    $row = $wip->fetch_assoc();



    if(isset($_POST['submit'])){
        $degs = $_POST['degree'];
        $insert = "INSERT INTO `degree`(`degree_name`) VALUES ('$degs')";
        $con->query($insert) or die ($con->error);

        echo header("Location: testingxxxx.php");
    }


    
    if(isset($_POST['delete'])){
        $reference = $_POST['ref'];
        $delete = "DELETE FROM `degree` WHERE `degree_id` = '$reference' ";
        $con->query($delete) or die ($con->error);

        echo header("Location: testingxxxx.php");
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Testing Bootstrap</title>

    <style>
        body{
            padding:100px;
        }
        
        table{
            border:1px solid;
            width:50%;
            margin:auto;
            border-collapse:collapse;
        }

        th{
            border:1px solid;
            text-align:center;
        }

        td{
            border:1px solid;
            text-align:center;
        }

        th, td{
            padding:5px;
        }

        #add{
            width:100%;
            padding:8px;
        }

        #edit, #del{
            width:100%;
            padding:3px;
        }

        input{
            width:100%;
            padding:4px 10px 4px 10px;
            font-size:17px;
        }
    </style>
</head>
<body>

    <table>
        <tr>
            <th> # </th>
            <th> Degree </th>
            <th> Action </th>
        </tr>

        <?php
        $i=1;
        do{ ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['degree_name']; ?></td>
            <td>
                <a href="update-test.php?ref=<?php echo $row['degree_id']; ?>">
                    <button id="edit" data-toggle="modal" data-target="#edit-modal">
                        Edit
                    </button>
                </a>

                <form action="testingxxxx.php" method="POST">
                    <input type="hidden" name="ref" value="<?php echo $row['degree_id']; ?>">
                    <button id="del" name="delete">Delete</button>
                </form>
            </td>
        </tr>
        <?php } while($row = $wip->fetch_assoc()) ?>

        <tr>
            <td colspan="3">
                <button id="add" data-toggle="modal" data-target="#add-modal">Add Degree</button>
            </td>
        </tr>
    </table>
    







<!-- ***************************************************************************************************** -->
    <!-- ADD BOOTSRAP -->
    <div class="modal fade" id="add-modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">ADD DEGREE</h3>
                </div>


                <div class="modal-body">
                    <form action="" method="POST">
                        <label for="deg">Degree Name:</label>
                        <input type="text" name="degree" id="deg">
                </div>


                <div class="modal-footer">
                        <button class="btn btn-default" name="submit">Submit</button>
                    </form>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="cancel">Cancel</button>
                </div>

            </div>
        </div>
    </div>


</body>
</html>