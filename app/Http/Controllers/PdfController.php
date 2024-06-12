<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generateFile () {
        $pdf = Pdf::loadView('pdf.view-dismantling');
        return $pdf->download('view-dismantling.pdf');
    }
}
