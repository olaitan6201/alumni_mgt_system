<?php
    global $events; 

    $allevents = $events->fetch_events();
?>

<style>
    th, td{
        padding: 5px;
    }

    [class="col-md-4"]{
        margin-bottom: 10px;
    }
</style>

<div class="container">
    <div class="row">
        <?php
            foreach($allevents as $event) : 
                $today = strtotime(date('Y-m-d'));
                $eventday = strtotime($event->event_date);

                $style = '';

                if($today > $eventday) $style = 'bg-info';
                if($today < $eventday) $style = 'bg-primary';
                if($today === $eventday) $style = 'bg-success';
        ?>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body <?=$style?> text-white">
                    <table >
                        <tr>
                            <th>Event Title</th>
                            <td><?=$event->event_title?></td>
                        </tr>
                        <tr>
                            <th>Event Location</th>
                            <td><?=$event->event_location?></td>
                        </tr>
                        <tr>
                            <th>Event Date</th>
                            <td><?=$event->event_date?></td>
                        </tr>
                        <tr>
                            <th>Event Time</th>
                            <td><?=$event->event_time?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <?php endforeach; ?>
    </div>
</div>