<?php
session_start();
ob_start();


define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/');
require DOC_ROOT_PATH . "indus_fans/include/config.php";
require DOC_ROOT_PATH . "indus_fans/obj/Action.php";

$obj = new Database();
// $db = $obj->getConnection();

$act = new Action($obj->getConnection());
$action = $_REQUEST['action'];

if ($action == 'get-main-grp') {

    $smt = $act->select('inv_main_group', '*', '1 ORDER BY main_grp_name ASC ');
    while ($row = $smt->fetch(PDO::FETCH_ASSOC)) {
        $main_grp[] = array(
            'grp_id' => $row['main_grp_id'],
            'grp_name' => $row['main_grp_name']
        );
    }
    echo json_encode($main_grp);
}
if ($action == 'get-sub-grp') {
    $main_grp_id = $_REQUEST['grp_id'];
    $smt = $act->select('inv_sub_group', '*', " main_grp_id='" . $main_grp_id . "' ORDER BY sub_group_name ASC ");
    while ($row = $smt->fetch(PDO::FETCH_ASSOC)) {
        $sub_grp[] = array(
            'grp_id' => $row['sub_group_id'],
            'grp_name' => $row['sub_group_name']
        );
    }
    echo json_encode($sub_grp);
}
if ($action == 'get-ssub-grp') {
    $grp_id = $_REQUEST['grp_id'];
    $s_grp_id = $_REQUEST['s_grp_id'];
    $smt = $act->select('inv_s_sub_group', '*', " sub_group_id='" . $s_grp_id . "' AND main_grp_id='" . $grp_id . "' ORDER BY s_sub_group_name ASC ");
    while ($row = $smt->fetch(PDO::FETCH_ASSOC)) {
        $s_sub_grp[] = array(
            'grp_id' => $row['s_sub_group_id'],
            'grp_name' => $row['s_sub_group_name']
        );
    }
    echo json_encode($s_sub_grp);
}
