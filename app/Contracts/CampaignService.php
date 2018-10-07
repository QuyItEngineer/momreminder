<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh <vuldh@nal.vn>
 * Date: 8/21/18
 * Time: 4:13 PM
 */

namespace App\Contracts;


use App\Models\Campaign;
use Illuminate\Http\UploadedFile;

interface CampaignService
{
    /**
     * @param $attributes
     * @param UploadedFile|null $mediaFile
     * @return Campaign
     * @author vuldh <vuldh@nal.vn>
     */
    public function create($attributes, UploadedFile $mediaFile = null);

    /**
     * @param $attributes
     * @param $id
     * @param UploadedFile|null $mediaFile
     * @return Campaign
     * @author vuldh <vuldh@nal.vn>
     */
    public function update($attributes, $id, UploadedFile $mediaFile = null);

    /**
     * @param $id
     * @return mixed
     * @author vuldh <vuldh@nal.vn>
     */
    public function updateFinish($id);
}