<?php
/**
 * Created by IntelliJ IDEA.
 * User: Lai Vu <vuldh@nal.vn>
 * Date: 7/24/18
 * Time: 13:28
 */

namespace App\Services;

use App\Models\User;
use App\Repositories\ActivityRepository;

class ActivityService implements \App\Contracts\ActivityService
{
    /**
     * @var ActivityRepository
     */
    private $activityRepo;

    /**
     * ActivityService constructor.
     * @param ActivityRepository $activityRepo
     */
    public function __construct(ActivityRepository $activityRepo)
    {
        $this->activityRepo = $activityRepo;
    }

    /**
     * @param $message
     * @param null $module
     * @return mixed|null
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     * @author Lai Vu <vuldh@nal.vn>
     */
    public function log($message, $module = null)
    {
        if (\Auth::guest()) {
            return null;
        }

        return $this->logAs($message, \Auth::user(), $module);
    }

    /**
     * @param $message
     * @param User $user
     * @param null $module
     * @return mixed|null
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     * @author vuldh <vuldh@nal.vn>
     */
    public function logAs($message, $user, $module = null)
    {
        if (empty($user)) {
            return null;
        }

        if (!isset($module)) {
            $module = \Route::currentRouteName();
        }

        if (empty($module)) {
            $module = 'unknown';
        }

        return $this->activityRepo->create([
            'activity' => $message,
            'module' => $module,
            'user_id' => $user->id
        ]);
    }
}
