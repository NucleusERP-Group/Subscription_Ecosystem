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

require_once('../vendor/PHPMailer/src/SMTP.php');
require_once('../vendor/PHPMailer/src/PHPMailer.php');
require_once('../vendor/PHPMailer/src/Exception.php');
$mail = new PHPMailer\PHPMailer\PHPMailer();

/* Consume Mailer And Load system settings */
$ret = "SELECT * FROM `NucleusSAASERP_MailSettings` ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($sys = $res->fetch_object()) {
    $mail->setFrom($sys->stmp_sent_from);
    $mail->addAddress($_POST['client_email']);
    $mail->Subject = $_POST['subject'];
    $mail->Body = $_POST['message'];
    $mail->isHTML(true);
    $mail->IsSMTP();
    $mail->SMTPSecure = 'ssl';
    $mail->Host = $sys->stmp_host;
    $mail->SMTPAuth = true;
    $mail->Port = 465;
    $mail->Username = $sys->stmp_username;
    $mail->Password = $sys->stmp_password;
}
