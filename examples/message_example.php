<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/vendor/autoload.php';
/**
 * Send a sms
 */
$oMessage = \Nimbuz\Sms\Message::create('YOUR_LOGIN', 'YOUR_PASSWORD');
$oMessage->from ='YourCompany';
$oMessage->to = '+237612345678';
$oMessage->reference = 'api' . time();
$oMessage->message ='Hello Kmer World! Déjà vu!';

// SEND message with all chars (unicode à 70 instead of 160)
//$oMessage->message ='Hello Kmer World! Déjà vu! ça et la on fait la fête';
//$oMessage->datacoding = 'unicode';

$response = $oMessage->send();
var_dump($response);

// Result
/**
 class Nimbuz\Sms\Response\Message#5 (3) {
  private $statusCode =>
  int(200)
  private $content =>
  string(71) "{"id":"166156285966156285","ext_id":"api1608802712","nbre_sms":1,"solde":5859}"
  protected $data =>
  array(5) {
    'status' =>
    string(2) "OK"
    'id' =>
    string(24) "166156285966156285"
    'ext_id' =>
    string(13) "api1608802712"
    'nbre_sms' =>
    int(1)
    'solde' =>
    int(5859)
  }
 }
 */

// Get Message ID
var_dump($response->getId());
// 166156285966156285
