<div class="form-group">
    <label class="form-label">Answer</label>
    <select class="form-control" name="is_correct" required>
        <option disabled selected>Please Select</option>
        <option value="true" {{ ($question_bank->answers[0]->answer == 'True') ? 'selected' : '' }}>True</option>
        <option value="false" {{ ($question_bank->answers[0]->answer == 'False') ? 'selected' : '' }}>False</option>
    </select>
</div>
