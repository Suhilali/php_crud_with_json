<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Crud with Json</title>
</head>

<body>

    <?php
    // Start session 
    session_start();

    // Retrieve session data 
    $sessData = !empty($_SESSION['sessData']) ? $_SESSION['sessData'] : '';

    // Include and initialize JSON class 
    require_once 'Json.class.php';
    $db = new Json();

    // Fetch the member's data 
    $members = $db->getRows();

    // Get status message from session 
    if (!empty($sessData['status']['msg'])) {
        $statusMsg = $sessData['status']['msg'];
        $statusMsgType = $sessData['status']['type'];
        unset($_SESSION['sessData']['status']);
    }
    ?>

    <!-- Display status message -->
    <?php if (!empty($statusMsg) && ($statusMsgType == 'success')) { ?>
        <div class="col-xs-12">
            <div class="alert alert-success"><?php echo $statusMsg; ?></div>
        </div>
    <?php } elseif (!empty($statusMsg) && ($statusMsgType == 'error')) { ?>
        <div class="col-xs-12">
            <div class="alert alert-danger"><?php echo $statusMsg; ?></div>
        </div>
    <?php } ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12 head">
                <h5>Members</h5>
                <!-- Add link -->
                <div class="float-right">
                    <a href="addEdit.php" class="btn btn-success"><i class="plus"></i> New Member</a>
                </div>
            </div>

            <!-- List the users -->
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Country</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($members)) {
                        $count = 0;
                        foreach ($members as $row) {
                            $count++; ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['phone']; ?></td>
                                <td><?php echo $row['country']; ?></td>
                                <td>
                                    <a href="addEdit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">edit</a>
                                    <a href="userAction.php?action_type=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete?');">delete</a>
                                </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="6">No member(s) found...</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>