<table>
    <tr>
        <td>Transaction Id</td>
        <td>User Id</td>
        <td>Amount</td>
        <td>Account Type</td>
        <td>Transaction Type</td>
        <td>Transaction Date</td>
    </tr>
    @foreach($transaction as $key => $value)
        <tr>
            <td>{{ $value['id'] }}</td>
            <td>{{ $value['user_id'] }}</td>
            <td>{{ $value['amount'] }}</td>
            <td>{{ $value['account_type'] }}</td>
            <td>{{ $value['transaction_type'] }}</td>
            <td>{{ $value['transaction_date'] }}</td>
        </tr>
    @endforeach
</table>