<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getAll()
    {
        try {
            $items = Items::orderBy('id', 'DESC');
            $itemPaginate = $items->paginate(10);
            $listItems = $itemPaginate->getCollection()->transform(function($item){
                $transform = [
                    'id'=>$item->id,
                    'item_name'=>$item->item_name,
                    'price'=>$item->price,
                    'qty'=>$item->qty
                ];
                return $transform;
            });
            return $this->formatResponse(
                $this->meta($itemPaginate),
                $listItems,
                $this->formatPaging($itemPaginate),
                'Success',200
            );
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'price'=>'required|numeric',
            'qty'=>'required|numeric'
        ]);

        try {
            $item = new Items;
            $item->item_name = $request->name;
            $item->price = $request->price;
            $item->qty = $request->qty;
            $item->save();

            return response('Success', 201);
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'price'=>'required|numeric',
            'qty'=>'required|numeric'
        ]);

        try {
            $item = Items::find($id);
            $item->item_name = $request->name;
            $item->price = $request->price;
            $item->qty = $request->qty;
            $item->save();

            return response('Success', 201);
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $item = Items::find($id);
            $item->delete();

            return response('Success', 200);
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }
}
