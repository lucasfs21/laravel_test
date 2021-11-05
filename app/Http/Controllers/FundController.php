<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use App\Models\Patrimony;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class FundController extends Controller
{
    public function index() {
        $patrimonies = Patrimony::all();

        foreach ($patrimonies as $key => $patrimony) {
            $patrimonies[$key]->fund_name = $patrimony->fund->name;
        }

        $data = $patrimonies->toArray();

        return view("fundo.index", compact('data'));
    }

    public function new()
    {
        $funds = Fund::all();
        $data = $funds->toArray();

        return view("fundo.new", compact('data'));
    }

    public function save(Request $request) {
        try {
            Patrimony::create($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Novo patrimônio adicionado com sucesso'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Falha ao adicionar novo patrimônio'
            ]);
        }
    }

    public function update(Request $request)
    {
        try {
            $patrimony = Patrimony::find($request->id);
            $patrimony->fill($request->all())->save();
            return response()->json([
                'success' => true,
                'message' => 'Patrimônio atualizado com sucesso'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Falha ao tentar atualizar dados do patrimônio'
            ]);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $patrimony = Patrimony::find($id)->toArray();
            $funds = Fund::all();
            $data = $funds->toArray();

            return view("fundo.edit", compact('data', 'patrimony', 'id'));
        } catch (\Exception $e) {
            return response()->redirectTo(route('patrimonies.index'));
        }
    }

    public function delete(Request $request)
    {
        try {
            Patrimony::find($request->id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Patrimônio excluído com sucesso'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Falha ao tentar deletar patrimônio'
            ]);
        }
    }

    public function searchForFundAssets(Request $request) {
        $patrimonies = Patrimony::where([['date', '>=', $request->startDate], ['date', '<=', $request->endDate]])->orderBy('date')->get();

        if (count($patrimonies) == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Sem informações para o período selecionado'
            ]);
        }

        $startDate = new \DateTime($request->startDate);
        $endDate = new \DateTime($request->endDate);

        $interval = $startDate->diff($endDate);

        $currentDate = $startDate;
        $formattedCurrentDate = $currentDate->format('Y-m-d');

        $funds = [];

        for ($x = 0; $x <= $interval->days; $x++) {
            if ($x == 0) {
                foreach ($patrimonies as $key => $patrimony) {
                    if (!array_key_exists($patrimony->fund_id, $funds)) {
                        $funds[$patrimony->fund->id]['name'] = $patrimony->fund->name;
                        $funds[$patrimony->fund->id]['data'] = [];
                    }
                }
            }

            foreach ($funds as $key => $fund) {
                $value = 0;
                foreach ($patrimonies as $patrimony) {
                    if ($key == $patrimony->fund_id) {
                        if ($formattedCurrentDate == $patrimony->date) {
                            $value += floatval($patrimony->value);
                        }
                    }
                }
                array_push($funds[$key]['data'], $value);
            }

            $currentDate->add(new \DateInterval('P1D'));
            $formattedCurrentDate = $currentDate->format('Y-m-d');
        }

        $data = [];
        foreach ($funds as $fund) {
            array_push($data, $fund);
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

}
