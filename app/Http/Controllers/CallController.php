<?php

namespace App\Http\Controllers;

use App\DataTables\CallDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCallRequest;
use App\Http\Requests\UpdateCallRequest;
use App\Repositories\CallRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CallController extends AppBaseController
{
    /** @var  CallRepository */
    private $callRepository;

    public function __construct(CallRepository $callRepo)
    {
        $this->callRepository = $callRepo;
    }

    /**
     * Display a listing of the Call.
     *
     * @param CallDataTable $callDataTable
     * @return Response
     */
    public function index(CallDataTable $callDataTable)
    {
        return $callDataTable->render('calls.index');
    }
}
