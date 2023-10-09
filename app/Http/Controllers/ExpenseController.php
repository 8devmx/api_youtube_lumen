<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses =
            DB::table('expenses')
            ->join('users', 'expenses.user_id', '=', 'users.id')
            ->join('categories', 'expenses.category_id', '=', 'categories.id')
            ->select('expenses.*', 'categories.name as category_name', 'users.name as user_name')
            ->get();
        return response()->json(["expenses" => $expenses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "amount" => "required|numeric",
            "category" => "required|digits:1",
            "user" => "required|digits:1",
        ]);
        $expense = new Expense();
        $expense->date = $request->date;
        $expense->amount = $request->amount;
        $expense->category_id = $request->category;
        $expense->user_id = $request->user;
        $expense->repeat = $request->repeat;
        $expense->note = $request->note;
        $expense->save();

        return response()->json($expense);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = Expense::where('expenses.id', $id)
            ->join('users', 'expenses.user_id', '=', 'users.id')
            ->join('categories', 'expenses.category_id', '=', 'categories.id')
            ->select('expenses.*', 'categories.name as category_name', 'users.name as user_name')
            ->get();
        if (count($expense) < 1) {
            return response()->json(["error" => "Expense not found"]);
        }
        return response($expense);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "amount" => "required|numeric",
            "category" => "required|digits:1",
            "user" => "required|digits:1"
        ]);

        $expense = Expense::where('id', $id)->first();
        $expense->date = $request->date;
        $expense->amount = $request->amount;
        $expense->category_id = $request->category;
        $expense->user_id = $request->user;
        $expense->repeat = $request->repeat;
        $expense->note = $request->note;
        $expense->save();

        return response()->json($expense);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = Expense::where('id', $id)->first();
        if (!$expense) {
            return response()->json(["error" => "Expense not found"]);
        }
        $expense->delete();
        return response()->json(["data" => "Expense with id $id deleted successfully"]);
    }
}
