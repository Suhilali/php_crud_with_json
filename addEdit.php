<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>


    <?php
    // Start session 
    session_start();

    // Retrieve session data 
    $sessData = !empty($_SESSION['sessData']) ? $_SESSION['sessData'] : '';

    // Get member data 
    $memberData = $userData = array();
    if (!empty($_GET['id'])) {
        // Include and initialize JSON class 
        include 'Json.class.php';
        $db = new Json();

        // Fetch the member data 
        $memberData = $db->getSingle($_GET['id']);
    }
    $userData = !empty($sessData['userData']) ? $sessData['userData'] : $memberData;
    unset($_SESSION['sessData']['userData']);

    $actionLabel = !empty($_GET['id']) ? 'Edit' : 'Add';

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
            <div class="col-md-12">
                <h2><?php echo $actionLabel; ?> Member</h2>
            </div>
            <div class="col-md-6">
                <form method="post" action="userAction.php">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your name" value="<?php echo !empty($userData['name']) ? $userData['name'] : ''; ?>" required="">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email" value="<?php echo !empty($userData['email']) ? $userData['email'] : ''; ?>" required="">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter contact no" value="<?php echo !empty($userData['phone']) ? $userData['phone'] : ''; ?>" required="">
                    </div>
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" class="form-control" name="country" placeholder="Enter country name" value="<?php echo !empty($userData['country']) ? $userData['country'] : ''; ?>" required="">
                    </div>

                    <a href="index.php" class="btn btn-secondary">Back</a>
                    <input type="hidden" name="id" value="<?php echo !empty($memberData['id']) ? $memberData['id'] : ''; ?>">
                    <input type="submit" name="userSubmit" class="btn btn-success" value="Submit">
                </form>
            </div>
        </div>
    </div>





    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>