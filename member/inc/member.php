<?php
//Member Class file


class Member {
    // 멤버 변수, 프로퍼티
    private $conn;

    // 생성자
    public function __construct($db) {
        $this->conn = $db;
    }

    // 아이디 중복체크용 멤버 함수, 메소드
    public function id_exists($id) {
        $sql = "SELECT * FROM member WHERE id=:id";
        // $stmt = $this->conn->prepare($sql);
        $stmt = $this->conn->prepare($sql);
        $stmt ->bindParam(':id', $id);
        $stmt ->execute();

        return $stmt->rowCount() ? true : false;
    }

    // email 형식 체크
    public function email_format_check($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL); // 이메일이 받이지면 통과 아니면 flase가 리턴되면 알림창 등록하게
    }

    // email 중복체크용 멤버 함수, 메소드
    public function email_exists($email) {
        $sql = "SELECT * FROM member WHERE email=:email";
        // $stmt = $this->conn->prepare($sql);
        $stmt = $this->conn->prepare($sql);
        $stmt ->bindParam(':email', $email);
        $stmt ->execute();

        return $stmt->rowCount() ? true : false;
    }

    // 회원정보 입력 - 배열형태로 방식으로 진행
    public function input($marr) {

        // password 단방향 암호화 
        $new_hash_password = password_hash($marr['password'], PASSWORD_DEFAULT); // 암호화될 대상을 넣고 암호화 방식을 정한다 암호화된 해수 코드값이 된다

        $sql = "INSERT INTO member(id, name, password, email, zipcode, addr1, addr2, photo, create_at, ip) VALUES 
               (:id, :name, :password, :email, :zipcode, :addr1, :addr2, :photo, NOW(), :ip)";
        $stmt = $this->conn->prepare($sql);
        $stmt ->bindParam(':email'   , $marr['email']);
        $stmt ->bindParam(':id'      , $marr['id']);
        $stmt ->bindParam(':name'    , $marr['name']);
        $stmt ->bindParam(':password', $new_hash_password); // 암호화되서 DB에 저장이 된다
        $stmt ->bindParam(':email'   , $marr['email']);
        $stmt ->bindParam(':zipcode' , $marr['zipcode']);
        $stmt ->bindParam(':addr1'   , $marr['addr1']);
        $stmt ->bindParam(':addr2'   , $marr['addr2']);
        $stmt ->bindParam(':photo'   , $marr['photo']);
        $stmt ->bindParam(':ip'      , $_SERVER['REMOTE_ADDR']);
        $stmt ->execute();

    }

    //로그인 - $id $pw 인자를 2개 받는 방식으로 진행
    public function login($id, $pw) {

        // password_verify($password, $new_password)
        
        // 패스워드 단방향 암호화 후 코드
        $sql = "SELECT password FROM member WHERE id = :id"; // 아이디 비번을 동시에 체크할수 없기때문에 일단 아이디를 체크해서
        $stmt = $this->conn->prepare($sql);
        $stmt ->bindParam(':id', $id);
        $stmt ->execute(); // 실행을 해야겠죠

        //아이디가 없으면 false가 아니면 그때부터 패스워드가 일치하는지 비교 들어간다
        if($stmt->rowCount())        { // 아이디가 존재하지 않을수 있으니까 확인하기 위해서 
            $row = $stmt ->fetch(); // fetch 해서 가지고 오고 그 값을 담는다

            if ( password_verify($pw, $row['password'])) { // 입력한 패스워드를 넣고 DB에 저장되어 있는 패스워드를 비교 / DB에 있는 해싱된 패스워드를 두번째 인자로 넣고 로그인 폼에서 들어온 패스워드를 첫번째 인자로 넣어서
                return true; //로그인 성공
            }   else { 
                return  false; //로그인 실패
            }
        } else {
            return  false; //아이디가 없으면 false
        }
     
        // password 단반향 암호화 전코드
        // $sql = "SELECT * FROM member WHERE id = :id AND password=:password";
        // $stmt = $this->conn->prepare($sql);
        // $stmt ->bindParam(':id', $id);
        // $stmt ->bindParam(':password', $pw);
        // $stmt ->execute(); // 실행을 해야겠죠

        // return $stmt->rowCount() ? true : false; // 만족시크는 row가 하나라도 있으면 ture 고 없으면 false 

        // return $stmt->rowCount() ? true : false; // 만족시크는 row가 하나라도 있으면 ture 고 없으면 false  
    }
}