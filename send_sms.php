<?php
$verify = new \MessageBird\Objects\Verify();
$verify->originator = 'YourName';
$verify->recipient = 31123456789;
$result = $client->verify->create($verify);
