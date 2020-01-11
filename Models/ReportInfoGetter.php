<?php
/*
 * created by Michael Jarratt
 *
 * this class is responsible for providing a simple API to retrieve information needed
 * to create the report from the database
 */

require_once __DIR__."/AuditQuery.php";
require_once __DIR__."/UserQuery.php";
require_once __DIR__."/QuestionQuery.php";
require_once __DIR__."/SubCatQuery.php";
require_once __DIR__."/CategoryQuery.php";

require_once __DIR__."/Database.php"; //temporary to make queries faster MUST REMOVE and separate queries into their classes

class ReportInfoGetter
{
    private $auditQuery;
    private $userQuery;
    private $questionQuery;
    private $subCatQuery;
    private $categoryQuery;

    public function __construct()
    {
        $this->auditQuery = new AuditQuery();
        $this->userQuery = new UserQuery();
        $this->questionQuery = new QuestionQuery();
        $this->subCatQuery = new SubCatQuery();
        $this->categoryQuery = new CategoryQuery();
    }

    /*
     * gets all information needed to create a report for specific audit
     * and returns it in an associatively index array
     */
    public function getAudit($clientID, $auditID)
    {
        $reportInfo = []; //array in which information will be gathered to be passed out
        $reportInfo['audit'] = $this->auditQuery->getAudit($auditID); //location, date scored
        $reportInfo['user'] = $this->userQuery->getUsername($clientID); //name of client
        //$reportInfo['subCatDescription'] = $this->getSubcatagory($catID);//gets subcatagory name
        $reportInfo['questions'] = $this->questionQuery->getAuditQuestions($auditID); //Questions
        //$reportInfo['score'] = $this->ScoreQuery->getScores($auditID); //Scores
        //$reportInfo['comment'] = $this->CommentQuery->getComments($auditID);// comments scorer made
        //$reportInfo['complianceBand'] = $this->ComplianceQuery->getComplianceBand($percentileID);// compliance band
        $reportInfo['reportContent'] = $this->getContent('auditID');

        return $reportInfo;
    }

    /*
     * this function gets data and creates the datastructure containing all
     * information to be presented in the report
     */
    private function getContent($auditID)
    {
        //gets Question IDs
        $questionIDs = $this->questionQuery->getQuestionIDs($auditID);
        //gets SubCategory IDs
        $subCatIDs = $this->subCatQuery->getCatID(join(",",$questionIDs)); //join turns array to comma separated string -> "1,2,3"...
        //gets Category IDs
        $categoryIDs = $this->categoryQuery->getCategoryIDs(join(",",$subCatIDs));

        //$content = []; //root of datastructure - array of categories

        $content = $this->categoryQuery->getCategories(join(",",$categoryIDs));

        var_dump($content);
        return 1;
    }

/*$database = Database::getInstance();
    //Question IDs
$questionIDs = $this->questionQuery->getQuestionIDs($auditID);
$questionIDs = join(",",$questionIDs); //turns array into comma separated list

    //SubCategory IDs
$subcatIDs = $database->retrieve("SELECT DISTINCT subCatID FROM Questions
                                                WHERE questionID IN ($questionIDs)");
$temp = [];
foreach ($subcatIDs as $tuple)
{
array_push($temp, $tuple['subCatID']); //extracts subCatIDs from tuples
}
$subcatIDs = $temp;
$subcatIDs = join(",",$subcatIDs); //turns into a comma seporated list

//Category IDs
$catiDs = $database->retrieve("SELECT DISTINCT catID FROM SubCategories WHERE subCatID in (\"$subcatIDs\")");
var_dump($catiDs);*/
}