<?php
  session_start();
  require_once 'vendor/autoload.php';

  Facebook\FacebookSession::setDefaultApplication('1439384579405895', '9b639ce84a506ccf36c1323e5241bf90');
  $facebook = new Facebook\FacebookRedirectLoginHelper('your url');

  try {
   if($session = $facebook->getSessionFromRedirect()) {
    $_SESSION['facebook'] = $session->getToken();
    header('Location index.php');
   }

   if(isset($_SESSION['facebook'])) {
    $session = new Facebook\FacebookSession($_SESSION['facebook']);
    $request = new Facebook\FacebookRequest($session, 'GET', '/me');
    $request = $request->execute();
    $user = $request->getGraphObject()->asArray();
   }

  } catch(Facebook\FacebookRequestException $e) {
   // если facebook вернул ошибку
  } catch(\Exception $e) {
   // Локальная ошибка
  }
?>
