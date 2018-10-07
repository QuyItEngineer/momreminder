<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh <vuldh@nal.vn>
 * Date: 8/21/18
 * Time: 4:15 PM
 */

namespace App\Services;


use App\Exceptions\ModelNotFoundException;
use App\Models\Campaign;
use App\Repositories\CampaignRepository;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

class CampaignService implements \App\Contracts\CampaignService
{

    /**
     * @var CampaignRepository
     * @author vuldh <vuldh@nal.vn>
     */
    private $campaignRepository;

    public function __construct(CampaignRepository $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
    }

    /**
     * @param $attributes
     * @param UploadedFile|null $mediaFile
     * @return Campaign
     * @author vuldh <vuldh@nal.vn>
     * @throws \Exception
     */
    public function create($attributes, UploadedFile $mediaFile = null)
    {
        \DB::beginTransaction();

        try {
            $this->uploadMedia($attributes, $mediaFile);
            $attributes['timestamp'] = $this->calculateProcessingTime($attributes);
            $campaign = $this->campaignRepository->create($attributes);
            \DB::commit();

            return $campaign;
        } catch (\Exception $ex) {
            \DB::rollBack();
            throw $ex;
        }
    }

    /**
     * @param $attributes
     * @param $id
     * @param UploadedFile|null $mediaFile
     * @return Campaign
     * @author vuldh <vuldh@nal.vn>
     * @throws \Exception
     */
    public function update($attributes, $id, UploadedFile $mediaFile = null)
    {
        \DB::beginTransaction();

        try {
            $this->uploadMedia($attributes, $mediaFile);
            $attributes['timestamp'] = $this->calculateProcessingTime($attributes);
            $campaign = $this->campaignRepository->update($attributes, $id);
            \DB::commit();

            return $campaign;
        } catch (\Exception $ex) {
            \DB::rollBack();
            throw $ex;
        }
    }

    /**
     * @param array $attributes
     * @return Carbon
     * @author vuldh <vuldh@nal.vn>
     */
    private function calculateProcessingTime($attributes)
    {
        $dateTime = Carbon::now();
        if ($attributes['delivery'] == Campaign::DELIVERY_OTHER) {
            $dateTime = Carbon::createFromFormat('Y-m-d h:i', $attributes['date'] . ' ' . $attributes['time']);
        }
        \Log::debug("Calculate time processing [{$attributes['name']}]: {$dateTime->toDateTimeString()}");
        return $dateTime;
    }

    /**
     * @param $attributes
     * @param UploadedFile $mediaFile
     * @author vuldh <vuldh@nal.vn>
     */
    public function uploadMedia(&$attributes, UploadedFile $mediaFile = null)
    {
        if (isset($mediaFile)) {
            if (isset($attributes['media']) && \Storage::exists($attributes['media'])) {
                \Storage::delete($attributes['media']);
            }
            $media = $mediaFile->store('/media');
            $attributes['media'] = $media;
        }
    }

    /**
     * @param $id
     * @return mixed
     * @author vuldh <vuldh@nal.vn>
     * @throws ModelNotFoundException
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function updateFinish($id)
    {
        $campaign = $this->campaignRepository->find($id);

        if (!isset($campaign)) {
            throw new ModelNotFoundException();
        }

        $this->campaignRepository->update([
            'timestamp' => $this->calculateNextTime($campaign)
        ], $id);
    }

    private function calculateNextTime(Campaign $campaign)
    {
        if (in_array($campaign->delivery, [
            Campaign::DELIVERY_OTHER,
            Campaign::DELIVERY_IMMEDIATELY
        ])) {
            return null;
        }

        if (!isset($this->timestamp)) {
            $this->timestamp = Carbon::now();
        }

        $dateTime = $this->timestamp->copy();

        $nowDatetime = Carbon::now();
        if ($campaign->routine_appointment != null && $nowDatetime->greaterThan($dateTime)) {

            switch ($campaign->routine_appointment) {
                case Campaign::ROUTINE_MONTHLY:
                    $dateTime->addMonth();
                    break;
                case Campaign::ROUTINE_2_MONTHS:
                    $dateTime->addMonths(2);
                    break;
                case Campaign::ROUTINE_3_MONTHS:
                    $dateTime->addMonths(3);
                    break;
                case Campaign::ROUTINE_6_MONTHS:
                    $dateTime->addMonths(6);
                    break;
            }
        }

        \Log::debug("Calculate next time processing [{$campaign->name}]: {$dateTime->toDateTimeString()}");

        return $dateTime;
    }

}