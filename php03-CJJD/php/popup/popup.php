<!-- 삭제 팝업 -->
<div id="popupDelete" class="none">
    <div class="comment__delete">
        <h4>댓글 삭제</h4>
        <label for="commentPass" class="blind">비밀번호</label>
        <input type="password" id="commentDeletePass" name="commentDeletePass" placeholder="비밀번호">
        <p>* 가입했던 비밀번호를 입력해주세요!</p>
        <div class="btn">
            <button id="commentDeleteCancel">취소</button>
            <button id="commentDeleteButton">삭제</button>
        </div>
    </div>
</div>

<!-- 수정 팝업 -->
<div id="popupModify" class="none">
    <div class="comment__modify">
        <h4>댓글 수정</h4>
        <label for="commentModifyMsg" class="blind">비밀번호</label>
        <textarea name="commentModifyMsg" id="commentModifyMsg" rows="4" placeholder="수정할 내용을 적어주세요!"></textarea>
        <input type="password" id="commentModifyPass" name="commentModifyPass" placeholder="비밀번호">
        <p>* 가입했던 비밀번호를 입력해주세요!</p>
        <div class="btn">
            <button id="commentModifyCancel">취소</button>
            <button id="commentModifyButton">수정</button>
        </div>
    </div>
</div>