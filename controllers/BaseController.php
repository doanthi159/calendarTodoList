<?php
class BaseController
{
  protected $sFolder;

  function render($sFile, $aData = array())
  {
    $sViewFile = 'views/' . $this->sFolder . '/' . $sFile . '.php';
    if (is_file($sViewFile)) {
      extract($aData);
      ob_start();
      require_once($sViewFile);
      $sContent = ob_get_clean();
      require_once('views/layouts/application.php');
    } else {
      header('Location: index.php?controller=pages&action=error');
    }
  }
}