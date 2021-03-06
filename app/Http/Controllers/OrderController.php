<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\Order;
use App\Size;
use App\SizeColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
//    private $order;

//    public function __construct()
//    {
////        $this->order = new Order();
//    }

    public function index()
    {
        return view('orders.index')->with([
            'orders' => Order::all()
        ]);
    }
//
//    public function ajaxOrder()
//    {
//        $order = Order::all();
//        return DataTables::of($order)
//            ->editColumn('buyer_id', function ($order) {
//                return $order->buyer->name;
//            })
//            ->addColumn('action', function ($order) {
//                return $order->id;
//            })
//            ->make(true);
//    }

    public function show($id)
    {
        try {
            $order = Order::where('id', $id)->with('styles.color_styles.sizes')->first();
        } catch (\SQLiteException $exception) {

        } catch (\RuntimeException $exception) {

        } catch (\Exception $exception) {

        }
        return view('orders.details', ['order' => $order, 'sizes' => Size::all()]);
    }

    public function create()
    {
        $buyers = Buyer::all()->where('activity', '=', '1');
        return view('orders.create', ['buyers' => $buyers]);
    }

    public function store(Request $request)
    {
        try {
            $order = new Order();
            $order->program_code = $request->program_code;
            $order->buyer_id = $request->buyer_id;
            $order->date = $request->date;
            $order->save();
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->back()->with([
                'message' => $e->getMessage(),
                'status' => 'danger'
            ]);
        }
//        Session::put('message', 'Order Stored Successfully');
        return redirect(route('orders.create'))->with([
            'message' => 'Order Stored Successfully!',
            'status' => 'success'
        ]);
    }

    public function edit($id)
    {
        try {
            $order = Order::find($id);
            $buyers = Buyer::all();
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->back()->with([
                'message' => $e->getMessage(),
                'status' => 'danger'
            ]);
        }
        return view('orders.edit', ['order' => $order, 'buyers' => $buyers]);
    }

    public function update(Request $request, $id)
    {
        try {
            $order = Order::find($id);
            $order->program_code = $request->program_code;
            $order->buyer_id = $request->buyer_id;
            $order->date = $request->date;
            $order->save();
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->back()->with([
                'message' => $e->getMessage(),
                'status' => 'danger'
            ]);
        }
        return redirect(route('orders.index'))->with([
            'message' => 'Order Updated Successfully',
            'status' => 'success'
        ]);
    }

    public function destroy($id)
    {
        try {
            $order = Order::find($id);
            $order->delete();
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->back()->with([
                'message' => $e->getMessage(),
                'status' => 'danger'
            ]);
        }
        return redirect(route('orders.index'))->with([
            'message' => 'Order Deleted Successfully',
            'status' => 'success'
        ]);
    }
}
