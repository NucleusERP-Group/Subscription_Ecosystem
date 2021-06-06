<?php
/*
 * Created on Tue May 11 2021
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

require_once('../config/config.php');
$no = $_POST['getresult'];
$id = $_SESSION['id'];
$email = $_SESSION['email'];

$ret = "SELECT * FROM `NucleusSAASERP_UserNotifications` WHERE client_id = '$id' OR client_email = '$email'  ORDER BY `NucleusSAASERP_UserNotifications`.`created_at` DESC LIMIT $no, 5 ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($notif = $res->fetch_object()) {
?>
    <a href="#clear-notification-<?php echo $notif->id; ?>" data-toggle="modal" class="list-group-item list-group-item-action">
        <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="<?php echo date('d M Y g:ia', strtotime($notif->created_at)); ?>">
            <div>
                <span class="avatar bg-primary text-white rounded-circle">
                    <?php echo substr($notif->notification_from, 0, 4); ?>
                </span>
            </div>

            <div class="flex-fill ml-3">
                <div class="h6 text-sm mb-0"><?php echo $notif->notification_from; ?> <small class="float-right text-muted"><?php echo date('d M Y g:ia', strtotime($notif->created_at)); ?></small></div>
                <p class="text-sm lh-140 mb-0">
                    <?php echo $notif->notification_details; ?>
                </p>
            </div>
        </div>
    </a>
    <!-- Confirm Clear -->
    <div class="modal fade" id="clear-notification-<?php echo $notif->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center text-danger">
                    <h4>Clear Notification ?</h4>
                    <br>
                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                    <a href="client-notifications?clear_notification=<?php echo $notif->id; ?>" class="text-center btn btn-danger"> Clear Notification </a>
                </div>
            </div>
        </div>
    </div>
<?php
} ?>