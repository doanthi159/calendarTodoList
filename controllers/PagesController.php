<?php
require_once('controllers/BaseController.php');
require_once('models/TodoModel.php');

class PagesController extends BaseController
{
    function __construct()
    {
        $this->sFolder = 'pages';
    }

    public function home()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ((strtotime($_POST['start'])) > (strtotime($_POST['end']))) {
                $aMessageError['message'] = 'start date is greater than end date';
                $this->error($aMessageError);
            }
            $aData = array(
                'title' => $_POST['title'],
                'start_date' => $_POST['start'],
                'end_date' => $_POST['end'],
                'status' => $_POST['status']
            );
            if (isset($_POST["id"]) && $_POST["id"] !== '') {
                $aData['id'] = $_POST['id'];
                $bResult = TodoModel::updateTaskById($aData);
                if ($bResult === false) {
                    $aMessageError['message'] = 'Update fail';
                }
            } else {
                $bResult = TodoModel::registTask($aData);
                if ($bResult === false) {
                    $aMessageError['message'] = 'Regist fail';
                }
            }
            if (isset($aMessageError['message'])) {
                $this->error($aMessageError);
            }
        }
        $this->render('home');
    }

    /**
     * Get all task
     */
    public function getAllListTask()
    {
        $oResult = TodoModel::all();
        $aData = array();
        foreach($oResult as $aRows)
        {
            $aData[] = array(
                'id'      => $aRows["id"],
                'title'   => $aRows["work_name"],
                'start'   => $aRows["start_date"],
                'end'     => $aRows["end_date"],
                'status'  => $aRows["status"]
            );
        }
        echo json_encode($aData);
    }

    /**
     * update task
     */
    public function updateTask()
    {
        if (isset($_POST["id"])) {
            if (isset($_POST['delete_flag']) && $_POST['delete_flag'] == 1) {
                $aData = array(
                    'delete_flag' => $_POST['delete_flag'],
                    'id' => $_POST['id']
                );
                $bResult = TodoModel::updateDeleteFlagTaskById($aData);
                if ($bResult === false) {
                    $aMessageError['message'] = 'delete fail';
                }
            } else {
                if ((strtotime($_POST['start'])) > (strtotime($_POST['end']))) {
                    $aMessageError['message'] = 'start date is greater than end date';
                    $this->error($aMessageError);
                }
                $aData = array(
                    'title' => $_POST['title'],
                    'start_date' => $_POST['start'],
                    'end_date' => $_POST['end'],
                    'status' => $_POST['status'],
                    'id' => $_POST['id']
                );
                $bResult = TodoModel::updateTaskById($aData);
                if ($bResult === false) {
                    $aMessageError['message'] = 'delete fail';
                }
            }
            echo json_encode($bResult);
        }
    }

    public function error($aMessageError=[])
    {
        $this->render('error', $aMessageError);
    }
}
