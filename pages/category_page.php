<?php
$submitPressed = filter_input(INPUT_POST, 'submit');
if (isset($submitPressed)){
    $name = filter_input(INPUT_POST, 'name');
    $link = mysqli_connect('localhost','root','','pw1872042',
        '3306') or die(mysqli_connect_error());
    $query = "INSERT INTO category(name) VALUES(?)";
    mysqli_autocommit($link, false);
    if($stmt = mysqli_prepare($link, $query)){
        mysqli_stmt_bind_param($stmt, 's', $name);
        mysqli_stmt_execute($stmt) or die (mysqli_error($link));
        mysqli_commit($link);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.21/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.21/datatables.min.js"></script>
</head>
<div class="page">
<form action="" method="POST">
    <div class="form-group">
        <label for="CatId">Name</label>
        <input type="text" name="name" class="form-control"  placeholder="Masukan Nama">
    </div>
    <p>
    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
    </p>
</form>
<table id="myTable" class="display" border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
    <?php

    $link = mysqli_connect('localhost','root','','pw1872042',
        '3306') or die(mysqli_connect_error());

    $query = 'SELECT * FROM category';
    if ($result = mysqli_query($link, $query) or die(mysqli_error($link))){
        while ($row = mysqli_fetch_array($result)){
            echo '<tr>';
            echo '<td>' . $row['id']  . '</td>' ;
            echo '<td>' . $row['name'] . '</td>' ;
            echo '</tr>';
        }
        mysqli_close($link);
    }

    ?>
    </tbody>
</table>
</div>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();

    } );
</script>
