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
          <th colspan="14">LIQUIDACION DE {{ $sd }} AL {{ $ed }}</th>
        </tr>
        <tr></tr>
        <tr>
          <th bgcolor=#2874A6 style='color:white;'>Serie</th>
          <th bgcolor=#2874A6 style='color:white;'>Juego</th>
          <th bgcolor=#2874A6 style='color:white;'>POS</th>
          <th bgcolor=#2874A6 style='color:white;'>CONT. INICIALES <br><small class="text-muted">Turnover - Totalwin</small> </th>
          <th bgcolor=#2874A6 style='color:white;'>CONT. FINAL <br><small class="text-muted">Turnover - Totalwin</small></th>
          <th bgcolor=#2874A6 style='color:white;'>DIFER.CONT <br><small class="text-muted">Turnover - Totalwin</small></th>
          <th bgcolor=#2874A6 style='color:white;'>PRO. REAL</th>
          <th bgcolor=#2874A6 style='color:white;'>T. RELLENOS</th>
          <th bgcolor=#2874A6 style='color:white;'>T. RETIROS</th>
          <th bgcolor=#2874A6 style='color:white;'>T. PAGOS M.</th>
          <th bgcolor=#2874A6 style='color:white;'>PRO. MAQUINA</th>
          <th bgcolor=#2874A6 style='color:white;'>INICIAL BILLETES</th>
          <th bgcolor=#2874A6 style='color:white;'>FINAL BILLETES</th>
          <th bgcolor=#2874A6 style='color:white;'>PRO. BILLETES</th>
          <th bgcolor=#2874A6 style='color:white;'>CONT. DE BILLETES</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($operations as $index => $item)
          <tr>
            <td>{{ $item->machine->series }}</td>
            <td>{{ $item->machine->game }}</td>
            <td>{{ $item->machine->position }}</td>
            <td>{{ $item->initialTO }} - {{ $item->initialTW }}</td>
            @if ($item->finalTO)
              <td>{{ $item->finalTO }} - {{ $item->finalTW }}</td>
            @else
              <td> En conteo</td>
            @endif
            @if ($item->finalTO)
              <td>{{ $item->realTO }} - {{ $item->realTW }}</td>
            @else
              <td> En conteo </td>
            @endif
            @if ($item->finalTO)
              @if ($item->machine->hasBill)
                <td>{{ $item->proReal }}</td>
              @else
                <td>{{ $item->proReal - $item->proBill }}</td>
              @endif
            @else
              <td> En conteo </td>
            @endif
            <td>{{ $item->relleno }}</td>
            <td>{{ $item->retiro }}</td>
            <td>{{ $item->pago }}</td>
            <td>{{ $item->proMaquina }}</td>
            @if ($item->finalTO)
              <td>{{ $item->initialBill }}</td>
              <td>{{ $item->finalBill }}</td>
              <td>{{ $item->proBill }}</td>
              {{-- <td>{{ $item->finalBill - $item->initialBill }}</td> --}}
            @endif
            @if ($item->machine->hasBill)
              <td>Si</td> 
            @else
              <td>No</td>
            @endif
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>
