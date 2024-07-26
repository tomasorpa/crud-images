<?php
if (!empty($_POST["btnUpdate"])) {
    $id_img = $_POST["id_img"];
    $name_img = $_POST["name_img"];

    $image = $_FILES["image"]["tmp_name"];
    $name = $_FILES["image"]["name"];
    $size = $_FILES["image"]["size"];
    $format = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    $directory = "uploads/";

    // Verifica si se ha subido una imagen
    if ($image) {
        // Verifica si el formato de la imagen es válido
        if ($format == "jpg" || $format == "jpeg" || $format == "png") {
            // Construye la ruta del nuevo archivo
            $route = $directory . $id_img . "." . $format;

            // Elimina el archivo anterior si existe
            try {
                $stmt = $connection->prepare("SELECT img FROM img WHERE id_img = ?");
                $stmt->bind_param("i", $id_img);
                $stmt->execute();
                $result = $stmt->get_result();
                $oldImage = $result->fetch_assoc()["img"];
                if (is_file($oldImage)) {
                    unlink($oldImage);
                }
            } catch (Exception $e) {
                echo "<div class='alert bg-danger text-white'>Error trying to delete old image: " . $e->getMessage() . "</div>";
            }

            // Mueve el nuevo archivo al directorio deseado
            if (move_uploaded_file($image, $route)) {
                // Actualiza la base de datos con la nueva ruta de la imagen
                $update = $connection->query("UPDATE img SET img='$route' WHERE id_img=$id_img");
                if ($update) {
                    echo "<div class='alert alert-success text-white'>Image updated successfully</div>";
                } else {
                    echo "<div class='alert bg-danger text-white'>Error trying to update image in the database</div>";
                }
            } else {
                echo "<div class='alert bg-danger text-white'>Error trying to move uploaded image</div>";
            }
        } else {
            echo "<div class='alert bg-danger text-white'>The format of the image can only be JPG, PNG, or JPEG</div>";
        }
    } else {
        echo "<div class='alert alert-info text-white'>You must select an image</div>";
    }
}
?>
<script>
    history.replaceState(null, null, location.pathname);
</script>