<input type="hidden" name="id" id="edit-id" value="{{ $item->id }}">
<div class="row">
    <div class="col-md-12 mt-2">
        <div class="form-group">
            <label for="name">Question Text</label>
            <input type="text" name="question_text" id="edit-question_text" value="{{ $item->question_text }}"
                class="form-control" placeholder="Question Text" aria-describedby="helpId" required>
            <div id="error-edit-question_text" class="error text-danger"></div>
        </div>
        <input type="hidden" name="quiz_id" class="form-control" value="{{ $item->quiz_id }}">

    </div>
</div>
