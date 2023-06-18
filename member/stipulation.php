<?php 

$js_array = ['js/member.js'];

$g_title = '약관';
$menu_code = 'member';

include 'inc_header.php'; 

?>

          <main class="p-5 border rounded-5">
            <h1 class="text-center ">회원 약관 및 개인정보 취급방침 동의</h1>
            <h4>회원약관</h4>
            <textarea name="" id="" cols="30" rows="10" class="form-control">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis distinctio sed perferendis veniam, quibusdam fugiat! Ad, quam odit magnam harum rem eveniet officia id commodi quia dolores nobis nulla vero corporis exercitationem aut voluptates dignissimos distinctio iusto sunt pariatur itaque accusantium nemo praesentium! Cum quidem quam aut mollitia porro reprehenderit reiciendis deleniti architecto consectetur illo! Provident vero minus veniam tenetur aspernatur voluptates, autem assumenda. Sapiente dicta, odio perspiciatis numquam minus maxime ut, illo repellendus fuga illum quam at placeat laboriosam totam et. Deserunt nostrum modi hic quibusdam sunt at ex dolore consectetur nesciunt, doloremque explicabo debitis iure vero perferendis alias impedit voluptates non dicta, eius facere. Aliquam excepturi consequatur, libero suscipit repellat in unde tempora voluptatem a iste quae debitis cupiditate provident eos nam facere tempore reiciendis! Dignissimos facilis dicta blanditiis nostrum nihil, tempora voluptatibus, adipisci necessitatibus dolorem suscipit, harum corporis nulla quod numquam laudantium dolorum nam facere explicabo eligendi hic. Eum aliquid quo ratione adipisci accusantium iure vel tenetur! Nostrum dignissimos rerum consectetur aliquid nulla, voluptatibus deleniti rem impedit assumenda aut quasi! Nihil, molestiae. Quis nostrum optio facilis aut, voluptates vero culpa, ipsa aliquam magni tenetur quo nobis molestiae architecto totam exercitationem a praesentium delectus omnis maxime perspiciatis nam, autem earum magnam. Quos magnam fugiat officiis alias laborum non odio repudiandae ratione assumenda nobis, reiciendis cupiditate omnis eaque enim? Accusamus veritatis, sed explicabo perspiciatis iure porro earum sequi quaerat voluptatum eveniet quo quibusdam nam non fugit, quod temporibus! Tempore iste commodi amet ratione iure? Commodi quidem pariatur quibusdam quod vitae facere ullam sit blanditiis temporibus impedit, iusto enim voluptas ducimus. Nesciunt, mollitia numquam dicta recusandae dolorum sint repudiandae eum, itaque blanditiis nostrum rerum odit. Inventore eum provident ab molestiae molestias! Dolorum molestiae, quis quidem modi, aliquam sunt accusamus odio voluptas adipisci tempore fugit velit dignissimos dolor eius non sint.
            </textarea>

            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" value="1" id="chk_member1">
                <label class="form-check-label" for="chk_member1">
                  위 약관에 동의하시겠습니까?
                </label>
            </div>

            <h4 class="mt-3">개인정보 취급방침</h4>
            <textarea name="" id="" cols="30" rows="10" class="form-control">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia mollitia quibusdam blanditiis aliquid in qui eveniet veritatis vel debitis, voluptatibus maiores doloribus quos nesciunt ipsum aliquam ab omnis ipsa. Laborum ducimus voluptatum sed quos dolor illum, mollitia fugit nisi corporis, alias doloribus iste atque magnam, beatae numquam ipsam inventore nihil facere placeat possimus libero cumque dignissimos! Dolorem sapiente, non sequi consequatur voluptatum, voluptate est ratione autem quidem aliquid cupiditate et error natus aperiam repudiandae enim distinctio saepe! Sunt qui officia soluta cumque libero cupiditate voluptas? Aperiam provident dignissimos obcaecati ipsa enim minima numquam nobis doloribus, nulla vel nostrum debitis, magnam rerum error voluptatem, similique saepe sed asperiores totam assumenda quae eaque aliquid illo aut. Aliquam vitae eius et iusto soluta dignissimos natus magnam unde laboriosam sequi est sed, quia aliquid voluptas officia, sunt, quidem saepe! Nesciunt sit eum recusandae maiores facere laboriosam illo voluptates reprehenderit. Ipsa repellendus, modi et ab a, doloribus nostrum aut amet praesentium nisi itaque! Non in culpa, iure ab animi placeat laboriosam qui quod sint vitae a totam provident impedit delectus fuga, consequuntur consectetur aut atque tenetur, dolores quaerat? Modi illum reprehenderit eaque quidem similique, perspiciatis sunt at nam id consectetur minima ipsa obcaecati nobis sed dolorem! Blanditiis amet sequi quas assumenda! Quod a repellendus quo similique molestias velit blanditiis soluta, qui, tenetur, dolore non? Nesciunt exercitationem dignissimos fugiat temporibus accusantium, alias eius quod fugit reprehenderit, recusandae aspernatur esse necessitatibus ipsum commodi corrupti nam dolorem eos vel, reiciendis mollitia quia! Maiores ab, dignissimos ut repudiandae officiis nostrum aliquid aspernatur mollitia enim rerum tempora modi accusamus omnis temporibus fugiat! Est deleniti quisquam nemo illo nostrum quibusdam maxime sunt ipsa perferendis incidunt explicabo aliquam ex voluptatum necessitatibus, maiores quaerat sed officia? Animi nisi commodi numquam vitae nihil, non officiis maiores similique, iure ducimus nesciunt labore unde, illum praesentium.
            </textarea>

            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" value="1" id="chk_member2">
                <label class="form-check-label" for="chk_member2">
                  위 개인정보 취급방침에 동의하시겠습니까?
                </label>
            </div>

            <div class="mt4 d-flex justify-content-center gap-2">
                <button class="btn btn-primary w-50" id="btn_member">회원가입</button>
                <button class="btn btn-secondary w-50">가입취소</button>
            </div>
            
            <form method="post" name="stipulation_form" action="member_input.php" style="display:none">
              <input type="hidden" name="chk" value="0">
            </form>
          </main>

<?php include 'inc_footer.php'; ?>

