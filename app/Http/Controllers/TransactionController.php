<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())
            ->orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalPemasukan = $transactions->where('type', 'pemasukan')->sum('amount');
        $totalPengeluaran = $transactions->where('type', 'pengeluaran')->sum('amount');
        $saldo = $totalPemasukan - $totalPengeluaran;

        return view('dashboard', compact('transactions', 'totalPemasukan', 'totalPengeluaran', 'saldo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type'             => 'required|in:pemasukan,pengeluaran',
            'amount'           => 'required|numeric|min:1',
            'description'      => 'required|string|max:255',
            'transaction_date' => 'required|date',
        ]);

        Transaction::create([
            'user_id'          => Auth::id(),
            'type'             => $request->type,
            'amount'           => $request->amount,
            'description'      => $request->description,
            'transaction_date' => $request->transaction_date,
        ]);

        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function edit(Transaction $transaction)
    {
        abort_if($transaction->user_id !== Auth::id(), 403);
        return view('edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        abort_if($transaction->user_id !== Auth::id(), 403);

        $request->validate([
            'type'             => 'required|in:pemasukan,pengeluaran',
            'amount'           => 'required|numeric|min:1',
            'description'      => 'required|string|max:255',
            'transaction_date' => 'required|date',
        ]);

        $transaction->update($request->only(['type', 'amount', 'description', 'transaction_date']));

        return redirect()->route('dashboard')->with('success', 'Data Kas berhasil diperbarui!');
    }

    public function destroy(Transaction $transaction)
    {
        abort_if($transaction->user_id !== Auth::id(), 403);
        $transaction->delete();
        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil dihapus!');
    }
}