<input type="hidden" name="id" id="edit-id" value="{{ $item->id }}">
<div class="row">
    <div class="col-md-12 mt-2">
        <div class="form-group">
            <label for="name">Answer</label>
            <input type="text" name="answer_text" id="edit-answer_text" value="{{ $item->answer_text }}"
                class="form-control" placeholder="Answer Text" aria-describedby="helpId" required>
            <div id="error-edit-answer_text" class="error text-danger"></div>

        </div>
    </div>
    <div class="col-md-12 mt-2">
        <div class="form-group">
            <label for="is_correct">Correct/Not Correct</label>
            <select name="is_correct" id="is_correct" class="form-control" required>
                <option value="0" {{ $item->is_correct == 0 ? 'selected' : '' }}>Not Correct</option>
                <option value="1" {{ $item->is_correct == 1 ? 'selected' : '' }}>Correct</option>
            </select>
        </div>
    </div>
    <input type="hidden" name="quiz_question_id" class="form-control" value="{{ $quizquestion->id }}">

</div>
