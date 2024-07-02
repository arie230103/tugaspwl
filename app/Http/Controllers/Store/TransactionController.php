<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(string $id)
    {
        return view("store.pages.transactions.index", compact(['id']));
    }

    public function store(Request $request)
    {
        $transaction = Transaction::create([
            'user_id'       => Auth::user()->id,
            'total_price'   => $request->total_price,
            'status'        => 1
        ]);

        foreach ($request->detail as $key => $value) {
            TransactionDetail::create([
                'transaction_id'        => $transaction->id,
                'product_id'            => $value['product_id'],
                'quantity'              => $value['quantity'],
                'price'                 => $value['price'],
                'subtotal'              => $value['subtotal']
            ]);
        }

        return response()->json([
            'status'        => true,
            'transaction'   => $transaction
        ]);
    }

    function upload(Request $request, string $id)
    {
        $transaction = Transaction::find($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
            $image_path = $file->move('storage/transactions', $filename);
        } else {
            $image_path = null;
        }

        $transaction->update([
            'transfer_path'     => $image_path
        ]);

        return redirect()->route('store.index');
    }
}
