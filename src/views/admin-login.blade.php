@extends('wallet::admin-layout')

@section('content')
    <form action="{{ URL::to('admin/login') }}" method="post">
        {{--<label>UserName</label>
        <input type="text" name="username">
        <label>Password</label>
        <input type="password" name="password">
        <input type="submit" value="Login">--}}
        {{ csrf_field() }}


        <div class="layout-align-center-center layout-row">
            <div class="lg-shadow--2dp layout-m-b-2 layout-p-t-2 layout-p-b-0 lg-color-white" style="max-width: 360px;">
                <div class="layout-wrap layout-row">
                    <div class="lg-flex-12 lg-panel" style="box-shadow: none">
                        <div class="lg-panel__header lg-text-primary" style="background: transparent">
                            Login
                        </div>
                        <div class="layout-fill layout-column layout-align-center-stretch">
                            <div class="lg-panel__body" style="padding-top: 0">
                                <form>
                                    <div class="lg-textfield lg-js-textfield is-upgraded">
                                        <input class="lg-textfield__input" type="text" name="username" id="sample1">
                                        <label class="lg-textfield__label" for="sample1">Username</label>
                                    </div>
                                    <div class="lg-textfield lg-js-textfield is-upgraded">
                                        <input class="lg-textfield__input" type="password" name="password" id="password1">
                                        <label class="lg-textfield__label" for="password1">Password</label>
                                    </div>
                                </form>
                            </div>
                            <div class="lg-panel__footer" style="padding-top: 0; padding-bottom: 8px">
                                <div class="layout-row layout-align-space-around-center">
                                    <button class="lg-button lg-button--primary lg-button--block lg-button--raised">Sign in</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop