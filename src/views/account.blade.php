<form action="{{ URL::to('account-type') }}" method="post">
    <label>Account Type Name</label>
    <input type="text" name="type_name">
    <label>Account Type Machine Name</label>
    <input type="text" name="code">
    <label>Status</label>
    <select name="status">
        <option value="1">Active</option>
        <option value="0">InActive</option>
    </select>
</form>