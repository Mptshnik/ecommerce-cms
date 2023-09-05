<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function index()
    {
        $invoices = Invoice::all();

        return view('invoices.index', compact('invoices'));
    }


    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }


    public function destroy(Invoice $invoice)
    {

        $invoice->delete();

        return redirect()->route('invoices.index')
            ->with('success', 'Запись успешно удалена');
    }
}
