<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo isset($page_title) or $page_title = "EGERTON CAFE"?></title>

    <!-- Latest compiled and minified Bootstrap CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- custom css for users -->
    <link href="libs/css/user.css" rel="stylesheet" media="screen">

</head>
<body>

    <?php require_once 'testbt.php'; ?>

    <!-- container -->
    <div class="container">
        <div class="row">

        <div class="col-md-12">
            <div class="page-header">
                <h1><?php echo isset($page_title)or  $page_title = "Egerton Cafe" ?></h1>
            </div>
          
