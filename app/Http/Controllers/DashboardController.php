<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->endOfMonth();
        
        $earning = Order::whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
                ->sum('total');
        return view('admin.pages.dashboard', ['earning'=> $earning]);
    }

}