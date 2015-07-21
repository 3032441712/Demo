<?php
require_once(dirname(__DIR__).DIRECTORY_SEPARATOR.'Db'.DIRECTORY_SEPARATOR.'Local.php');

// 红包ID
$bonus_id = isset($_POST['bonus_id']) ? $_POST['bonus_id'] : 0;
// 用户ID
$uid = isset($_POST['uid']) ? $_POST['uid'] : 0;

try {
    Local::beginTransaction();

    $userBonus = Local::fetchOne('SELECT * FROM `user_bonus` WHERE user_id=:user_id AND bonus_id=:bonus_id LIMIT 1', [':user_id' => $uid, ':bonus_id' => $bonus_id]);
    if (isset($userBonus['id']) == false || $userBonus['status'] == 1) {
        throw new Exception('红包已经使用或者不存在.', 100);
    }

    // 插入订单表
    Local::exec('INSERT INTO orders(uid,bonus_id) VALUES ("'.$uid.'","'.$bonus_id.'")');

    // 更新红包的使用状态
    if (Local::exec('UPDATE user_bonus SET status = 1, version=version+1 WHERE id=:id AND version=:version', [':id' => $userBonus['id'], ':version' => $userBonus['version']]) == false) {
        throw new Exception('系统异常,请重试.', 200);
    }

    Local::commit();

    echo '{"code":"0","message":"订单生成成功"}';
} catch (Exception $e) {
    Local::rollBack();
    echo '{"code":"'.$e->getCode().'","message":"'.$e->getMessage().'"}';
}

