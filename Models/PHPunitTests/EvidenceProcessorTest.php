<?php
/*
 * Created by Michael Jarratt
 *
 * tests the EvidenceProcessor class
 */

use PHPUnit\Framework\TestCase;

require_once __DIR__."/../EvidenceProcessor.php";
require_once __DIR__."/../EvidenceQuery.php";
require_once __DIR__."/../Database.php";

class EvidenceProcessorTest extends TestCase
{

    public function testSubmitEvidence()
    {
        $evidenceProcessor = new EvidenceProcessor();
        $file = [];
        $file['name'] = "distillation_tower.jpg";
        $file['type'] = "image/jpg";
        $file['tmp_name'] =
        $evidenceProcessor->submitEvidence(1,1,"D:\\university\\Second Year\\SPAT\\project\\SPAT10\\evidence\\distillation_tower.jpg");
        $this->assertTrue(true);
    }
}
