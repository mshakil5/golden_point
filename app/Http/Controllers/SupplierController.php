<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;
Use Image;
use Illuminate\support\Facades\Auth;

class SupplierController extends Controller
{
    public function index()
    {
        $data = Supplier::orderby('id','DESC')->get();
        return view('admin.supplier.index',compact('data'));
    }
    
    public function store(Request $request)
    {

        if(empty($request->name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Name \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $chkemail = Supplier::where('name',$request->name)->first();
        if($chkemail){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>This \"Name \" already added. Please Change Name.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->phone)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Phone \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $data = new Supplier();
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->address = $request->address;
        // intervention
        if ($request->image != 'null') {
            $originalImage = $request->file('image');
            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath = public_path().'/images/thumbnail/';
            $originalPath = public_path().'/images/';
            $time = time();
            $thumbnailImage->save($originalPath.$time.$originalImage->getClientOriginalName());
            $thumbnailImage->resize(150,150);
            $thumbnailImage->save($thumbnailPath.$time.$originalImage->getClientOriginalName());
            $data->image = $time.$originalImage->getClientOriginalName();
        }
        // end
        $data->balance = $request->balance;
        $data->status = "1";
        $data->created_by = Auth::user()->id;
        if ($data->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        } else {
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function edit($id)
    {
        $where = [ 'id'=>$id ];
        $info = Supplier::where($where)->get()->first();
        return response()->json($info);
    }

    public function update(Request $request, $id)
    {

        if(empty($request->name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Name \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $chkemail = Supplier::where('name',$request->name)->where('id','!=', $id)->first();
        if($chkemail){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>This \"Name \" already added. Please Change Name.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->phone)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Phone \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }


        $data = Supplier::find($id);
        if($request->image != 'null'){
            $originalImage= $request->file('image');
            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath = public_path().'/images/thumbnail/';
            $originalPath = public_path().'/images/';
            $time = time();
            $thumbnailImage->save($originalPath.$time.$originalImage->getClientOriginalName());
            $thumbnailImage->resize(150,150);
            $thumbnailImage->save($thumbnailPath.$time.$originalImage->getClientOriginalName());
            $data->image= $time.$originalImage->getClientOriginalName();
        }
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->balance = $request->balance;
            $data->status = "1";
            $data->updated_by = Auth::user()->id;
        if ($data->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function delete($id)
    {
        
        if(Supplier::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Listing Deleted']);
        }else{
            return response()->json(['success'=>false,'message'=>'Server Error!!']);
        }
    }

    public function getsupplier(Request $request)
    {
        $supplierDtl = Supplier::where('id', '=', $request->supplier_id)->first();
        if(empty($supplierDtl)){
            return response()->json(['status'=> 303,'message'=>"No data found"]);
        }else{
            return response()->json(['status'=> 300,'name'=>$supplierDtl->name,'balance'=>$supplierDtl->balance]);
        }
    }

    public function supplierDeposit(Request $request)
    {
        if(empty($request->type)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Transaction Type \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->account_id)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Account Name \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->amount)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Amount \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $supplier = Supplier::find($request->supplierid);
        $supplier->balance = $supplier->balance + $request->amount;
        if ($supplier->save()) {
            $data = new Transaction();
            $data->supplier_id = $request->supplierid;
            $data->date = $request->date;
            $data->description = $request->description;
            $data->type = $request->type;
            $data->account_id = $request->account_id;
            $data->amount = $request->amount;
            $data->status = "1";
            $data->created_by = Auth::user()->id;
            $data->save();

            $balance = Account::find($request->account_id);
            $balance->amount = $balance->amount + $request->amount;
            $balance->save();

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        } else {
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function getSupplierTransaction($id)
    {
        $data = Transaction::orderby('id','DESC')->where('supplier_id',$id)->get();
        return view('admin.supplier.tran',compact('data'));
    }

    public function supplierTranUpdate(Request $request)
    {
        if(empty($request->type)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Transaction Type \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->account_id)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Account Name \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->amount)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Amount \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        $prevtran = Transaction::where('id',$request->codeid)->first();


        $prevbalance = Account::find($prevtran->account_id);
        $prevbalance->amount = $prevbalance->amount - $prevtran->amount;
        $prevbalance->save();

        $supplier = Supplier::find($request->supplier_id);
        $supplier->balance = $supplier->balance - $prevtran->amount + $request->amount;
        if ($supplier->save()) {
            $data = Transaction::find($request->codeid);
            $data->date = $request->date;
            $data->description = $request->description;
            $data->type = $request->type;
            $data->account_id = $request->account_id;
            $data->amount = $request->amount;
            $data->status = "1";
            $data->created_by = Auth::user()->id;
            $data->save();

            $balance = Account::find($request->account_id);
            $balance->amount = $balance->amount + $request->amount;
            $balance->save();

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        } else {
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }





}
