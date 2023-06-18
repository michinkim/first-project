<?php
$email = 'ddd@mail.com';

$rs = filter_var($email, FILTER_VALIDATE_EMAIL); //email 유효한지 확인 함수 조건이 맞으면 email을 틀릴때는 false 를 리턴

echo var_dump($rs);