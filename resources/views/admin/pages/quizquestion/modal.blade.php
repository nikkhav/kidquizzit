<div class="modal fade create-modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Quiz Question Store</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="create-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <div class="form-group">
                                <label for="question_text">Question Text</label>
                                <input type="text" name="question_text" id="question_text" class="form-control"
                                    placeholder="Enter Question Text" aria-describedby="helpId">
                                <div id="question_text-error" class="error text-danger"></div>

                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="quiz_id" class="form-control" value="{{ $_GET['quiz_id'] }}">
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
                <h5 class="modal-title" id="exampleModalLabel">Quiz Question Edit</h5>
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
