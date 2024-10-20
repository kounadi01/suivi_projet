<?php
namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use DB;

abstract class UseSousIndicateurChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function chartisan()
    {
        $datas = $this->datas();
        return Chartisan::build()
            ->labels($datas->pluck('nom')->toArray())
            ->dataset("indicateurs" , $datas->pluck('id')->toArray());
    }

    protected function datas()
    {
        return DB::table('sous_indicateurs')
                    ->select('
                        count(*) sous_indicateurs.id', 
                        'indicateurs.lib_ind nom
                    ')
                    ->join('indicateurs', 'sous_indicateurs.indicateur_id', '=', 'indicateurs.id')
                    ->groupBy('nom', 'nom')
                    ->orderBy('nom', 'asc')
                    ->get();
    }
}