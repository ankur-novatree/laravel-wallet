{{--<form action="{{ URL::to('account-type') }}" method="post">
    <label>Account Type Name</label>
    <input type="text" name="type_name">
    <label>Account Type Machine Name</label>
    <input type="text" name="code">
    <label>Status</label>
    <select name="status">
        <option value="1">Active</option>
        <option value="0">InActive</option>
    </select>
</form>--}}

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/wallet/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/wallet/font-awesome.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css//wallet/custom.css') }}">

<form action="{{ URL::to('account-type') }}" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
    <div class="form-group">
        <label class="col-md-3 control-label" for="example-text-input">Account Type Name</label>
        <div class="col-md-6">
            <input type="text" id="example-text-input" name="type_name" class="form-control" placeholder="Account Type Name">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label" for="example-text-input">Account Type Machine Name</label>
        <div class="col-md-6">
            <input type="text" id="example-text-input" name="code" class="form-control" placeholder="Account Type Machine Name">
        </div>
    </div>

    <div class="form-group striped-col">
        <label class="col-md-3 control-label" for="example-select">Select</label>
        <div class="col-md-6">
            <select id="example-select" name="status" class="form-control" size="1">
                <option value="0">
                    Please select
                </option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
    </div>
    <div class="form-group form-actions">
        <div class="col-md-9 col-md-offset-3">
            <button type="submit" class="btn btn-effect-ripple btn-primary">Submit</button>
        </div>
    </div>
</form>