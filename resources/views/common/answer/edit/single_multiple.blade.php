<table class="table table-bordered">
    <thead>
    <th>Answer</th>
    <th>Is Correct</th>
    </thead>
    <tbody>
    @foreach ($question_bank->answers as $answer)
        <tr>
            <td><input type="text" name="answers[]" value="{{ $answer->answer }}" class="form-control"></td>
            <td>
                <select class="form-control" name="is_correct[]" required>
                    <option disabled selected>Please Select</option>
                    <option value="true" {{ ($answer->is_correct_answer == 1) ? 'selected' : '' }}>True</option>
                    <option value="false" {{ ($answer->is_correct_answer == 0) ? 'selected' : '' }}>false</option>
                </select>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
