<?php

defined('_JEXEC') or die;

class markasreadController extends JControllerLegacy
{
  /**
   * TODO
   *
   * @return  void
   */
  public function markread()
  {
    $this->setRedirect('http://localhost/index.php/2-uncategorised/1-test-article');
    // $id = $this->input->getInt('id', 0);
    
    // if ($id)
    // {
    //   $model = $this->getModel('Banner', 'BannersModel', array('ignore_request' => true));
    //   $model->setState('banner.id', $id);
    //   $model->click();
    //   $this->setRedirect('http://localhost/index.php/2-uncategorised/1-test-article');
    // }
  }
}
