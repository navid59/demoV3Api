<?php 
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('classes/log.php');
include_once('../lib/verifyAuth.php');


include_once __DIR__ . '/vendor/autoload.php';
/**
 * Load .env 
 * Read Base root , ... from .env
 * The  env var using in UI ,..
 */

// $dotenv = new Dotenv\Dotenv(__DIR__);
// $dotenv->load();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/**
 * if Session is expired
 * redirect to 404
 * */ 
// if(count($_SESSION) == 0 || !isset($_SESSION)) {
//     $url = $_ENV['PROJECT_SERVER_ADDRESS'].$_ENV['PROJECT_BASE_ROOT'].$_ENV['PROJECT_404_PAGE'];
//     header("Location: $url");
//     exit;
// }

/**
 * Define verifyAuth class
 * Set the parameters
 * the "apiKey","isLive" can be set static or read from DB, File, ...
 * you have the "authenticationToken","ntpID" from response of start action 
 */
$verifyAuth = new VerifyAuth();
$verifyAuth->apiKey              = 'Uxf3OY--rDK3Qae8CiJJUlAcuRJFp7tzGY4M8KocQaCGyfEqUGhGskv0'; // Valid Api cod - Oct 2021
// if(isset($_SESSION['authenticationToken'])) {
//     $verifyAuth->authenticationToken = $_SESSION['authenticationToken'];
// }

$verifyAuth->authenticationToken = isset($_SESSION['authenticationToken']) ? $_SESSION['authenticationToken'] : null;
$verifyAuth->ntpID = isset($_SESSION['ntpID']) ? $_SESSION['ntpID'] : null;

$verifyAuth->paRes               = $_POST['paRes'];
$verifyAuth->isLive              = false;


/**
 * Set params for /payment/card/verify-auth
 * @return 
 * - a Json string
 */
$jsonAuthParam = $verifyAuth->setVerifyAuth();


/**
 * Send request to /payment/card/verify-auth
 */
$paymentResult = $verifyAuth->sendRequestVerifyAuth($jsonAuthParam);
$paymentResultArr = json_decode($paymentResult);

?>
<!doctype html>
<html lang="en">
    <?php include_once("theme/inc/header.inc"); ?>
    <body class="bg-light">
        <div class="container">
            <?php include_once("theme/inc/topNav.inc"); ?>
            <div class="row">
                <?php include_once("theme/backAuthForm.php"); ?>
            </div>
        </div>
        <?php include_once("theme/inc/footer.inc"); ?>
    </body>
</html>
