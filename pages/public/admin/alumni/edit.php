<?php
    $page_link1='Alumni';
    $page_link2='Update Alumni';
    
    
    global $sessions;
    global $posts;
    global $alumnis;
    global $uri;
    
    include_once('includes/admin/header.php');

    $alumni = $alumnis->fetch_alumni($uri);
    $session = $sessions->fetch_session($alumni->session);
    $post = $posts->fetch_post($alumni->post);
?>
<form id="update_alumni_form">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Edit Alumni Info</strong>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="postSelect">Post Held</label>
                <select name="post" id="postSelect" class="form-control" required>
                    <option value="<?=$post->unique_id?>"><?=$post->post_name?></option>
                    <?php foreach($posts->fetch_posts() as $pst) :?>
                        <option value="<?=$pst->unique_id?>"><?=$pst->post_name?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="sessionSelect">Session</label>
                <select name="session" id="sessionSelect" required class="form-control">
                        <option value="<?=$session->unique_id?>"><?=$session->session_name?></option>
                    <?php foreach($sessions->fetch_sessions() as $sss) :?>
                        <option value="<?=$sss->unique_id?>"><?=$sss->session_name?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" required class="form-control" value="<?=$alumni->name?>"/>
            </div>
            <div class="form-group">
                <label for="nname">P.K.A</label>
                <input type="text" name="nname" id="nname" required class="form-control" value="<?=$alumni->nname?>"/>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required class="form-control" value="<?=$alumni->email?>"/>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" name="phone" id="phone" required class="form-control" value="<?=$alumni->phone?>"/>
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" name="photo" id="photo" class="form-control"/>
            </div>
            <div class="form-group">
                <img src="uploads/<?=$alumni->photo?>" alt="">
            </div>
        </div>
        <div class="card-footer text-right">
            <input type="hidden" name="page" value="alumni" required readonly/>
            <input type="hidden" name="action" value="update" required readonly/>
            <input type="hidden" name="id" value="<?=$alumni->unique_id?>" required readonly/>
            <input 
                type="submit" 
                value="Update" 
                name="update_alumni_btn" 
                id="update_alumni_btn"
                class="btn btn-info btn-lg btn-flat"
            >
        </div>
    </div>
</form>
<?php
    include_once('includes/admin/footer.php'); 
?>