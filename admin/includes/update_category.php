
<form action="" method="POST">
   <div class="form-group">
    <label for="cat-title">Редактирование категории</label>


    <?php 
    if (isset($_GET['edit'])) {
        $cat_id = $_GET['edit'];
        $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
        $edit = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($edit)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            ?>            
            <input value=" <?php if (isset($cat_title)){echo $cat_title;}?> " class="form-control" type="text" name="cat_title">  

            <?php }} ?>



            <?php 

            if (isset($_POST['update'])) {
                $upd_cat_title = $_POST['cat_title'];
                $query = "UPDATE categories SET cat_title = '{$upd_cat_title}'  WHERE cat_id = {$cat_id} ";
                $update = mysqli_query($connection, $query);
                header("Location: categories.php");
                if (!$udate) {
                    echo 'не удалось обновить ' . mysqli_error($connection);
                }
            }

            ?>

        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="update" value="Обновить">
        </div>
    </form>