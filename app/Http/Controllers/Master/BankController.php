<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payments\Bank;

class BankController extends Controller
{
    public function index(Request $request)
    {
     $banks = Bank::orderBy('bank_name','asc')->get();
     return view('master.bank.index', compact('banks'));
    }

    public function add(Request $request)
    {
        return view('master.bank.add');
    }
    public function edit($id)
    {
        $bank = Bank::find($id);
        return view('master.bank.edit',compact('bank'));
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'bank_name' => 'required',
            'bank_account_name' => 'required',
            'bank_account_no' => 'required',
        ]);
        $bank = Bank::create($request->all());
        logCreate(auth()->user()->id,$request->bank_name.' - '.$request->bank_account_no,'Bank');

        if ($request->hasFile('bank_logo')) {
             $request->file('bank_logo')->move('images/bank',$request->file('bank_logo')->getClientOriginalName());
             $bank->bank_logo = $request->file('bank_logo')->getClientOriginalName();
             $bank->save();
        }
        return redirect()->route('bank.index')->with('sukses','Data Berhasil disimpan');
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
             'bank_name' => 'required',
             'bank_account_name' => 'required',
             'bank_account_no' => 'required'
        ]);
        $update = Bank::findOrFail($id)->update($request->all());
        logUpdate(auth()->user()->id,$request->bank_name.' - '.$request->bank_account_no,'Bank');

        return redirect()->route('bank.index')->with('sukses','Data Berhasil disimpan');
    }
    public function delete($id)
    {
        $bank = Bank::findOrFail($id);
        $bank->delete($bank);
        logDelete(auth()->user()->id,$bank->bank_name.' - '.$bank->bank_account_no,'Bank');
        return redirect()->route('bank.index')->with('sukses','Data Berhasil dihapus');
    }
}
