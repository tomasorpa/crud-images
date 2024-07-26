<?php
include("./shared/header.php");
require "model/connection.php";
$pageTitle = 'View Images';
$pageDesc = 'On this page we will be able to view the images that we have uploaded';

$stmt = $connection->prepare('SELECT * FROM imagestest');
$stmt->execute();

// Usar get_result() para obtener un objeto mysqli_result
$result = $stmt->get_result();

// Usar fetch_all() para obtener todos los registros
$imagelist = $result->fetch_all(MYSQLI_ASSOC);

?>
<div class="div-addStudents">
    <div>
        <h2>All images</h2>
        <small>In order to edit or deLete images, you have to login</small>
    </div>

    <button class="btn btn-primary"><a href="login.php">Login</a></button>
</div>
<table class="table ">
    <?php
    require "./model/connection.php";
    $sql = $connection->query("select * from img");
    ?>
    <thead class="bg-dark text-white">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Image</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($data = $sql->fetch_object()) {
        ?>
            <tr>
                <th scope="row"><?= $data->id_img ?></th>
                <td><img width="80px" src="<?= $data->img ?>" alt=""></td>

            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
</main>
</body>

</html>