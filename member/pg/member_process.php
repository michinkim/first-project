<?php

include '../inc/dbconfig.php';
include '../inc/member.php';  //Member Class 정의된 파일

$mem = new Member($db);

$id        = (isset($_POST['id'      ]) && $_POST['id'      ] != '') ? $_POST['id'      ] :''; // 아이디가 세팅이 되어 있으면서 아이디가 비워있지 않는 경우에 아이디를 넣어주고 아니면 빈걸로 처리해라
$email     = (isset($_POST['email'   ]) && $_POST['email'   ] != '') ? $_POST['email'   ] :'';
$name      = (isset($_POST['name'    ]) && $_POST['name'    ] != '') ? $_POST['name'    ] :'';
$password  = (isset($_POST['password']) && $_POST['password'] != '') ? $_POST['password'] :'';
$zipcode   = (isset($_POST['zipcode' ]) && $_POST['zipcode' ] != '') ? $_POST['zipcode' ] :'';
$addr1     = (isset($_POST['addr1'   ]) && $_POST['addr1'   ] != '') ? $_POST['addr1'   ] :'';
$addr2     = (isset($_POST['addr2'   ]) && $_POST['addr2'   ] != '') ? $_POST['addr2'   ] :'';
$mode      = (isset($_POST['mode'    ]) && $_POST['mode'    ] != '') ? $_POST['mode'    ] :'';
// print_r($_POST);

// 아이디 중복체크 
if($mode == 'id_chk') {

    if($id == '') {
        die(json_encode(['result' => 'empty_id'])); 
    }

    if($mem->id_exists($id)) {
        // echo '아이디가 중복됨';
        // $arr = ['result' => 'fail']; // php 배열
        // $json = json_encode($arr); // json 인코더를 만나서 json 타입으로 바뀌는거죠 { "result" : "fail" }
        // die($json);
        // exit($json); 이걸로 사용해도 무방

        // 위를 줄여서 이걸로도 가능하다
        die(json_encode(['result' => 'fail'])); 
    } else {
        die(json_encode(['result' => 'success'])); 
    }

// 이메일 중복확인
} else if($mode == 'email_chk') {
    if($email == '') {
        die(json_encode(['result' => 'empty_email'])); 
    }

// 이메일 형식체크
    if($mem->email_format_check($email) == false) {
        die(json_encode(['result' => 'empty_format_wrong'])); 
    }

    if($mem->email_exists($email)) {
        die(json_encode(['result' => 'fail'])); 
    } else {
        die(json_encode(['result' => 'success'])); 
    }
} else if ($mode == 'input') {   //회원가입폼에서 전송한 데이터를 등록시키는 부분

    // profile Image 처리
    $tmparr = explode('.', $_FILES['photo']['name']); // ['2','jpg'] 이단계는 이런 배열이 만들어 지겠죠  여기서 end 함수를 사용하면 마지막 확장자만 가지고 오겠죠 <--이렇게 하니  https://blog.naver.com/mikong22/220755134678 오류남 그래서 배열분리함
    $ext = end($tmparr);
    $photo = $id.'.'.$ext; // 1.jpg    프로필로 사용될 img라 아이디값과 .확장자로 구분한다

    copy($_FILES['photo']['tmp_name'], "../data/profile/". $photo);

        
    // Array
    // (
    //     [photo] => Array
    //         (
    //             [name] => KakaoTalk_20210614_202139356_02.jpg
    //             [type] => image/jpeg
    //             [tmp_name] => E:\XAMPP\tmp\phpD655.tmp
    //             [error] => 0
    //             [size] => 568131
    //         )

    // )
    
    $arr = [
        'id' => $id,
        'email' => $email,
        'password' => $password,
        'name' => $name,
        'zipcode' => $zipcode,
        'addr1' => $addr1,
        'addr2' => $addr2,
        'photo' => $photo
    ];

    $mem->input($arr); //mem함수에 인스턴스에 input 함수로 

    //가입이 완료되고 나면 가입이 완료되었다 안내해 줘야겠죠
    echo "
    <script>
        self.location.href='../member_success.php'
    </script>
    ";
}



