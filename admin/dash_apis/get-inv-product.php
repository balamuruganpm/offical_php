<?php
session_start();
ob_start();

define('DOC_ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/');
require DOC_ROOT_PATH . "indus_fans/include/config.php";
require DOC_ROOT_PATH . "indus_fans/obj/Action.php";

$obj = new Database();
// $db = $obj->getConnection();

$act = new Action($obj->getConnection());

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $action = $_REQUEST['action'];
    if ($action === 'get-all-inv-product') {
        $smt = $act->select("inv_product_list", "*", " 1  ORDER BY id DESC ");
        while ($row = $smt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        http_response_code(200);
        echo json_encode($data);
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_REQUEST['action'];
    if ($action === 'add-new-inv-prod') {
        $form = $_REQUEST['form'];
        $grp = $form[0]['value'];
        $s_grp = $form[1]['value'];
        $s_s_grp = $form[2]['value'];
        $des = $form[3]['value'];
        $mak = $form[4]['value'];
        $qty = $form[5]['value'];
        $unit = $form[6]['value'];
        $price = $form[7]['value'];
        $_grp = strlen($grp) == 1 ? "0" . $grp : $grp;
        $_s_grp = strlen($s_grp) == 1 ? "0" . $s_grp : $s_grp;
        $_s_s_grp = strlen($s_s_grp) == 1 ? "0" . $s_s_grp : $s_s_grp;
        $smt = $act->select("inv_product_list", "inv_product_id", "inv_product_main_group='$grp' AND inv_product_sub_group=' $s_grp' AND inv_product_s_sub_group=' $s_s_grp' ORDER BY id DESC,inv_product_id DESC LIMIT 1");
        $prv_id;
        $new_id;
        if ($smt->rowCount() > 0) {
            $prv_id = $smt->fetch(PDO::FETCH_ASSOC)['inv_product_id'];
            $new_id = $prv_id + 1;
            $new_id = strlen($new_id) == 10 ? "0" . $new_id : $new_id;
        } else {
            $prv_id = $_grp . $_s_grp . $_s_s_grp . "00000";
            $new_id = $prv_id + 1;
            $new_id = strlen($new_id) == 10 ? "0" . $new_id : $new_id;
        }
        $col = array("inv_product_id", "inv_product_name", "inv_product_make", "inv_product_units", "inv_product_rate", "inv_product_qty", "inv_product_total_qty_purchased", "inv_product_total_qty_issued", "inv_product_main_group", "inv_product_sub_group", "inv_product_s_sub_group");
        $fields = array($new_id, $des, $mak, $unit, $price, $qty, $qty, 0, $grp, $s_grp, $s_s_grp);
        $smt = $act->insert("inv_product_list", $col, $fields);

        if ($smt) {
            http_response_code(201);
            echo json_encode(["status" => "success", "msg" => "New Product has been added to the Inventory List"]);
            exit();
        } else {
            echo json_encode(["status" => "error", "msg" => "Error occured while adding New Product to Inventory List"]);
            exit();
        }
    }
}
