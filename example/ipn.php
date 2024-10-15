<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('classes/log.php');
include_once('../lib/ipn.php');

require_once 'vendor/autoload.php';


// Log
$setRealTimeLog = ["IPN"    =>  "IPN Is hitting"];
log::setRealTimeLog($setRealTimeLog);
log::logHeader();

/**
 * get defined keys
 */
$ntpIpn = new IPN();

$ntpIpn->activeKey         = 'LXTP-3WDM-WVXL-GC8B-Y5DA';        // activeKey or posSignature
$ntpIpn->posSignatureSet[] = 'LXTP-3WDM-WVXL-GC8B-Y5DA';        // The active key should be in posSignatureSet as well
$ntpIpn->posSignatureSet[] = 'EEEE-AAAA-BBBB-CCCC-DDDD';
$ntpIpn->posSignatureSet[] = 'FFFF-DDDD-AAAA-BBBB-CCCC'; 
$ntpIpn->posSignatureSet[] = 'DDDD-FFFF-EEEE-AAAA-BBBB'; 
$ntpIpn->posSignatureSet[] = 'FFFF-GGGG-HHHH-EEEE-AAAA';
$ntpIpn->hashMethod        = 'SHA512';
$ntpIpn->alg               = 'RS512';

$ntpIpn->publicKeyStr = "-----BEGIN PUBLIC KEY-----\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAy6pUDAFLVul4y499gz1P\ngGSvTSc82U3/ih3e5FDUs/F0Jvfzc4cew8TrBDrw7Y+AYZS37D2i+Xi5nYpzQpu7\nryS4W+qvgAA1SEjiU1Sk2a4+A1HeH+vfZo0gDrIYTh2NSAQnDSDxk5T475ukSSwX\nL9tYwO6CpdAv3BtpMT5YhyS3ipgPEnGIQKXjh8GMgLSmRFbgoCTRWlCvu7XOg94N\nfS8l4it2qrEldU8VEdfPDfFLlxl3lUoLEmCncCjmF1wRVtk4cNu+WtWQ4mBgxpt0\ntX2aJkqp4PV3o5kI4bqHq/MS7HVJ7yxtj/p8kawlVYipGsQj3ypgltQ3bnYV/LRq\n8QIDAQAB\n-----END PUBLIC KEY-----\n";

$ipnResponse = $ntpIpn->verifyIPN();


/**
 * IPN Output
 */
echo json_encode($ipnResponse);