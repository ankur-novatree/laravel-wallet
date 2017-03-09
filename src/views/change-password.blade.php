@extends("wallet::admin-layout")

@section('content')
<form action="{{ URL::to('admin/change-password') }}" method="post" enctype="multipart/form-data" class="layout-row layout-align-center-center form-horizontal form-bordered">
<div class="lg-cell lg-cell--4-col">
    <div class="lg-panel">
        <div class="lg-panel__header">
            <span>Change <small>Password</small></span>
        </div>
        <div class="lg-panel__body">
            <div class="lg-flex-container layout-row layout-wrap">
                <div class="lg-flex lg-flex-12 demo-button">
                    <div class="lg-textfield lg-js-textfield is-upgraded">
                        <input class="lg-textfield__input"  type="password" id="account_type_name" name="old_password">
                        <label class="lg-textfield__label" for="account_type_name">Old Password</label>
                    </div>
                    <div class="lg-textfield lg-js-textfield is-upgraded">
                        <input class="lg-textfield__input"  type="password" id="account_type_name" name="new_password">
                        <label class="lg-textfield__label" for="account_type_name">New Password</label>
                    </div>
                    <div class="lg-textfield lg-js-textfield is-upgraded">
                        <input class="lg-textfield__input"  type="password" id="account_type_name" name="confirm_password">
                        <label class="lg-textfield__label" for="account_type_name">Confirm Password</label>
                    </div>
                    <div class="lg-textfield lg-js-textfield is-upgraded">
                        <button class="lg-button lg-button--primary lg-button--block lg-button--raised">Change</button>
                    </div>
                    {{ csrf_field()}}
                </div>
            </div>
        </div>
    </div>
</div>

</form>
@stop