<?php
require '../vendor/autoload.php';

$ClientID = "426012508710-hpbl4fm3ehnliks53b22ak8qr7fibhto.apps.googleusercontent.com";
$ClientSecret = "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";
$redirect_url = "http://localhost/Google/Login/login.php";

$client = new Google_Client();
$client->setClientId($ClientID);
$client->setClientSecret($ClientSecret);
$client->setRedirectUri($redirect_url);
$client->addScope('profile');
$client->addScope('email');

if (isset($_GET['code'])) {
$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
$client->setAccessToken($token);

$gaouth = new Google_Service_Oauth2($client);
$google_info = $gaouth->userinfo->get();
$email = $google_info->email;
$name = $google_info->name;

echo "<b>Welcome!! </b> ".$name." You are Login using this email ".$email;


} else {
    echo "<a href='" . $client->createAuthUrl() . "'>Login With Google</a>";
}