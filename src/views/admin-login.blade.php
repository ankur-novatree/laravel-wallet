<form action="{{ URL::to('admin/login') }}" method="post">
    <label>UserName</label>
    <input type="text" name="username">
    <label>Password</label>
    <input type="password" name="password">
    <input type="submit" value="Login">
    {{ csrf_field() }}
</form>