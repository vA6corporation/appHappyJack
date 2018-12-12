<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <table>
      <thead>
        <tr>
          <th colspan="5">MOVIMIENTOS DEL {{ $sd }} AL {{ $ed }}</th>
        </tr>
        <tr></tr>
        <tr>
          <th bgcolor=#2874A6 style='color:white;'>FECHA REGISTRO</th>
          <th bgcolor=#2874A6 style='color:white;'>POSICION</th>
          <th bgcolor=#2874A6 style='color:white;'>RELLENO</th>
          <th bgcolor=#2874A6 style='color:white;'>RETIRO</th>
          <th bgcolor=#2874A6 style='color:white;'>PAGO MANUAL</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($operations as $index => $item)
          <tr>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->machine->position }}</td>
            @if ($item->type ==  0)
              <td>{{ $item->cash }}</td>
              <td></td>
              <td></td>
            @elseif ($item->type == 1)
              <td></td>
              <td>{{ $item->cash }}</td>
              <td></td>
            @elseif ($item->type == 2)
              <td></td>
              <td></td>
              <td>{{ $item->cash }}</td>
            @endif
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>
