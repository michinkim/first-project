// 돔이 다 실행이 되고나면 아랫쪽을 실행해라. js를 헤더 위에 두어도 본문쪽에 적용 되도론 한다
document.addEventListener("DOMContentLoaded", () => {
    const btn_login = document.querySelector("#btn_login")

    btn_login.addEventListener("click", ()  => {
        self.location.href = './login.php'
    })

})

