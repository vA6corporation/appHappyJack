<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use App\Operation;
use App\Count;

class PrintController extends Controller
{
    public function liquidacion($sd, $ed, $room_id) {
      $operations = Count::whereHas('machine', function($query) use ($room_id) {
        $query->where('room_id', $room_id);
      })->with('machine', 'operations')->whereBetween('created_at', [$sd, $ed])->get();
      foreach ($operations as $index => $item) {
        $relleno = 0;
        $retiro = 0;
        $pago = 0;
        foreach ($item->operations as $subIndex => $operation) {
          switch ($operation->type) {
            case '0':
              $relleno += $operation->cash;
              break;
            case '1':
              $retiro += $operation->cash;
              break;
            case '2':
              $pago += $operation->cash;
              break;
          }
        }
        $item->relleno = $relleno;
        $item->retiro = $retiro;
        $item->pago = $pago;
        $item->realTO = $item->finalTO - $item->initialTO;
        $item->realTW = $item->finalTW - $item->initialTW;
        $item->realTO = number_format((float)$item->realTO * 0.01, 2, '.', '');
        $item->realTW = number_format((float)$item->realTW * 0.01, 2, '.', '');
        $item->proReal = number_format((float)($item->realTO - $item->realTW), 2, '.', '');
        //$item->proHasBill = number_format((float)($item->proReal - $item->realTW), 2, '.', '');
        $item->proBill = number_format((float)($item->finalBill - $item->initialBill) * 0.01, 2, '.', '');
        $item->proMaquina =  number_format((float)$item->proReal + $item->relleno + $item->pago - $item->retiro, 2, '.', '');
      }

      // echo "<pre>".json_encode($operations, JSON_PRETTY_PRINT)."</pre>";
      // return view('print/liquidacion', [
      //   'operations' => $operations,
      //   'sd' => $sd,
      //   'ed' => $ed,
      // ]);
      return response()->streamDownload(function () use ($operations, $sd, $ed) {
        echo view('print/liquidacion', [
          'operations' => $operations,
          'sd' => $sd,
          'ed' => $ed,
        ]);
      }, "LiquidacionDel{$sd}Al{$ed}.xls");
    }

    public function sala($sd, $ed) {
      $operations = Operation::with('machine')->whereBetween('created_at', [$sd, $ed])->get();

      return response()->streamDownload(function () use ($operations, $sd, $ed) {
        echo view('print/sala', [
          'operations' => $operations,
          'sd' => $sd,
          'ed' => $ed,
        ]);
      }, "MovimientosDel{$sd}Al{$ed}.xls");
    }

    public function relleno($sd, $ed, $position) {
      $operations = Operation::whereHas('machine', function($query) use ($position) {
        $query->where('position', $position);
      })->whereBetween('created_at', [$sd, $ed])->where('type', '0')->with('machine')->get();

      return response()->streamDownload(function () use ($operations, $sd, $ed, $position) {
        echo view('print/relleno', [
          'operations' => $operations,
          'sd' => $sd,
          'ed' => $ed,
          'position' => $position,
        ]);
      }, "RellenosDel{$sd}Al{$ed}Posicion{$position}.xls");
    }

    public function retiro($sd, $ed, $position) {
      $operations = Operation::whereHas('machine', function($query) use ($position) {
        $query->where('position', $position);
      })->whereBetween('created_at', [$sd, $ed])->where('type', '1')->with('machine')->get();

      return response()->streamDownload(function () use ($operations, $sd, $ed, $position) {
        echo view('print/retiro', [
          'operations' => $operations,
          'sd' => $sd,
          'ed' => $ed,
          'position' => $position,
        ]);
      }, "RetirosDel{$sd}Al{$ed}Posicion{$position}.xls");
    }

    public function pago($sd, $ed, $position) {
      $operations = Operation::whereHas('machine', function($query) use ($position) {
        $query->where('position', $position);
      })->whereBetween('created_at', [$sd, $ed])->where('type', '2')->with('machine')->get();

      return response()->streamDownload(function () use ($operations, $sd, $ed, $position) {
        echo view('print/pago', [
          'operations' => $operations,
          'sd' => $sd,
          'ed' => $ed,
          'position' => $position,
        ]);
      }, "PagosDel{$sd}Al{$ed}Posicion{$position}.xls");
    }
}
