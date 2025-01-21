<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use joshtronic\LoremIpsum;
class PracticeController extends Controller
{
    public function index()
    {
        $lipsum = new LoremIpsum();
        $practiceText = $lipsum->sentences(5);

        return view('practice', compact('practiceText'));
    }
}
