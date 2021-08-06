<br><br>
<div class="h1 text-center text-danger font-weight-bold">
    404 - Not Found
</div>
<hr/>
<p class="h3 text-center">The page you requested does not exist . . . !</p>

<?php
global $page;
    if($page == 'admin'){
        $redirect = 'admin/dashboard';
    }else{
        $redirect = "./";
    }
?>

<div class="text-center">
    <a role="button" href="<?=$redirect?>" class="btn btn-link">
        <i class="fa fa-arrow-left"></i> Back to Home
    </a>
</div>