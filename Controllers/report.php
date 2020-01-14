<?php
    /**
     * Report Controller By Othman Abdulsalam
     *
     * When a client requests to see a report, a pop up appears allowing
     * the pdf to be downloaded anywhere in storage
     */




    //require the autoloader from dompdf
    require_once('../dompdf/autoload.inc.php');
    require_once('../Models/ReportInfoGetter.php');
    session_start();




    //reference dompdf namespace
    use Dompdf\Dompdf;

    //instantiate dompdf object
    $dompdf = new Dompdf();


    //load the content of the report.phtml

    ob_start();
    //grab the auditID
    $link = implode($_GET);
    var_dump($link);
    //var_dump($auditID); var_dump($clientID);
    //report info getter
    $reportInfo = new ReportInfoGetter();
    //grab the correct report from the database
    $audit = $reportInfo->getAudit($clientID,$auditID);

    $view = new stdClass();
    $view->test = $audit;

    include_once("../Views/report.phtml");

    $report = ob_get_clean();
    $dompdf->loadHtml($report);

    //setup report size
    $dompdf->setPaper('A4','portrait');

    $dompdf->render();
    //if view button was pressed
    if(isset($_POST['view']))
    {
            //open through browser
            $dompdf->stream("Audit Report", array("Attachment" => 0));
    }
    //else the download button was pressed
    else if (isset($_POST['download']))
    {
            //rendered as PDF
            //pdf is downloaded onto machine
            $dompdf->stream("Audit Report", array("Attachment" => 1));

    }
