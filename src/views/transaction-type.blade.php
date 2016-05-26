<form action="{{ URL::to('transaction-type') }}" method="post">
    <label>Transaction Type Name</label>
    <input type="text" name="code">
    <label>Status</label>
    <select name="status">
        <option value="1">Active</option>
        <option value="0">InActive</option>
    </select>
</form>