<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=false"/>
	<title><?=APP_TITLE?></title>
	<base href="<?=BASE_URL?>"/>

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/popper/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/parsley/dist/parsley.js"></script>
    
    <?php
        if($page == 'admin'):
            include_once('admin/headlinks.php');
        endif;
        ?>
    
    
    <!-- <link rel="stylesheet" href="assets/font-awesome/css/all.css"/> -->
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    
    <!-- <script src="assets/font-awesome/js/all.js"></script> -->
    
    <link rel="stylesheet" type="text/css" href="assets/parsley/src/parsley.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css"/>
    
</head>
<body>