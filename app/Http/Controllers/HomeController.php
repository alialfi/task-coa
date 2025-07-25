<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $selectedYear = $request->input('year', now()->format('Y'));
        $result = $this->getLaporanCOA($selectedYear);
        return view('home', compact('result'));
    }


    public function downloadExcel(Request $request)
    {
        $selectedYear = $request->input('year', now()->format('Y'));
        $result = $this->getLaporanCOA($selectedYear);
        return Excel::download(new LaporanExport($result), "laporan_{$selectedYear}.xlsx");
    }

    private function getLaporanCOA($selectedYear)
    {
        $categories = DB::table('categories')
            ->select('id', 'name', 'type')
            ->get();

        $transactions = DB::table('transactions')
            ->join('chart_of_accounts', 'transactions.chart_of_account_id', '=', 'chart_of_accounts.id')
            ->join('categories', 'chart_of_accounts.category_id', '=', 'categories.id')
            ->select(
                DB::raw("DATE_FORMAT(transactions.date, '%Y-%m') as month"),
                'categories.id as category_id',
                'categories.name as category',
                'categories.type as category_type',
                DB::raw('SUM(CASE WHEN categories.type = "income" THEN transactions.credit ELSE transactions.debit END) as amount')
            )
            ->whereYear('transactions.date', $selectedYear)
            ->groupBy('month', 'categories.id', 'categories.name', 'categories.type')
            ->orderBy('month')
            ->get();

        $result = [];
        $result['selectedYear'] = $selectedYear;

        $monthsInYear = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthStr = sprintf('%s-%02d', $selectedYear, $m);
            $monthsInYear[] = $monthStr;
        }

        $result['months'] = $monthsInYear;

        foreach ($categories as $cat) {
            $result['categories'][$cat->id] = [
                'name' => $cat->name,
                'type' => $cat->type,
                'months' => []
            ];
        }

        foreach ($transactions as $row) {
            $result['categories'][$row->category_id]['months'][$row->month] = $row->amount;
        }

        foreach ($monthsInYear as $month) {
            $income = 0;
            $expense = 0;

            foreach ($result['categories'] as $cat) {
                $amount = $cat['months'][$month] ?? 0;
                if ($cat['type'] === 'income') {
                    $income += $amount;
                } else {
                    $expense += $amount;
                }
            }

            $result['totals'][$month] = [
                'income' => $income,
                'expense' => $expense,
                'net' => $income - $expense,
            ];
        }

        return $result;
    }   

}



