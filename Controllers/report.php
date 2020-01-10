<?php
    /**
     * Report Controller By Othman Abdulsalam
     *
     * When a client requests to see a report, a pop up appears allowing
     * the pdf to be downloaded anywhere in storage
     */


    //require the autoloader from dompdf
    require_once('../dompdf/autoload.inc.php');

    //reference dompdf namespace
    use Dompdf\Dompdf;

    //instantiate dompdf object
    $dompdf = new Dompdf();

    //load the content of the report.phtml
    $report = file_get_contents("../Views/report.phtml");
    $dompdf->loadHtml($report);

    //setup report size
    $dompdf->setPaper('A4','portrait');

    //rendered as PDF
    $dompdf->render();

    //PDF is now output, pop up appears because of value "1"
    $dompdf->stream("Audit Report", array("Attachment" => 1));
