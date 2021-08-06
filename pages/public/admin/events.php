<?php
    $page_link1='Events';
    $page_link2='Event';
    
    global $events;
    global $uri, $uri2;

    $event = $events->fetch_event($uri2);

    include_once('includes/admin/header.php');
?>
<div class="row">
    <div class="col-md-5">
        <?php if($uri == 'add' or empty($uri) or $uri == 'admin/events') : ?>

        <form id="add_event_form" method="post">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Add Event</strong>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="event_title">Event Title</label>
                        <input type="text" class="form-control" required name="event_title"/>
                    </div>
                    <div class="form-group">
                        <label for="event_date">Event Date</label>
                        <input type="date" class="form-control" required name="event_date"/>
                    </div>
                    <div class="form-group">
                        <label for="event_time">Event Time</label>
                        <input type="time" class="form-control" required name="event_time"/>
                    </div>
                    <div class="form-group">
                        <label for="event_location">Event Location</label>
                        <textarea class="form-control" required name="event_location"></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="hidden" name="page" value="events" required readonly/>
                    <input type="hidden" name="action" value="add" required readonly/>
                    <input type="submit" value="Submit" class="btn btn-info btn-flat btn-block btn-sm" 
                    id="add_event_btn"/>
                </div>
            </div>
        </form>

        <?php elseif($uri == 'edit' && !empty($uri2)) : ?>
        <a href="admin/events/add" role="button" class="btn btn-sm btn-primary">
            <i class="fa fa-plus"></i> Add New
        </a><br><br>
        <form id="edit_event_form" method="post">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Update Event</strong>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="event_title">Event Title</label>
                        <input type="text" class="form-control" required name="event_title" value="<?=$event->event_title?>"/>
                    </div>
                    <div class="form-group">
                        <label for="event_date">Event Date</label>
                        <input type="date" class="form-control" required name="event_date" value="<?=$event->event_date?>"/>
                    </div>
                    <div class="form-group">
                        <label for="event_time">Event Time</label>
                        <input type="time" class="form-control" required name="event_time" value="<?=$event->event_time?>"/>
                    </div>
                    <div class="form-group">
                        <label for="event_location">Event Location</label>
                        <textarea class="form-control" required name="event_location"><?=$event->event_location?></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="hidden" name="page" value="events" required readonly/>
                    <input type="hidden" name="action" value="update" required readonly/>
                    <input type="hidden" name="id" value="<?=$event->unique_id?>" required readonly/>
                    <input type="submit" value="Update" class="btn btn-info btn-flat btn-block btn-sm" 
                    id="edit_event_btn"/>
                </div>
            </div>
        </form>
        <?php endif; ?>

    </div>
    <div class="col-md-7">
        <div class="table-responsive">
            <table class="table table-bordered" id="bootstrap-data-table-export">
                <thead >
                    <tr class="text-center text-uppercase">
                        <th>S/N</th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Event Date</th>
                        <th>Event Time</th>
                        <th>Date Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; foreach($events->fetch_events() as $event) : ?>
                    <tr>
                        <td><?=$i++?></td>
                        <td><?=$event->event_title?></td>
                        <td><?=$event->event_location?></td>
                        <td><?=$event->event_date?></td>
                        <td><?=$event->event_time?></td>
                        <td><?=$event->date_added?></td>
                        <td>
                            <a href="admin/events/edit/<?=$event->unique_id?>" role="button" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <button 
                                class="btn btn-danger btn-sm"
                                data-cols='unique_id'
                                data-vals='<?=$event->unique_id?>'
                                data-page='events'
                                data-action='delete' 
                                id="deleteEvent"
                            >
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </td>
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