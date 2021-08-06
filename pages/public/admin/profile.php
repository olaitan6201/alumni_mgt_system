<?php
    $page_link1='Settings';
    $page_link2='Update Profile';

    global $auth;
    global $init;
    
    include_once('includes/admin/header.php');

    // $pg = $pgs->fetchSettings();

    $user = $auth->Auth('unique_id', $init->session('blog_admin')->value);

    // print_r($user);
?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4>Page Settings</h4>
        </div>
        <div class="card-body">
            <div class="custom-tab">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="custom-nav-home-tab" data-toggle="tab" href="#custom-nav-home" role="tab" aria-controls="custom-nav-home" aria-selected="true">
                            Update Profile
                        </a>
                        <a class="nav-item nav-link" id="custom-nav-about-tab" data-toggle="tab" href="#custom-nav-about" role="tab" aria-controls="custom-nav-contact" aria-selected="false">
                            Change Password
                        </a>
                    </div>
                </nav>
                <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="custom-nav-home" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                        <form method="post" id="updateForm">
                            <input type="hidden" name="page" value="admin" required="required" readonly="readonly"/>                    
                            <input type="hidden" name="action" value="update" required="required" readonly="readonly"/>                    
                            <input type="hidden" name="unique_id" value="<?=$user->unique_id?>" required="required" readonly="readonly"/>                    
                            
                            <div class="form-group">
                                <label for="user">Username:</label>
                                <input type="text" name="username" class="form-control" required="required" value="<?=$user->username?>"/>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" class="form-control" required="required" value="<?=$user->email?>"/>
                            </div>
                            <div class="form-group">
                                <label for="pass">Password:</label>
                                <input type="password" name="password" class="form-control" required="required"/>
                            </div>
                            <div class="form-group">
                                <input type="submit" id="updateBtn" value="Update Profile" class="btn btn-primary btn-sm"/>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="custom-nav-about" role="tabpanel" aria-labelledby="custom-nav-about-tab">
                        <form method="post" id="changePassForm">
                            <input type="hidden" name="page" value="admin" required="required" readonly="readonly"/>                    
                            <input type="hidden" name="action" value="change_pass" required="required" readonly="readonly"/>                    
                            <input type="hidden" name="unique_id" value="<?=$user->unique_id?>" required="required" readonly="readonly"/>                    
                            
                            <div class="form-group">
                                <label for="cpass">Current Password:</label>
                                <input type="password" name="cpass" class="form-control" required="required"/>
                            </div>
                            <div class="form-group">
                                <label for="password">New Password:</label>
                                <input type="password" name="password" id="password" class="form-control" required="required"/>
                            </div>
                            <div class="form-group">
                                <label for="cnpass">Confirm New Password:</label>
                                <input type="password" name="cnpass" class="form-control" required="required" data-parsley-equalto="#password"/>
                            </div>
                            <div class="form-group">
                                <input type="submit" id="changePassBtn" value="Change Password" class="btn btn-primary btn-sm"/>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
    include_once('includes/admin/footer.php'); 
?>