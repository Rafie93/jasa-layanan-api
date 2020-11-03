<?php

namespace App\Http\Controllers\Firebase;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kreait\Firebase\ServiceAccount;

class FirebaseController extends Controller
{
    public function index()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/FirebaseKey.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();
        $database = $firebase->getDatabase();
        $ref = $database->getReference('Subjects');
        $key = $ref->push()->getKey();
        $ref->getChild($key)->set([
            'SubjectName' => 'Laravel'
        ]);
        return $key;
    }
}
