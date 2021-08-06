<?php
    $page_link1='Speech';
    $page_link2='Add Speech';

    global $posts;
    global $sessions;

    include_once('includes/admin/header.php');
?>
<div class="col-md-12">
    <form id="add_speech_form" method="post">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Add Speech</strong>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="postSelect">Speaker's Post</label>
                    <select name="post" id="postSelect" required class="form-control">
                        <option value=""></option>
                        <?php foreach($posts->fetch_posts() as $pst) :?>
                            <option value="<?=$pst->unique_id?>"><?=$pst->post_name?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sessionSelect">Session</label>
                    <select name="session" id="sessionSelect" required class="form-control">
                        <option value=""></option>
                        <?php foreach($sessions->fetch_sessions() as $sss) :?>
                            <option value="<?=$sss->unique_id?>"><?=$sss->session_name?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="summernote2">SPEECH</label>
                    <textarea id="summernote2" class="form-control" required name="text"></textarea>
                </div>
            </div>
            <div class="card-footer">
                <input type="hidden" name="page" value="alumni" required readonly/>
                <input type="hidden" name="action" value="add_speech" required readonly/>
                <input type="submit" value="Submit" class="btn btn-info btn-flat btn-block btn-sm" 
                id="add_speech_btn"/>
            </div>
        </div>
    </form>
</div>
<?php
    include_once('includes/admin/footer.php'); 
?>