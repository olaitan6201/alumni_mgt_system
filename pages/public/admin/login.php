<?php
    global $init;
    $init->Auth('admin', '../');
?>
<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-logo">
                <a href="index.html">
                    <img class="align-content" src="images/logo.png" alt="">
                </a>
            </div>
            <div class="login-form">
                <center><label><h1>Admin Login</h1></label></center><br>
                <div class="alert alert-success"></div>
                <div class="alert alert-danger"></div>
                <form id="login_form" method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="user" class="form-control" placeholder="Username or Email" required="required">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="pass" class="form-control" placeholder="Password" required="required">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="page" value="admin" class="form-control">
                        <input type="hidden" name="action" value="login" class="form-control">
                    </div>
                            
                    <button type="submit" id="login_btn" class="btn btn-outline-primary btn-sm btn-flat m-b-30 m-t-30">Sign in</button>
                            
                </form>
            </div>
        </div>
    </div>
</div>