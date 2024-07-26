<?php
if (!empty($_GET["id"]) and !empty($_GET["name"])) {
    $id=$_GET["id"];
    $name=$_GET["name"];

    try {
        unlink($name);
    } catch (\Throwable $th) {
        //throw $th;
    }
    $delete=$connection->query("delete from img where id_img=$id");
    if($delete==1){
        echo "<div class='alert alert-success text-white'>Image deleted successfully</div>";
    }
} else {
    echo "<div class='alert bg-danger text-white'>Error trying to delete the image</div>";
}


?>
<script>
    history.replaceState(null,null,location.pathname)
</script>