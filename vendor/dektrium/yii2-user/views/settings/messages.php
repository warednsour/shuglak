<?php
?>

<h1>Hello from messages</h1>
<div class="col-md-3">
    <?= $this->render('_menu') ?>
</div>
<?php
foreach ($message['message'] as $msg) {
    echo $msg->title . "<br>";
    echo $msg->receiver_id . "<br>";
    echo $msg->sender_id . "<br>";
    echo $msg->text . "<br>";
}

?>

