<?php

namespace App\Http\Controllers\Admin;

use Arcanedev\LogViewer\Http\Controllers\LogViewerController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests;

class IndexController extends LogViewerController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        $stats     = $this->logViewer->statsTable();
        $chartData = $this->prepareChartData($stats);
        $percents  = $this->calcPercentages($stats->footer(), $stats->header());
        return view('admin.index.index', compact('chartData', 'percents'));
    }
}
