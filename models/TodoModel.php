<?php
class TodoModel
{
    public $sId;
    public $sWorkName;
    public $sStartDate;
    public $sEndDate;
    public $nStatus;

    function __construct($sId, $sWorkName, $sStartDate, $sEndDate, $nStatus)
    {
        $this->id = $sId;
        $this->workName = $sWorkName;
        $this->startDate = $sStartDate;
        $this->endDate = $sEndDate;
        $this->status = $nStatus;
    }

    static function all()
    {
        $db = DB::getInstance();
        $sQuery = "SELECT * FROM todolist";
        $oQuery = $db->prepare($sQuery);
        $oQuery->execute();
        $aData = $oQuery->fetchAll();
        return $aData;
    }

    static function updateTaskById($aData)
    {
        $db = DB::getInstance();
        $sQuery = "UPDATE todolist 
                  SET work_name='{$aData['title']}', start_date='{$aData['start_date']}', end_date='{$aData['end_date']}', status={$aData['status']}, update_date=NOW() 
                  WHERE id={$aData['id']}";
        $oQuery = $db->prepare($sQuery);
        return $oQuery->execute();
    }

    static function registTask($aData)
    {
        $db = DB::getInstance();
        $sQuery = "INSERT INTO todolist  (work_name, start_date, end_date, status, create_date)  VALUES ('{$aData['title']}', '{$aData['start_date']}', '{$aData['end_date']}', '{$aData['status']}', NOW())";
        $oQuery = $db->prepare($sQuery);
        return $oQuery->execute();
    }
}