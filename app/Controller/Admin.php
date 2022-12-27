<?php

namespace App\Controller;

use App\Model\Message;
use Base\AbstractController;

class Admin extends AbstractController
{
    public function preDispatch()
    {
        parent::preDispatch();
        if (!$this->getUser() || !$this->getUser()->isAdmin()) {
            $this->redirect('/index.php');
        }
    }

    public function deleteMessage()
    {
        $messageId = (int) $_GET['id'];
        Message::deleteMessage($messageId);
        $this->redirect('/index.php/blog');
    }
}
