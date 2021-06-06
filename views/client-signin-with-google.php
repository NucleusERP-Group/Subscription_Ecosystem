<?php
/*
 * Created on Mon May 10 2021
 *
 * The MIT License (MIT)
 * Copyright (c) 2021 MartDevelopers Inc
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
 * TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

require_once('../config/oauth_client.php');
require_once('../config/http.php');
require_once('../config/codeGen.php');
require_once('../config/google_config.php');

$client = new oauth_client_class;

// set the offline access only if you need to call an API
// when the user is not present and the token may expire
$client->offline = TRUE;
$client->debug = false;
$client->debug_http = true;
$client->redirect_uri = REDIRECT_URL;

/* Find this on Configs/config.php file */
$client->client_id = CLIENT_ID;
$application_line = __LINE__;
$client->client_secret = CLIENT_SECRET;

if (strlen($client->client_id) == 0 || strlen($client->client_secret) == 0)
    die('Please go to Google APIs console page ' .
        'http://code.google.com/apis/console in the API access tab, ' .
        'create a new client ID, and in the line ' . $application_line .
        ' set the client_id to Client ID and client_secret with Client Secret. ' .
        'The callback URL must be ' . $client->redirect_uri . ' but make sure ' .
        'the domain is valid and can be resolved by a public DNS.');

/* API permissions
 */
$client->scope = SCOPE;
if (($success = $client->Initialize())) {
    if (($success = $client->Process())) {
        if (strlen($client->authorization_error)) {
            $client->error = $client->authorization_error;
            $success = false;
        } elseif (strlen($client->access_token)) {
            $success = $client->CallAPI(
                'https://www.googleapis.com/oauth2/v1/userinfo',
                'GET',
                array(),
                array('FailOnAccessError' => true),
                $user
            );
        }
    }
    $success = $client->Finalize($success);
}
if ($client->exit)
    exit;
if ($success) {
    /* Check If That User Already Exists In Your Database */
    $sql = "SELECT COUNT(*) AS count from NucleusSAASERP_Users where email = :email_id";
    try {
        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":email_id", $user->email);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if ($result[0]["count"] > 0) {
            /* If User Exists */
            $_SESSION["name"] = $user->name;
            $_SESSION["email"] = $user->email;
            $_SESSION["new_user"] = "no";
        } else {
            // Insert New User In Database
            $sql = "INSERT INTO `NucleusSAASERP_Users` (`id`, `name`, `email`) VALUES " . "(:id, :name, :email)";
            $stmt = $DB->prepare($sql);
            $stmt->bindValue(":id", $ID);
            $stmt->bindValue(":name", $user->name);
            $stmt->bindValue(":email", $user->email);
            $stmt->execute();
            $result = $stmt->rowCount();
            if ($result > 0) {
                $_SESSION["name"] = $user->name;
                $_SESSION["email"] = $user->email;
                $_SESSION["new_user"] = "yes";
                $_SESSION["e_msg"] = "";
            }
        }
    } catch (Exception $ex) {
        $_SESSION["e_msg"] = $ex->getMessage();
    }

    $_SESSION["id"] = $user->id;
} else {
    $_SESSION["e_msg"] = $client->error;
}
header("location:client-dashboard");
exit;
