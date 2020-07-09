<?php
$submitPressed = filter_input(INPUT_POST, 'submit');
if (isset($submitPressed)){
    $isbn = filter_input(INPUT_POST, 'isbn');
    $title = filter_input(INPUT_POST, 'title');
    $author = filter_input(INPUT_POST, 'author');
    $publisher = filter_input(INPUT_POST, 'publisher');
    $description = filter_input(INPUT_POST, 'description');
    $cover = filter_input(INPUT_POST, 'cover');
    $category_id = filter_input(INPUT_POST, 'category_id');
    $link = mysqli_connect('localhost','root','','pwl20194',
        '3306') or die(mysqli_connect_error());
    $query = "INSERT INTO book(isbn, title, author, publisher, description, cover, category_id) VALUES(? ? ? ? ? ? ?)";
    mysqli_autocommit($link, false);
    if($stmt = mysqli_prepare($link, $query)){
        mysqli_stmt_bind_param($stmt, 's s s s s s i', $isbn, $title, $author, $publisher, $description, $cover, $category_id);
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
            <label for="BookISBN">ISBN</label>
            <input type="text" name="isbn" class="form-control"  placeholder="Masukan ISBN">
        </div>
        <div class="form-group">
            <label for="BookTitle">Title</label>
            <input type="text" name="title" class="form-control"  placeholder="Masukan Title">
        </div>
        <div class="form-group">
            <label for="BookAuthor">Author</label>
            <input type="text" name="author" class="form-control" placeholder="Masukan Author">
        </div>
        <div class="form-group">
            <label for="BookPublisher">Publisher</label>
            <input type="text" name="publisher" class="form-control" placeholder="Masukan Publisher">
        </div>
        <div class="form-group">
            <label for="BookDescription">Description</label>
            <input type="text" name="description" class="form-control" placeholder="Masukan Description">
        </div>
        <div class="form-group">
            <label for="BookCover">Cover</label>
            <input type="text" name="cover" class="form-control" placeholder="Masukan Cover">
        </div>
        <div class="form-group">
            <label for="BookCategoryId">Category ID</label>
            <input type="text" name="category_id" class="form-control" placeholder="Masukan Category ID">
        </div>
        <p>
        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
        </p>
    </form>

    <table id="myTable" class="display" border="1">
        <thead>
        <tr>
        <th>ISBN</th>
        <th>Title</th>
        <th>Author</th>
        <th>Publisher</th>
        <th>Description</th>
        <th>Cover</th>
        <th>Category ID</th>

        </tr>
        </thead>
        <tbody>
        <?php

        $link = mysqli_connect('localhost','root','','pwl20194',
            '3306') or die(mysqli_connect_error());

        $query = 'SELECT c.name, b.* FROM book b INNER JOIN category c ON c.id = b.category_id';
        if ($result = mysqli_query($link, $query) or die(mysqli_error($link))){
            while ($row = mysqli_fetch_array($result)){
                echo '<tr>';
                echo '<td>' . $row['isbn']  . '</td>' ;
                echo '<td>' . $row['title'] . '</td>' ;
                echo '<td>' . $row['author'] . '</td>' ;
                echo '<td>' . $row['publisher'] . '</td>' ;
                echo '<td>' . $row['description'] . '</td>' ;
                echo '<td>' . $row['cover'] . '</td>' ;
                echo '<td>' . $row['category_id'] . '</td>' ;
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
