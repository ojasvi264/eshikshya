<table class="table table-bordered">
    <thead>
    <th>Answer</th>
    <th>Is Correct</th>
    </thead>
    <tbody>
    @for ($i=0; $i<=4; $i++)
        <tr>
            <td><input type="text" name="answers[]" placeholder="Option {{ $i+1 }}" class="form-control"></td>
            <td>
                <select class="form-control" name="is_correct[]" required>
                    <option disabled selected>Please Select</option>
                    <option value="true">True</option>
                    <option value="false">false</option>
                </select>
            </td>
        </tr>
    @endfor
    </tbody>
</table>
