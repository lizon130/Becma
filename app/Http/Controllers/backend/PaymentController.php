<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\PaymentRecord;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function showOfflinePaymentForm()
    {
        return view('backend.pages.payments.offline');
    }

    public function submitOfflinePayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
            'payment_details' => 'required',
        ]);

        PaymentRecord::create([
            'seller_id' => Auth::id(),
            'payment_method' => $request->payment_method,
            'payment_details' => $request->payment_details,
            'status' => 'pending',
        ]);

        return redirect()->route('seller.payments.history')->with('success', 'Offline payment request submitted successfully!');
    }

    public function showPaymentHistory()
    {
        $payments = PaymentRecord::where('seller_id', Auth::id())->get();
        return view('backend.pages.payments.history', compact('payments'));
    }

        public function adminPaymentHistory()
    {
        $payments = PaymentRecord::with('seller')->get();
        return view('backend.pages.payments.admin.history', compact('payments'));
    }

        public function editPayment($id)
    {
        $payment = PaymentRecord::findOrFail($id);
        return view('backend.pages.payments.admin.edit', compact('payment'));
    }

        public function updatePayment(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,rejected',
        ]);

        $payment = PaymentRecord::findOrFail($id);
        $payment->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.payments.history')->with('success', 'Payment status updated successfully!');
    }

    public function deletePayment($id)
    {
        $payment = PaymentRecord::findOrFail($id);
        $payment->delete();

        return redirect()->route('admin.payments.history')->with('success', 'Payment record deleted successfully!');
    }





}
