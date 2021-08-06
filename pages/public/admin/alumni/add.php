<?php
    $page_link1='Alumni';
    $page_link2='Add New';

    global $sessions;
    global $posts;
    
    include_once('includes/admin/header.php');
?>
<form id="add_alumni_form">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Add New Alumni</strong>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="postSelect">Post Held</label>
                <select name="post" id="postSelect" class="form-control" required>
                    <option value="">Select . . .</option>
                    <?php foreach($posts->fetch_posts() as $pst) :?>
                        <option value="<?=$pst->unique_id?>"><?=$pst->post_name?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="sessionSelect">Session</label>
                <select name="session" id="sessionSelect" required class="form-control">
                    <?php foreach($sessions->fetch_sessions() as $sss) :?>
                        <option value="<?=$sss->unique_id?>"><?=$sss->session_name?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" required class="form-control"/>
            </div>
            <div class="form-group">
                <label for="nname">P.K.A</label>
                <input type="text" name="nname" id="nname" required class="form-control"/>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required class="form-control"/>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" name="phone" id="phone" required class="form-control"/>
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" name="photo" id="photo" required class="form-control"/>
            </div>
        </div>
        <div class="card-footer text-right">
            <input type="hidden" name="page" value="alumni" required readonly/>
            <input type="hidden" name="action" value="add" required readonly/>
            <input 
                type="submit" 
                value="Submit" 
                name="add_alumni_btn" 
                id="add_alumni_btn"
                class="btn btn-info btn-lg btn-flat"
            >
        </div>
    </div>
</form>
<?php
    include_once('includes/admin/footer.php'); 
?>