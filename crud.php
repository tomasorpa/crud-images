<?php

include("./shared/header.php");
?>
<div class="div-addStudents">
    <h2>Crud images</h2>
    <?php
    require "./model/connection.php";
    require "./controller/addImage.php";
    require "./controller/update.php";
    require "./controller/delete.php";
    $sql = $connection->query("select * from img");
    ?>
</div>
<div class="table-responsive p-3">
    <button class="btn btn-primary"><a href="index.php">Go back</a></button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add image
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="file" class="form-control mb-2" name="image" id="">
                        <input type="submit" value="Add" name="btnAdd" class="form-control btn btn-success">
                    </form>
                </div>

            </div>
        </div>
    </div>
    <table class="table ">

        <thead class="bg-dark text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Image</th>
                <th scope="col">Options</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($data = $sql->fetch_object()) {
            ?>
                <tr>
                    <th scope="row"><?= $data->id_img ?></th>
                    <td><img width="80px" src="<?= $data->img ?>" alt=""></td>
                    <td>
                        <a data-bs-toggle="modal" data-bs-target="#update<?= $data->id_img ?>" href="#" class="btn btn-warning">Update</a>
                        <a href="crud.php?id=<?= $data->id_img ?>&name=<?= $data->img ?>" class="btn btn-danger">Delete</a>

                    </td>
                </tr>
                <div class="modal fade" id="update<?= $data->id_img ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update image</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input name="id_img" type="hidden" value="<?= $data->id_img ?>">
                                    <input name="name_img" type="hidden" value="<?= $data->img ?>">
                                    <input type="file" class="form-control mb-2" name="image">
                                    <input type="submit" value="Update" name="btnUpdate" class="form-control btn btn-success">
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
</main>
<?php
require("./shared/footer.php")
?>
</body>

</html>