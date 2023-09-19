<?php include "inc/header.php"; ?>
<?php
spl_autoload_register(function ($className) {
    include "classes/" . $className . ".php";
})
?>

<?php
$st = new Student();

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $department = $_POST['department'];
    $age = $_POST['age'];
    $st->setValue($name, $department, $age);
    if ($st->insertData()) {
        echo "Data Inserted Successfully!";
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $department = $_POST['department'];
    $age = $_POST['age'];
    $st->setValue($name, $department, $age);
    if ($st->updateData($id)) {
        echo "Data Updated Successfully!";
    }
}

if(isset($_GET['action']) && $_GET['action']=='delete') {
    $id = $_GET['id'];
    if($st->deleteData($id)) {
        echo "Data Deleted Successfully!";
    }
}

if (isset($_GET['action']) && $_GET['action'] == "edit") {
    $id = $_GET['id'];
    $res = $st->readByID($id);
    $result = [];
    foreach ($res as $data) {
        // Extract the desired keys and their values
        $result = [
            'id' => $data['id'],
            'name' => $data['name'],
            'department' => $data['department'],
            'age' => $data['age'],
        ];
    }

?>
    <form action="" method="post">
    <input type="hidden" class="form-control"  name="id"  value="<?php echo $result['id'] ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required="1" value="<?php echo $result['name'] ?>">
        </div>

        <div class="mb-3">
            <label for="department" class="form-label">Department:</label>
            <input type="text" class="form-control" id="department" name="department" value="<?php echo $result['department'] ?>" required="1">
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Age:</label>
            <input type="text" class="form-control" id="age" name="age" value="<?php echo $result['age'] ?>" required="1">
        </div>

        <div class="mb-3">
            <input type="submit" name="update" value="Submit" class="btn btn-primary">
            <input type="reset" value="Clear" class="btn btn-secondary">
        </div>
    </form>
<?php
} else {
?>
    <form action="" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required="1">
        </div>

        <div class="mb-3">
            <label for="department" class="form-label">Department:</label>
            <input type="text" class="form-control" id="department" name="department" required="1">
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Age:</label>
            <input type="text" class="form-control" id="age" name="age" required="1">
        </div>

        <div class="mb-3">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            <input type="reset" value="Clear" class="btn btn-secondary">
        </div>
    </form>


<?php
}
?>

<section class="container">
    <div class="row">


        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Age</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt = 0;
                    foreach ($st->readAll() as $key => $value) {
                        $cnt++;

                    ?>
                        <tr>
                            <td><?php echo $cnt ?></td>
                            <td><?php echo $value['name'] ?></td>
                            <td><?php echo $value['department'] ?></td>
                            <td><?php echo $value['age'] ?></td>
                            <td class="d-flex">
                                <?php echo "<a class='btn btn-success' href='index.php?action=edit&id=" . $value['id'] . "'>Edit</a>" ?>
                                <?php echo "<a class='btn btn-danger' href='index.php?action=delete&id=" . $value['id'] . "'>Delete</a>" ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</section>

<?php include "inc/footer.php"; ?>