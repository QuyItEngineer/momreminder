<?php

namespace App\Http\Controllers;

use App\Contracts\CampaignService;
use App\DataTables\CampaignDataTable;
use App\DataTables\CampaignUnsubscribedDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Repositories\CampaignRepository;
use App\Repositories\GroupRepository;
use App\Repositories\RecordRepository;
use App\Repositories\TemplateRepository;
use App\Traits\BulkAction;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class CampaignController extends AppBaseController
{

    use BulkAction;

    /** @var  CampaignRepository */
    private $campaignRepository;
    /**
     * @var TemplateRepository
     */
    private $templateRepository;
    /**
     * @var RecordRepository
     */
    private $recordRepository;
    /**
     * @var GroupRepository
     */
    private $groupRepository;
    /**
     * @var CampaignService
     * @author vuldh <vuldh@nal.vn>
     */
    private $campaignService;

    public function __construct(
        CampaignRepository $campaignRepo,
        TemplateRepository $templateRepository,
        RecordRepository $recordRepository,
        GroupRepository $groupRepository,
        CampaignService $campaignService
    )
    {
        $this->campaignRepository = $campaignRepo;
        $this->templateRepository = $templateRepository;
        $this->recordRepository = $recordRepository;
        $this->groupRepository = $groupRepository;
        $this->campaignService = $campaignService;
    }

    /**
     * Display a listing of the Campaign.
     *
     * @param CampaignDataTable $campaignDataTable
     * @return Response
     */
    public function index(CampaignDataTable $campaignDataTable)
    {
        return $campaignDataTable->render('campaigns.index');
    }

    /**
     * Show the form for creating a new Campaign.
     *
     * @return Response
     */
    public function create()
    {
        $records = $this->recordRepository->all();
        $templates = $this->templateRepository->all();
        $groups = $this->groupRepository->all();
        return view('campaigns.create', [
            'records' => $records,
            'templates' => $templates,
            'groups' => $groups
        ]);
    }

    /**
     * Store a newly created Campaign in storage.
     *
     * @param CreateCampaignRequest $request
     *
     * @return Response
     */
    public function store(CreateCampaignRequest $request)
    {
        $input = $request->all();

        $campaign = $this->campaignService->create($input, $request->file('media'));

        Flash::success('Campaign saved successfully.');

        return redirect(route('campaigns.index'));
    }

    /**
     * Display the specified Campaign.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $campaign = $this->campaignRepository->findWithoutFail($id);

        if (empty($campaign)) {
            Flash::error('Campaign not found');

            return redirect(route('campaigns.index'));
        }

        return view('campaigns.show')->with('campaign', $campaign);
    }

    /**
     * Show the form for editing the specified Campaign.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $campaign = $this->campaignRepository->findWithoutFail($id);

        if (empty($campaign)) {
            Flash::error('Campaign not found');

            return redirect(route('campaigns.index'));
        }

        $records = $this->recordRepository->all();
        $templates = $this->templateRepository->all();
        $groups = $this->groupRepository->all();

        return view('campaigns.edit', [
            'records' => $records,
            'templates' => $templates,
            'groups' => $groups
        ])
            ->with('campaign', $campaign);
    }

    /**
     * Update the specified Campaign in storage.
     *
     * @param  int $id
     * @param UpdateCampaignRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCampaignRequest $request)
    {
        $campaign = $this->campaignRepository->findWithoutFail($id);

        if (empty($campaign)) {
            Flash::error('Campaign not found');

            return redirect(route('campaigns.index'));
        }
        $attributes = $request->all();
        $campaign = $this->campaignService->update($attributes, $id, $request->file('media'));

        Flash::success('Campaign updated successfully.');

        return redirect(route('campaigns.index'));
    }

    /**
     * Remove the specified Campaign from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $campaign = $this->campaignRepository->findWithoutFail($id);

        if (empty($campaign)) {
            Flash::error('Campaign not found');

            return redirect(route('campaigns.index'));
        }

        $this->campaignRepository->delete($id);

        Flash::success('Campaign deleted successfully.');

        return redirect(route('campaigns.index'));
    }

    public function unsubcribed(CampaignUnsubscribedDataTable $campaignDataTable)
    {
        return $campaignDataTable->render('campaigns.index');
    }
}
