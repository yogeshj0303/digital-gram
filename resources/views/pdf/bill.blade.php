<h1>Bill for {{ $record->type }}</h1>
<table border="1" cellspacing="0" cellpadding="5" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th style="text-align: left;">Field</th>
            <th style="text-align: left;">Value</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>State Name</td>
            <td>{{ $record->state }}</td>
        </tr>
        <tr>
            <td>District Name</td>
            <td>{{ $record->district }}</td>
        </tr>
        <tr>
            <td>Taluka Name</td>
            <td>{{ $record->taluka }}</td>
        </tr>
        <tr>
            <td>Gram Name</td>
            <td>{{ $record->gram }}</td>
        </tr>
        <tr>
            <td>Amount Paid</td>
            <td>{{ $record->paid_amount }}</td>
        </tr>
         <tr>
            <td>Amount Paid Type</td>
            <td>{{ $record->paid_type }}</td>
        </tr>
        <tr>
            <td>Paid Date</td>
            <td>{{ $record->paid_date }}</td>
        </tr>
         <tr>
            <td>Remaining Amount </td>
            <td>{{ $record->remaining_amount }}</td>
        </tr>
    </tbody>
</table>
