<?php
    $page_link1='Posts';
    $page_link2='Posts';
    global $posts;
    include_once('includes/admin/header.php');
?>
<div class="row">
    <div class="col-md-5">
        <form id="add_post_form" method="post">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Add Post</strong>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Post Name</label>
                        <input type="text" class="form-control" required name="name"/>
                    </div>
                    <div class="form-group">
                        <label for="descr">Post Description</label>
                        <textarea class="form-control" required name="descr"></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="hidden" name="page" value="post" required readonly/>
                    <input type="hidden" name="action" value="add" required readonly/>
                    <input type="submit" value="Submit" class="btn btn-info btn-flat btn-block btn-sm" 
                    id="add_post_btn"/>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-7">
        <div class="table-responsive">
            <table class="table table-bordered" id="bootstrap-data-table-export">
                <thead >
                    <tr class="text-center text-uppercase">
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Date Added</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach($posts->fetch_posts() as $post) : ?>
                    <tr>
                        <td><?=$i++?></td>
                        <td><?=$post->post_name?></td>
                        <td><?=$post->post_desc?></td>
                        <td><?=$post->date_added?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
    include_once('includes/admin/footer.php'); 
?>