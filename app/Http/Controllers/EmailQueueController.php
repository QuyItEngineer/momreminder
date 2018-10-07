<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmailQueueRequest;
use App\Http\Requests\UpdateEmailQueueRequest;
use App\Repositories\EmailQueueRepository;
use Flash;
use Response;

class EmailQueueController extends AppBaseController
{
    /** @var  EmailQueueRepository */
    private $emailQueueRepository;

    public function __construct(EmailQueueRepository $emailQueueRepo)
    {
        $this->emailQueueRepository = $emailQueueRepo;
    }

    /**
     * Display a listing of the EmailQueue.
     *
     * @param CreateEmailQueueRequest $request
     * @return Response
     */
    public function index(CreateEmailQueueRequest $request)
    {
        //
    }

    /**
     * Show the form for creating a new EmailQueue.
     *
     * @return Response
     */
    public function create()
    {
        return view('email_queues.create');
    }

    /**
     * Store a newly created EmailQueue in storage.
     *
     * @param CreateEmailQueueRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CreateEmailQueueRequest $request)
    {
        $input = $request->all();

        $emailQueue = $this->emailQueueRepository->create($input);

        Flash::success('Email Queue saved successfully.');

        return redirect(route('emailQueues.index'));
    }

    /**
     * Display the specified EmailQueue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $emailQueue = $this->emailQueueRepository->findWithoutFail($id);

        if (empty($emailQueue)) {
            Flash::error('Email Queue not found');

            return redirect(route('emailQueues.index'));
        }

        return view('email_queues.show')->with('emailQueue', $emailQueue);
    }

    /**
     * Show the form for editing the specified EmailQueue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $emailQueue = $this->emailQueueRepository->findWithoutFail($id);

        if (empty($emailQueue)) {
            Flash::error('Email Queue not found');

            return redirect(route('emailQueues.index'));
        }

        return view('email_queues.edit')->with('emailQueue', $emailQueue);
    }

    /**
     * Update the specified EmailQueue in storage.
     *
     * @param  int $id
     * @param UpdateEmailQueueRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update($id, UpdateEmailQueueRequest $request)
    {
        $emailQueue = $this->emailQueueRepository->findWithoutFail($id);

        if (empty($emailQueue)) {
            Flash::error('Email Queue not found');

            return redirect(route('emailQueues.index'));
        }

        $emailQueue = $this->emailQueueRepository->update($request->all(), $id);

        Flash::success('Email Queue updated successfully.');

        return redirect(route('emailQueues.index'));
    }

    /**
     * Remove the specified EmailQueue from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $emailQueue = $this->emailQueueRepository->findWithoutFail($id);

        if (empty($emailQueue)) {
            Flash::error('Email Queue not found');

            return redirect(route('emailQueues.index'));
        }

        $this->emailQueueRepository->delete($id);

        Flash::success('Email Queue deleted successfully.');

        return redirect(route('emailQueues.index'));
    }
}
