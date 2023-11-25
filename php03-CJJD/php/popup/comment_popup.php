<!-- 삭제 팝업 -->
<div id="popupDelete" class="none">
    <div class="comment__delete">
        <h4>댓글 삭제</h4>
        <input type="password" id="commentDeletePass" name="commentDeletePass" placeholder="비밀번호">
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
        <textarea name="commentModifyMsg" id="commentModifyMsg" rows="4" placeholder="수정할 내용을 적어주세요!"></textarea>
        <div class="btn">
            <button id="commentModifyCancel">취소</button>
            <button id="commentModifyButton">수정</button>
        </div>
    </div>
</div>