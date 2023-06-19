<?php

$id = (isset($_POST['id']) && $_POST['id'] != '') ? $_POST['id'] : '';  // POST로 넘어오면서 아이디가 세팅이 되어 있으면서 아이디가 비어있지 않으면 아이디를 넣어주고 아니면 비어준다
$pw = (isset($_POST['pw']) && $_POST['pw'] != '') ? $_POST['pw'] : ''; 

if($id == '') {
    $arr = ['result' => 'empty_id'];
    die(json_encode($arr)); // { "result" => "empty_id" } 이렇게 보여지는거죠
}
// 암호화 된거는 복호화는 할수없고 비교를 할수있다 
if($pw == '') {
    $arr = ['result' => 'empty_pw'];
    die(json_encode($arr)); // { "result" => "empty_id" } 이렇게 보여지는거죠
}

include '../inc/dbconfig.php'; // DB 접속
include '../inc/member.php';  //Member Class 정의된 파일

$mem = new Member($db); // 인스턴스를 하나 생성
if ($mem -> login($id, $pw)) {
    $arr = ['result' => 'login_success'] ;

    //로그인이 성공하면 세션을 생성해 줘야 합니다
    session_start();
    $_SESSION['ses_id'] = $id ;

}else {
   $arr = ['result' => 'login_fail'];
} 

die(json_encode($arr));
