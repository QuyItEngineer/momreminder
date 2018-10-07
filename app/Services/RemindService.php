<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh <vuldh@nal.vn>
 * Date: 8/18/18
 * Time: 8:43 AM
 */

namespace App\Services;


use App\Events\RemindSending;
use App\Events\UserCreditNotEnough;
use App\Models\Campaign;
use App\Notifications\RemindNotification;
use App\Repositories\CampaignRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class RemindService implements \App\Contracts\RemindService
{
    /**
     * @var CampaignRepository
     * @author vuldh <vuldh@nal.vn>
     */
    private $campaignRepository;
    /**
     * @var CampaignService
     * @author vuldh <vuldh@nal.vn>
     */
    private $campaignService;

    /**
     * RemindService constructor.
     * @param CampaignRepository $campaignRepository
     * @param CampaignService $campaignService
     */
    public function __construct(CampaignRepository $campaignRepository, CampaignService $campaignService)
    {
        $this->campaignRepository = $campaignRepository;
        $this->campaignService = $campaignService;
    }

    /**
     * @return int
     * @throws \App\Exceptions\ModelNotFoundException
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     * @author vuldh <vuldh@nal.vn>
     */
    public function fetchAndSendReminds()
    {
        $reminds = $this->fetchNeedReminds();
        $count = $reminds->count();
        \Log::debug("Fetch {$count} and send reminds");
        foreach ($reminds as $remind) {
            \Log::debug("Before send [$remind->name]");
            if (isset($remind->createdBy)
                && $remind->createdBy->credit > $remind->credit_cost) {
                $remind->createdBy->decrement('credit', $remind->credit_cost);
                event(new RemindSending($remind));
                $remind
                    ->notify(new RemindNotification());
            } else {
                event(new UserCreditNotEnough($remind));
            }
            \Log::debug("After send [$remind->name]");
            $this->campaignService->updateFinish($remind->id);
        }
        return $count;
    }

    /**
     * @return Collection|Campaign[]
     * @author vuldh <vuldh@nal.vn>
     */
    private function fetchNeedReminds()
    {
        return $this->campaignRepository->scopeQuery(function ($query) {
            return $query->remindDue();
        })->all();
    }


}