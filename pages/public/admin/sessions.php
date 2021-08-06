<?php
    $page_link1='Sessions';
    $page_link2='Sessions';
    global $sessions;
    include_once('includes/admin/header.php');
?>
<div class="row">
    <div class="col-md-5">
        <form id="add_session_form" method="post">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Add Session</strong>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Session Name</label>
                        <input type="text" class="form-control" required name="name"/>
                    </div>
                    <div class="form-group">
                        <label for="descr">Session Description</label>
                        <textarea class="form-control" required name="descr"></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="hidden" name="page" value="session" required readonly/>
                    <input type="hidden" name="action" value="add" required readonly/>
                    <input type="submit" value="Submit" class="btn btn-info btn-flat btn-block btn-sm" 
                    id="add_session_btn"/>
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
                    <?php $i = 1; foreach($sessions->fetch_sessions() as $session) : ?>
                    <tr>
                        <td><?=$i++?></td>
                        <td><?=$session->session_name?></td>
                        <td><?=$session->session_desc?></td>
                        <td><?=$session->date_added?></td>
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