<table>
    @foreach($data as $key => $value)
        <tr>
            <td>{{ $value['id'] }}</td>
            <td>{{ $value['code'] }}</td>
            <td>{{ $value['status'] }}</td>
        </tr>
    @endforeach
</table>