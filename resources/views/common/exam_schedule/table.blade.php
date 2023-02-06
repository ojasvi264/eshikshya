<table id="example3"  class="table table-bordered display" style="min-width: 750px">
    <thead>
    <tr>
        <th>Subject</th>
        <th>Date From</th>
        <th>Start Time</th>
        <th>Duration (hrs)</th>
        <th>Room Number</th>
    </tr>
    </thead>
    <tbody>
    @foreach($exam_schedules as $exam_schedule)
        <tr>
            <td>{{ $exam_schedule->name }}</td>
            <td>{{ $exam_schedule->date }}</td>
            <td>{{ $exam_schedule->time }}</td>
            <td>{{ $exam_schedule->duration }}</td>
            <td>{{ $exam_schedule->room_number }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
