<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/vendor/autoload.php';
/**
 * Send BULK sms
 *
 */

$oMessage = \Nimbuz\Sms\Message::create('YOUR_LOGIN', 'YOUR_PASSWORD');
$oMessage->from ='YourCompany';
$oMessage->to = ['237612345678', '237612345679', '237612345610'];
$oMessage->message ='Hello Kmer World! Déjà vu!';
var_dump($oMessage->sendBulk());

# Send Bulk sms and set callback to save result into the Database
# TO do only if you store the messages in your own database
$hCallback = [
    'path_to_php'  => '/usr/bin/php', // match your running php version. should be >= 7.1.0
    'driver' => [\Nimbuz\Sms\Database\MySQL::class, 'getInstance'],
    'bulk_chunk' => 1,
    'db_config' => [
        [
            'db_name'     => 'test',
            'db_user'     => 'test',
            'db_password' => 'secret',
            'db_host'     => 'localhost',
            'table_sms'   => 'my_table',
        ]
    ],
    'variables' => [
     //Your DB keys => Map camoo keys
        'message'    => 'message',
        'recipient'  => 'to',
        'message_id' => 'message_id',
        'sender'	 => 'from'
    ]
];

$oMessage = \Nimbuz\Sms\Message::create('YOUR_LOGIN', 'YOUR_PASSWORD');
$oMessage->from ='YourCompany';
$oMessage->to = ['237612345678', '237612345679', '237612345610', '...'];
$oMessage->message ='Hello Kmer World! Déjà vu!';
var_dump($oMessage->sendBulk($hCallback));

# Send personalized Bulk SMS
#
$oMessage = \Nimbuz\Sms\Message::create('YOUR_LOGIN', 'YOUR_PASSWORD');
$oMessage->from ='YourCompany';
$oMessage->to = [['name' => 'John Doe', 'mobile' => '237612345678'], ['name' => 'Jeanne Doe', 'mobile' => '237612345679'], ['...']];
$oMessage->message ='Hello %NAME% Kmer World! Déjà vu!';
var_dump($oMessage->sendBulk($hCallback));
// Done!
