<?php
namespace App\Http\Controllers;

use App\Models\ChartOfAccount;
use App\Models\Category;
use Illuminate\Http\Request;

class CoaController extends Controller
{
    public function index()
    {
        return view('coa.index');
    }

    public function create()
    {
        $categories = Category::all();
        return view('coa.create', compact('categories'));
    }

    public function getData()
    {
        $data = ChartOfAccount::with('category')->select(['id', 'category_id', 'code', 'name'])->get();

        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'code' => 'required|string|max:50',
            'name' => 'required|string|max:255',
        ]);

        ChartOfAccount::create([
            'category_id' => $request->category_id,
            'code' => $request->code,
            'name' => $request->name,
        ]);

        return redirect()->route('coa.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function delete($id)
    {
        $category = ChartOfAccount::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
    
    public function edit($id)
    {
        $coa = ChartOfAccount::findOrFail($id);
        $categories = Category::all();
        return view('coa.edit', compact('coa', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'code' => 'required|string|max:50',
            'name' => 'required|string|max:255',
        ]);

        $coa = ChartOfAccount::findOrFail($id);
        $coa->update([
            'category_id' => $request->category_id,
            'code' => $request->code,
            'name' => $request->name,
        ]);

        return redirect()->route('coa.index')->with('success', 'Data berhasil ubah.');
    }

}

?>