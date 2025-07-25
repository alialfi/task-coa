<?php
namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\ChartOfAccount;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transactions.index');
    }

    public function create()
    {
        $coa = ChartOfAccount::orderBy('code')->get();
        return view('transactions.create', compact('coa'));
    }

    public function getData()
    {
        $data = Transaction::with('chart_of_account')->select(['id', 'chart_of_account_id', 'date', 'description', 'debit', 'credit'])->get();
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'chart_of_account_id' => 'required|exists:chart_of_accounts,id',
            'description' => 'required|string|max:255',
            'debit' => 'required|numeric|min:0',
            'credit' => 'required|numeric|min:0',
        ]);

        Transaction::create([
            'date' => $request->date,
            'chart_of_account_id' => $request->chart_of_account_id,
            'description' => $request->description,
            'debit' => $request->debit,
            'credit' => $request->credit
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    public function delete($id)
    {
        $category = Transaction::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Transaksi berhasil dihapus']);
    }

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $coa = ChartOfAccount::orderBy('code')->get();
        return view('transactions.edit', compact('transaction', 'coa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'chart_of_account_id' => 'required|exists:chart_of_accounts,id',
            'description' => 'required|string|max:255',
            'debit' => 'required|numeric|min:0',
            'credit' => 'required|numeric|min:0',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'date' => $request->date,
            'chart_of_account_id' => $request->chart_of_account_id,
            'description' => $request->description,
            'debit' => $request->debit,
            'credit' => $request->credit,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ubah.');
    }

}
?>