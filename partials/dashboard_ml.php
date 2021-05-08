<?php
/*
 * Created on Sat May 08 2021
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

$id = $_SESSION['id'];
$ret = "SELECT * FROM `NucleusSAASERP_Users` WHERE id = '$id'  ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($client = $res->fetch_object()) {
    /* Time Greetings */
    $time = date("H");
    /* If the time is less than 1200 hours, show good morning */
    if ($time < "12") {
        $Greeting = 'Good Morning';
        $Greeting1 = 'Have A Nice Day!';
    } else
        /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
        if ($time >= "12" && $time < "17") {
            $Greeting = 'Good Afternoon';
            $Greeting1 = 'Have A Nice Afternoon!';
        } else
            /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
            if ($time >= "17" && $time < "19") {
                $Greeting = 'Good Evening';
                $Greeting1 = 'Have A Nice Evening!';
            } else
                /* Finally, show good night if the time is greater than or equal to 1900 hours */
                if ($time >= "19") {
                    $Greeting = 'Good Night';
                    $Greeting1 = 'Have A Nice Night!';
                }
?>
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-6 mb-3 mb-md-0">
                <h5 class="h3 font-weight-400 mb-0 text-white"><?php echo $Greeting . "! " . $client->name; ?> </h5>
                <span class="text-sm text-white opacity-8"><?php echo $Greeting1; ?> </span>
            </div>
        </div>
    </div>

<?php } ?>