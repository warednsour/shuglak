<?php
Yii::setAlias("@uploads" , 'localhost/web/uploads');
Yii::setAlias("@dektrium", 'localhost/web/vendor/dektrium');

return [
    'bsVersion' => '4.x', // this will set globally `bsVersion` to Bootstrap 4.x for all Krajee Extensions
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
];
