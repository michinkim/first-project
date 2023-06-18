document.addEventListener("DOMContentLoaded", () => {
    const btn_login = document.querySelector("#btn_login")
    btn_login.addEventListener("click", () => {
        const f_id = document.querySelector("#f_id")
        if(f_id.value == '') {
            alert("아이디를 입력해주세요")
            f_id.focus()
            return false
        }
        const f_pw = document.querySelector("#f_pw")
        if(f_pw.value == '') {
            alert("비밀번호를  입력해주세요")
            f_pw.focus()
            return false
        }

        // Ajax 에이젝스, 아작스 방식으로 처리
        const xhr = new XMLHttpRequest()
        xhr.open('POST', "./pg/login_process.php", "true") //비동기 방식 true

        // 포스트 방식으로 전달되기에 폼객체가 필요합니다.
        const f1 = new FormData()
        f1.append("id", f_id.value)
        f1.append("pw", f_pw.value)

        xhr.send(f1)

        xhr.onload = () => {
           if (xhr.status == 200) {

            const data = JSON.parse(xhr.responseText);
            // console.log(data)  JSON 방식으로 넘어오는거 확인하는방법 개발자모드에서 콘솔에서 확인
            if(data.result == 'login_fail') {
                alert("해당 정보는 존재하지 않습니다.")
                f_id.value = ''
                f_pw.value = ''
                f_id.focus()
                return false
            } else if(data.result == 'login_success') {
                alert('로그인에 성공했습니다.')
                self.location.href='./member.php' //로그인이 성공했을때 이동하는 URI
            }

           } else {
            alert("통신에 실패했습니다. 다음에 다시 시도해 주시기 바랍니다.")
           }
        }
        
    })
}) 