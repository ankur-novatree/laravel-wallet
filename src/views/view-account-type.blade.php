@extends('wallet::admin-layout')
@section('content')
    <div class="layout-row layout-align-center-center">
    <div class="lg-cell lg-cell--4-col">
<table class="lg-data-table lg-js-data-table lg-data-table--selectable lg-shadow--2dp">
    <thead class="lg-data-table--primary">
    <tr>
        <th>Id</th>
        <th>Account Type Name</th>
        <th>Account Type Machine Name</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $key => $value)
        <tr>
            <td>{{ $value['id'] }}</td>
            <td>{{ $value['name'] }}</td>
            <td>{{ $value['code'] }}</td>
            <td>{{ $value['status'] }}</td>
            <td><a href="{{ URL::to('admin/account-type',$value['id']) }}">Edit</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
    </div>
    </div>

@stop