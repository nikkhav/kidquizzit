<div class="modal fade create-modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Quiz Question Answers Store</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <div class="form-group">
                                <label for="title">Answer</label>
                                <textarea name="answer_text" id="answer_text" class="form-control"
                                    placeholder="Enter Answer Text" aria-describedby="helpId" required></textarea>
                                <div id="answer_text-error" class="error text-danger"></div>

                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="form-group">
                                <label for="is_correct">Correct/Not Correct</label>
                                <select name="is_correct" id="is_correct" class="form-control" required>
                                    <option value="0">Not Correct</option>
                                    <option value="1">Correct</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="quiz_question_id" class="form-control"
                            value="{{ $_GET['quiz_question_id'] }}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success " id="save-category">Add</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="customer-type-modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Quiz Question Answers Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-form">
                    @csrf
                    @method('PUT')
                    <div id="inputs">



                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success " id="edit-customer-type">Edit</button>
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('answer_text');

</script>