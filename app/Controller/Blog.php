<?php

namespace App\Controller;

use App\Model\Eloquent\Message;
use Base\AbstractController;

class Blog extends AbstractController
{
    public function index()
    {
        if (!$this->getUser()) {
            $this->redirect('/index.php/login');
        }
        $messages = Message::getList();
        return $this->view->render('blog.phtml', [
            'messages' => $messages,
            'user' => $this->getUser(),
        ]);
    }

    public function addMessage()
    {
        if (!$this->getUser()) {
            $this->redirect('/index.php/login');
        }

        $text = (string) $_POST['text'];

        $message = new Message([
            'text' => $text,
            'author_id' => $this->getUserId(),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        if (isset($_FILES['image']['tmp_name'])) {
            $message->loadFile($_FILES['image']['tmp_name']);
        }

        $message->save();
        $this->redirect('/index.php/blog');
    }

    public function testTwig()
    {
        return $this->view->renderTwig('test1.twig', ['text' => 'hello']);
    }
}
