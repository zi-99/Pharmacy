$enc = New-Object System.Text.UTF8Encoding $false

$adminController = @'
<?php

namespace App\Http\Controllers;

use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'medicine'])->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function accept(Order $order)
    {
        $order->update(['status' => 'accepted']);
        return redirect()->route('admin.orders')->with('success', 'Accepded ' . $order->id);
    }
}
'@
[System.IO.File]::WriteAllText("$PWD\app\Http\Controllers\AdminController.php", $adminController, $enc)

Write-Host "===== ADMIN CONTROLLER UPDATED ====="