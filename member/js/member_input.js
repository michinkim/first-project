document.addEventListener("DOMContentLoaded", () => {

    //아이디 중복체크
    const btn_id_check = document.querySelector("#btn_id_check")
    btn_id_check.addEventListener("click", () => {
        const f_id = document.querySelector("#f_id")

        if(f_id.value == ''){
            alert("아이디를 입력해 주세요.");
            return false
        }

        //AJAX를 통해서 DB쿼리를 진행해야하겠죠
        const f1 = new FormData()
        f1.append('id', f_id.value)
        f1.append('mode', 'id_chk')



        
        const xhr = new XMLHttpRequest()
        xhr.open("POST", "./pg/member_process.php", true) //true 비동기화 방식으로 진행한다 이건 고정이라도 봐도 됩니다
        xhr.send(f1)

        xhr.onload = () => {
            if(xhr.status == 200) {
              const data = JSON.parse(xhr.responseText)
              if(data.result == 'success') {
                alert('사용이 가능한 아이디입니다')
                document.input_form.id_chk.value = "1"
              }else if(data.result == 'fail') {
                document.input_form.id_chk.value = "0"
                alert('이미 사용중인 아이디입니다. 다른 아이디를 입력해 주세요.')
                f_id.value = ''
                f_id.focus()
              } else if(data.result == 'empty_id') {                
                alert('아이디가 비어 있습니다.')
                f_id.focus()
              }
            }
          }
         
    }) 


    //이메일 중복체크 및 이메일 형식 체크
    const btn_email_check = document.querySelector("#btn_email_check")
    btn_email_check.addEventListener("click", () => {
        const f_email = document.querySelector("#f_email")

        if(f_email.value == ''){
            alert("이메일을 입력해 주세요.");
            f_email.focus()
            return false
        }

        //AJAX를 통해서 DB쿼리를 진행해야하겠죠
        const f1 = new FormData()
        f1.append('email', f_email.value)
        f1.append('mode', 'email_chk')
        
        const xhr = new XMLHttpRequest()
        xhr.open("POST", "./pg/member_process.php", true) //true 비동기화 방식으로 진행한다 이건 고정이라도 봐도 됩니다
        xhr.send(f1)

        xhr.onload = () => {
            if(xhr.status == 200) {
              const data = JSON.parse(xhr.responseText)
              if(data.result == 'success') {
                alert('사용이 가능한 이메일입니다')
                document.input_form.email_chk.value = "1"
              }else if(data.result == 'fail') {
                document.input_form.email_chk.value = "0"
                alert('이미 사용중인 이메일입니다. 다른 이메일를 입력해 주세요.')
                f_email.value = ''
                f_email.focus()
              } else if(data.result == 'empty_email') {                
                alert('이메일이 비어 있습니다.')
                f_email.focus()
              } else if(data.result == 'empty_format_wrong'){
                alert('이메일이 형식에 맞지 않습니다.')  
                f_email.value = ''              
                f_email.focus()
              }
            }
          }
         
    }) 

    // 가입 버튼 클릭시
    const btn_submit = document.querySelector('#btn_submit')
    btn_submit.addEventListener('click', () =>{
      const f = document.input_form // input_form을 document.input_form로  f 변수로 받아놓았다
      if(f.id.value == ''){
        alert('아이디를 입력해 주세요.')
        f.id.focus()
        return false
      }      
      // 아이디 중복확인 여부 체크
      if(f.id_chk.value == 0) {
        alert('아이디 중복확인을 해주시기 바랍니다.')
        return false
      }

      // 이름 입력 확인
      if(f.name.value == ''){
        alert('이름을 입력해 주세요.')
        f.name.focus()
        return false
      } 

      // 비밀번호 확인.
      if(f.password.value == '') {
        alert('비밀번호를 입력해 주세요.')
        f.password.focus()
        return false
      }

      if(f.password2.value == '') {
        alert('확인용 비밀번호를 입력해 주세요.')
        f.password2.focus()
        return false
      }

      // 비밀번호 일치여부 확인
      if(f.password.value != f.password2.value){
        alert('비밀번호가 서로 일치하지 않습니다.')
        f.password.value = ''
        f.password2.value = ''
        f.password.focus()
        return false
      }

      // 이메일 입력 부분 확인
      if(f.email.value == ''){
        alert("이메일을 입력해 주세요")
        f.email.focus()
        return false
      }
      //이메일 중복 체크 여부 확인
      if(f.email_chk.value == 0) {
        alert("이메일을 중복확인을 해주세요.")
        return false
      }

      // 우편번호 입력확인
      if(f.zipcode.value == '') {
        alert("우편번호를 입력해 주세요.")    
        return false  // 여기는 포커스를 주지않는다. 개인이 잘못입력해서 오류가 날수 있으니
      }
      // 주소입력 확인
      if(f.addr1.value == '') {
        alert("주소를 입력해 주세요.")  
        f.addr1.focus()  
        return false  
      }
      // 상세 주소입력 확인
      if(f.addr2.value == '') {
        alert("상세 주소를 입력해 주세요.")  
        f.addr2.focus()  
        return false  
      }

      //프로필 이지지는 강제하지 않습니다. 없을수도 있어서 확인여부 패스

      f.submit()

    })

    //우편번호 찾기

    const btn_zipcode = document.querySelector("#btn_zipcode")
    btn_zipcode.addEventListener("click", () => {

      new daum.Postcode({
        oncomplete: function(data) {

            console.log(data) // 우편번호 검색한 결과값을 찍어본다(크롬 개발자모드에서 )
            let addr = ''
            let extra_addr = ''
            if (data.userSelectedType == 'J') {
              addr = data.jibunAddress             


            }else if (data.userSelectedType == 'R'){
              addr = data.roadAddress
            }

            //동주소 추가
            if(data.bname != ''){
              extra_addr = data.bname
            }
            //건물명 추가하기
            if(data.buildingName != '') {
              if(extra_addr == '') {
                extra_addr = data.buildingName 
              } else { extra_addr += ', ' + data.buildingName
            }}
            //주소가 나온게 있으면 ( 괄호 ) 넣기
            if(extra_addr != '') {
              extra_addr = ' (' + extra_addr + ')'
            }

            const f_addr1 = document.querySelector("#f_addr1")
            f_addr1.value = addr + extra_addr

            const f_zipcode = document.querySelector("#f_zipcode")
            f_zipcode.value = data.zonecode

            const f_addr2 = document.querySelector("#f_addr2")
            f_addr2.focus()
          
            


        }
      }).open();

    })
    // 프로필 이미지 미리보기
    const f_photo = document.querySelector("#f_photo")
    f_photo.addEventListener("change", (e) => {
      // console.log(e) 업로드 이미지 로그 확인용
      const reader = new FileReader()
      reader.readAsDataURL(e.target.files[0]) // 이미지 로딩이(reader) 시작된다 

      reader.onload = function(event) {      // 이미지 로딩이 끝나는 시점을 알아야해서 그때 onload 이벤트가 발생한다
        // console.log(event) 이벤 트로그 내용 확인용
        //이미지를 담을 엘리먼트를 하나 만든다
        // const img = document.createElement("img")
        // img.setAttribute("src", event.target.result) //setAttribute event로그에 base64 담긴 이미지를 src로 
        // document.querySelector("#f_preview").appendChild(img) //아이디니까 #을 붙여지고 업로드한 이미지를 상세보기로 보여주야 하니까
        const f_preview = document.querySelector("#f_preview")
        f_preview.setAttribute("src", event.target.result)
      }
  })

})


