<?php
if (!empty($_POST["btnAdd"])) {
    $image = $_FILES["image"]["tmp_name"];
    $name = $_FILES["image"]["name"];
    $size = $_FILES["image"]["size"];
    $format = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    $directory = "uploads/";

    if ($format == "jpg" || $format == "jpeg" || $format == "png") {
        // Verifica si el directorio existe y es escribible
        if (!is_dir($directory) && !mkdir($directory, 0755, true)) {
            echo "<div class='alert bg-danger text-white'>Error creating the upload directory.</div>";
            exit;
        }

        // Registrar la imagen en la base de datos
        $stmt = $connection->prepare("INSERT INTO img (img) VALUES ('')");
        $stmt->execute();
        $idRegistered = $connection->insert_id;
        $route = $directory . $idRegistered . "." . $format;

        // Actualizar la base de datos con la ruta de la imagen
        $stmt = $connection->prepare("UPDATE img SET img=? WHERE id_img=?");
        $stmt->bind_param('si', $route, $idRegistered);
        $stmt->execute();

        // Mover la imagen subida al directorio deseado
        if (move_uploaded_file($image, $route)) {
            echo "<div class='alert alert-info'>Image uploaded successfully</div>";
        } else {
            echo "<div class='alert bg-danger text-white'>Error trying to upload the image</div>";
        }
    } else {
        echo "<div class='alert bg-danger text-white'>The format of the image just can be JPG, PNG, or JPEG</div>";
    }
}
?>

<script>
    history.replaceState(null, null, location.pathname);
</script>