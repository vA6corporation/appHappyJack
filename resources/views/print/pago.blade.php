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
          <th colspan="2">PAGOS DEL {{ $sd }} AL {{ $ed }} POSICION {{ $position }}</th>
        </tr>
        <tr></tr>
        <tr>
          <th bgcolor=#2874A6 style='color:white;'>FECHA REGISTRO</th>
          <th bgcolor=#2874A6 style='color:white;'>PAGO</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($operations as $index => $item)
          <tr>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->cash }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>
