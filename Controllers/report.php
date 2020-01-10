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


    //if view button was pressed
    if(isset($_POST['view']))
    {
        //open through browser
        $dompdf->render();
    }

    //else the download button was pressed
    else if (isset($_POST['download']))
    {
        //rendered as PDF
        $dompdf->render();
        //pdf is downloaded onto machine
        $dompdf->stream("Audit Report", array("Attachment" => 0));
    }
