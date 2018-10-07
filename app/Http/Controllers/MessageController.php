<?php

namespace App\Http\Controllers;

use App\DataTables\MessageDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Repositories\MessageRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MessageController extends AppBaseController
{
    /** @var  MessageRepository */
    private $messageRepository;

    public function __construct(MessageRepository $messageRepo)
    {
        $this->messageRepository = $messageRepo;
    }

    /**
     * Display a listing of the Message.
     *
     * @param MessageDataTable $messageDataTable
     * @return Response
     */
    public function index(MessageDataTable $messageDataTable)
    {
        return $messageDataTable->render('messages.index');
    }
}
