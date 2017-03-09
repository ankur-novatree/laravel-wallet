@extends('wallet::admin-layout')

@section('content')
<form action="{{ URL::to('transaction-type') }}" method="post" enctype="multipart/form-data" class="layout-row layout-align-center-center form-horizontal form-bordered">
    <div class="lg-cell lg-cell--4-col">
        <div class="lg-panel">
            <div class="lg-panel__header">
                <span>Create <small>Transaction Type</small></span>
            </div>
            <div class="lg-panel__body">
                <div class="lg-flex-container layout-row layout-wrap">
                    <div class="lg-flex lg-flex-12 demo-button">
                        <div class="lg-textfield lg-js-textfield is-upgraded">
                            <input class="lg-textfield__input" type="text" id="code" name="code">
                            <label class="lg-textfield__label" for="code">Transaction Type Name</label>
                        </div>
                        <div class="lg-textfield lg-js-textfield is-upgraded">
                            <select id="example-select" name="status" class="form-control" size="1">
                                <option value="0">
                                    Please select
                                </option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="lg-textfield lg-js-textfield is-upgraded">
                            <button class="lg-button lg-button--primary lg-button--block lg-button--raised">Create</button>
                        </div>
                        {{ csrf_field()}}
                    </div>
                </div>
            </div>
        </div>
    </div>


</form>
@stop