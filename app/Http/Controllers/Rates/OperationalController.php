<?php

namespace App\Http\Controllers\Rates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manifests\ManifestQuery;
use App\Models\Manifests\Manifest;

class OperationalController extends Controller
{
    //
    public function __construct(ManifestQuery $queryObject)
    {
        $this->queryObject = $queryObject;
    }
    public function index(Request $request)
    {
       $operationals = Manifest::orderBy('id','desc')
                                ->whereNotNull('travel_license_number')
                                ->where(function ($query) {
                                    if (!auth()->user()->isSuperAdmin() ){
                                        $query->where('orig_branch_id', auth()->user()->branch_id);
                                    }
                                    if (!auth()->user()->isPusat() ){
                                        $query->where('orig_branch_id', auth()->user()->branch_id);
                                    }
                                })
                                ->paginate(10);

        return view('accounting.operational.index',compact('operationals'));
    }
}
