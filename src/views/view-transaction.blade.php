{{--<table>
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
</table>--}}

@extends('wallet::admin-layout')
@section('content')
    <div class="layout-row layout-align-center-center">
        <div class="lg-cell lg-cell--4-col">
            <table class="lg-data-table lg-js-data-table lg-data-table--selectable lg-shadow--2dp">
                <thead class="lg-data-table--primary">
                <tr>
                    <th>Transaction Id</th>
                    <th>User Id</th>
                    <th>Amount</th>
                    <th>Account Type</th>
                    <th>Transaction Type</th>
                    <th>Transaction Date</th>
                </tr>
                </thead>
                <tbody>
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
                </tbody>
            </table>
        </div>
    </div>

@stop