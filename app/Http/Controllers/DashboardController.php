<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Acesso a tela inicial do dashboard.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $arquivos = array();
        $data = Carbon::now();
        for($c = 1; $c <= 13; $c++) {
            $arquivos[ucfirst($data->getTranslatedShortMonthName()."/".$data->format('Y'))] = Arquivo::porMesAno($data)->count();
            $data = $data->subMonth();
        }
        $arquivos = array_reverse($arquivos, true);

        return view('admin.dashboard', compact('arquivos'));
    }

    /**
     * Acesso a tela de visualização semanal do dashboard.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function semanal()
    {
        $arquivos = array();
        $arquivos_semana_anterior = array();
        $data = Carbon::parse('sunday this week');
        $data_passada = $data->parse('last sunday');
        for($c = 1; $c <= 7; $c++) {
            $arquivos[ucfirst($data->getTranslatedDayName())] = Arquivo::doDia($data)->count();
            $arquivos_semana_anterior[ucfirst($data->getTranslatedDayName())] = Arquivo::doDia($data_passada)->count();
            $data->addDay();
            $data_passada->addDay();
        }
        return view('admin.dashboard', compact('arquivos', 'arquivos_semana_anterior'));
    }
}