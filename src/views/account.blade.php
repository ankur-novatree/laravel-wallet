@extends("wallet::admin-layout")

@section('content')
<form action="{{ URL::to('admin/account-type') }}" method="post" enctype="multipart/form-data" class="layout-row layout-align-center-center form-horizontal form-bordered">
    @if(isset($data['id']))
        <input type="hidden" name="id" value="{{ $data['id'] }}">
    @endif
<div class="lg-cell lg-cell--4-col">
    <div class="lg-panel">
        <div class="lg-panel__header">
            <span>Create <small>Account Type</small></span>
        </div>
        <div class="lg-panel__body">
            <div class="lg-flex-container layout-row layout-wrap">
                <div class="lg-flex lg-flex-12 demo-button">
                    <div class="lg-textfield lg-js-textfield is-upgraded">
                        <input class="lg-textfield__input"  type="text" id="account_type_name" name="type_name" value="@if(isset($data['name'])) {{ $data['name'] }} @endif">
                        <label class="lg-textfield__label" for="account_type_name">Account Type Name</label>
                    </div>
                    <div class="lg-textfield lg-js-textfield is-upgraded">
                        <input class="lg-textfield__input" type="text" id="code" name="code" value="@if(isset($data['code'])) {{ $data['code'] }} @endif">
                        <label class="lg-textfield__label" for="code">Account Type Machine Name</label>
                    </div>
                    <div class="lg-textfield lg-js-textfield is-upgraded">
                        <select id="example-select" name="status" class="form-control" size="1">
                            <option value="0">
                                Please select
                            </option>
                            <option value="1" @if(isset($data['status']) && $data['status'] == 1) selected @endif>Active</option>
                            <option value="0" @if(isset($data['status']) && $data['status'] == 0) selected @endif>Inactive</option>
                        </select>
                    </div>
                    <div class="lg-textfield lg-js-textfield is-upgraded">
                        <button class="lg-button lg-button--primary lg-button--block lg-button--raised">@if(isset($data['id'])) Update @else Create @endif</button>
                    </div>
                    {{ csrf_field()}}
                </div>
            </div>
        </div>
    </div>
</div>

</form>
@stop