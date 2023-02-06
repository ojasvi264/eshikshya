<table class="table table-borderd" id="myTable" border="1">
    <thead>
        <th>S.N</th>
        <th>Particulars</th>
        <th>Amount</th>
        <th>Quantity</th>
        <th>Option</th>
    </thead>
    <tbody>
        @foreach ($fee_types as $key=>$fee_type)
            <tr>
                <input type="hidden" name="fee_type_ids[]" value="{{ $fee_type->id }}">
                <td>{{ ++$key }}</td>
                <td>{{ $fee_type->name }}</td>
                <td>{{ $fee_type->amount }}</td>
                <td><input type="number" min="1" name="qtys[]" class="form-control" value="1"></td>
                <td><input type="button" class="btn btn-sm btn-rounded btn-outline-danger" value="Delete" onclick="deleteRow(this.parentNode.parentNode.rowIndex)"></td>
            </tr>
        @endforeach
    </tbody>
</table>
