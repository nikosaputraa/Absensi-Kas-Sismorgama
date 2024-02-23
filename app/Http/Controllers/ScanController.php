<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
// use Carbon\Carbon;
use Illuminate\Support\Str;

class ScanController extends Controller
{
    public function scanabsen()
    {
        return view('pages.scan');
    }
    
}