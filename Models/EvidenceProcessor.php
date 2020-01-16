<?php
/*
 * Made by Michael Jarratt
 *
 * This class is responsible for handling uploaded files, ensuring they are stored
 * properly and are registered in the database correctly.
 */

require_once __DIR__."/EvidenceQuery.php";

class evidenceProcessor
{

    private $evidenceQuery;

    public function __construct()
    {
        $this->evidenceQuery = new EvidenceQuery();
    }


    public function submitEvidence($evidence)
    {
        $pathParts = pathinfo($evidence); //gets information about the file
        $type = ""; //the type of file
        $extension = $pathParts['extension'];
        $allowedImages = ["jpg","png"];


        if(in_array($extension,$allowedImages))
        {
            $type = "Image";
        }
    }

}