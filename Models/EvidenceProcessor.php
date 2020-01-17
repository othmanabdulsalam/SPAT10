<?php
/*
 * Made by Michael Jarratt
 *
 * This class is responsible for handling uploaded files, ensuring they are stored
 * properly and are registered in the database correctly.
 */

require_once __DIR__."/EvidenceQuery.php";

class EvidenceProcessor
{

    private $evidenceQuery;

    public function __construct()
    {
        $this->evidenceQuery = new EvidenceQuery();
    }


    /**
     * @param $auditID
     * @param $questionID
     * @param File $evidence
     * @throws Exception
     */
    public function submitEvidence($auditID,$questionID,$evidence)
    {
        $pathParts = pathinfo($evidence); //gets information about the file
        $type = $this->getType($pathParts['extension']); //gets type of file

        $numberExtension = $this->evidenceQuery->getNumEvidence($type)+1; //number of (eg) videos already present +1 (ensures no file name conflicts)
        $newFileName = $type.$numberExtension; //creates name that will not conflict
        move_uploaded_file($evidence['tmp_name'],"/../evidence/".$newFileName); //moves file from temporary directory to permanent with new name
        $this->evidenceQuery->insertNewEvidence($auditID,$questionID,$type,$newFileName); //creates database entry

    }

    //checks if file already exists (duplicate names)
    private function exists($pathParts)
    {
        return file_exists("/../evidence/".$pathParts['filename'].".".$pathParts['extension']);
    }

    /**
     * Checks if an extension is legal and returns the file type.
     * Throws exception of extension is illegal.
     *
     * @param String $extension of file
     * @return string
     * @throws Exception
     */
    private function getType($extension)
    {
        $allowedImages = ["jpg","png"];
        $allowedVideos = ["mp4","mov"];
        $allowedAudio = ["wav","mp3"];
        $allowedDocuments = ["docx","pdf","txt"];

        if(in_array($extension,$allowedImages)) //checks if extension is in array
        {
            $type = "image"; //sets type of file
        }
        elseif(in_array($extension,$allowedVideos))
        {
            $type = "video";
        }
        elseif(in_array($extension,$allowedAudio))
        {
            $type = "audio";
        }
        elseif(in_array($extension,$allowedDocuments))
        {
            $type = "doc";
        }
        else
        {
            throw new Exception("File type not recognised");
        }
        return $type;
    }

}