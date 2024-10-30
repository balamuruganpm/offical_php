<?php

define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/');
require DOC_ROOT_PATH . "indus_fans/include/config.php";

$conn = new Database();
$db = $conn->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $action = $_REQUEST['action'];
    if ($action === 'get-admin-users') {
        $sql = "SELECT * FROM admin_user a,admin_roles b WHERE a.admin_role=b.admin_role_id";
        $smt = $db->query($sql);
        while ($row = $smt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        http_response_code(200);
        echo json_encode($data);
    }
    if ($action === 'edit-admin-user') {
        $sql = "SELECT * FROM admin_user a,admin_roles b WHERE a.admin_role=b.admin_role_id AND a.id='$_REQUEST[id]' ";
        $smt = $db->query($sql);
        while ($row = $smt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        // admin_password	"e10adc3949ba59abbe56e057f20f883e"
        // $data[0]['admin_password']
        http_response_code(200);
        echo json_encode($data);
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_REQUEST['action'];
    if ($action === 'statusChange') {
        $status = $_REQUEST['_status'];
        $id = $_REQUEST['_id'];
        $sql = " UPDATE `admin_user` SET `status` = '$status' WHERE `admin_user`.`id` ='$id' ";
        $smt = $db->query($sql);
        if ($smt) {
            http_response_code(200);
            echo json_encode(['id' => $id, 'status' => $status]);
        }
    }
    if ($action === 'add-new-user') {
        $form = $_REQUEST['form'];
        $name = $form[0]['value'];
        $email = $form[1]['value'];
        $pass = $form[2]['value'];
        $pass = md5($pass);
        $role = $form[3]['value'];
        $sql = "SELECT * FROM admin_user WHERE admin_email='$email'";
        $smt = $db->query($sql);
        if ($smt->rowCount() > 0) {
            echo json_encode(['status' => "Fail", 'msg' => 'mail-Id already exist']);
            exit();
        }
        $sql = "INSERT INTO admin_user (admin_name,admin_email,admin_password,admin_role,status) VALUES('$name','$email','$pass','$role','1') ";
        $smt = $db->query($sql);
        if ($smt) {
            echo json_encode(['status' => "Success", 'msg' => 'User Added Successfully']);
            exit();
        }

        echo json_encode(['status' => "Error", 'msg' => 'Unable to add User']);
    }
    if ($action === 'edit-user') {
        $form = $_REQUEST['form'];
        $name = $form[0]['value'];
        $email = $form[1]['value'];
        $pass = $form[2]['value'];
        $pass = $pass != "" ? md5($pass) : $form[3]['value'];
        $role = $form[4]['value'];
        $id = $form[5]['value'];
        $sql = " SELECT * FROM admin_user WHERE admin_email='$email' AND id !='$id' ";
        $smt = $db->query($sql);
        if ($smt->rowCount() > 0) {
            echo json_encode(['status' => "Fail", 'msg' => 'mail-Id already exist']);
            exit();
        }
        $sql = "UPDATE admin_user SET admin_name='$name', admin_email='$email', admin_password='$pass', admin_role='$role' WHERE id='$id' ";
        $smt = $db->query($sql);
        if ($smt) {
            echo json_encode(['status' => "Success", 'msg' => 'User Editted Successfully']);
            exit();
        }

        echo json_encode(['status' => "Error", 'msg' => 'Unable to edit User']);
    }
}
