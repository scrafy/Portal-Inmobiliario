<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    protected function getPaginationData($records_x_page, $total_records, $pag_actual) {
        $pagination = [];
        if ($total_records > 0) {
            $total_pages = $total_records % $records_x_page === 0 ? $total_records / $records_x_page : intval(($total_records / $records_x_page)) + 1;
            $pag_actual = $pag_actual > $total_pages ? $total_pages : $pag_actual;
            $pagination['total_pages'] = $total_pages;
            $pagination['records_x_page'] = $records_x_page;
            $pagination['limits_pages_to_show'] = intval(config("myparametersconfig.limit_pages_to_show"));
            $pagination['pag_actual'] = $pag_actual;
            $num_intervals = ($total_pages % $pagination['limits_pages_to_show']) === 0 ? ($total_pages / $pagination['limits_pages_to_show']) : intval(($total_pages / $pagination['limits_pages_to_show'])) + 1;
            $limits = $this->GetLimitPagination($num_intervals, $pagination['limits_pages_to_show'], $total_pages, $pag_actual);
            $pagination['limit_sup'] = $limits['limit_sup'];
            $pagination['limit_inf'] = $limits['limit_inf'];
        } else {
            $pagination['total_pages'] = 0;
            $pagination['records_x_page'] = $records_x_page;
            $pagination['limits_pages_to_show'] = config("myparametersconfig.limit_pages_to_show");
            $pagination['pag_actual'] = 0;
        }
        return (object) $pagination;
    }

    private function GetLimitPagination($num_intervals, $limits_page_to_show, $total_pages, $pag_actual) {
        $cont = 1;
        $interval = 0;
        $intervals = [];
        $result = [];
        while ($interval < $num_intervals) {
            for ($i = 0; $i < $limits_page_to_show; $i++) {
                if ($cont > $total_pages) {
                    break;
                }
                $intervals[$interval][] = $cont;
                $cont++;
            }
            $interval++;
        }
        foreach ($intervals as &$interval) {
            if (in_array($pag_actual, $interval)) {
                $result['limit_inf'] = $interval[0];
                $result['limit_sup'] = $interval[count($interval) - 1];
                return $result;
            }
        }
        $interval = $intervals[0];
        $result['lim_inf'] = $interval[0];
        $result['lim_sup'] = $interval[count($interval) - 1];
        return $result;
    }

}
