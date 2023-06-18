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
        $sql = "INSERT INTO member(id, name, password, email, zipcode, addr1, addr2, photo, create_at, ip) VALUES 
               (:id, :name, :password, :email, :zipcode, :addr1, :addr2, :photo, NOW(), :ip)";
        $stmt = $this->conn->prepare($sql);
        $stmt ->bindParam(':email'   , $marr['email']);
        $stmt ->bindParam(':id'      , $marr['id']);
        $stmt ->bindParam(':name'    , $marr['name']);
        $stmt ->bindParam(':password', $marr['password']);
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
        $sql = "SELECT * FROM member WHERE id = :id AND password=:password";
        $stmt = $this->conn->prepare($sql);
        $stmt ->bindParam(':id', $id);
        $stmt ->bindParam(':password', $pw);
        $stmt ->execute(); // 실행을 해야겠죠

        return $stmt->rowCount() ? true : false; // 만족시크는 row가 하나라도 있으면 ture 고 없으면 false 
    }
}