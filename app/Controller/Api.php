<?php

namespace App\Controller;

use App\Model\Eloquent\Message;
use Base\AbstractController;

class Api extends AbstractController
{
    public function getUserMessages()
    {
        $userId = (int) $_GET['user_id'] ?? 0;
        if (!$userId) {
            return $this->getResponse(['error' => 'no_user_id']);
        }
        $messages = Message::getUserMessages($userId, 20);
        if (!$messages) {
            return $this->getResponse(['error' => 'no_messages']);
        }

        $data = array_map(function (Message $message) {
            return $message->getData();
        }, $messages);

        return $this->getResponse(['messages' => $data]);
    }

    public function getResponse(array $data)
    {
        header('Content-type: application/json');
        return json_encode($data);
    }
}
