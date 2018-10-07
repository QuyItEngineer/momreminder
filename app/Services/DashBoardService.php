<?php
/**
 * Created by PhpStorm.
 * User: macintosh
 * Date: 8/20/18
 * Time: 10:20 PM
 */

namespace App\Services;



use App\Criteria\CreatedByCriteria;
use App\Repositories\CallRepository;
use App\Repositories\ContactRepository;
use App\Repositories\MessageRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Auth;

class DashBoardService implements \App\Contracts\DashBoardService
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var RoleRepository
     */
    private $roleRepository;
    /**
     * @var MessageRepository
     */
    private $messageRepository;
    /**
     * @var ContactRepository
     */
    private $contactRepository;
    /**
     * @var CallRepository
     */
    private $callRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     * @param MessageRepository $messageRepository
     * @param CallRepository $callRepository
     * @param ContactRepository $contactRepository
     */
    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository,
        MessageRepository $messageRepository,
        CallRepository $callRepository,
        ContactRepository $contactRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->messageRepository = $messageRepository;
        $this->contactRepository = $contactRepository;
        $this->callRepository = $callRepository;
    }

    /**
     * @param $id
     * @return int
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function totalUsers($id)
    {
        if (Auth::user()->hasRole(DashBoardService::ROLE_ADMIN)) {
            $totalUser = $this->userRepository->all()->count();
        }
        else if (Auth::user()->hasRole(DashBoardService::ROLE_USER)) {
            $this->contactRepository->pushCriteria(CreatedByCriteria::class);
            $totalUser = $this->contactRepository->count();
        }
        else {
            $this->contactRepository->pushCriteria(CreatedByCriteria::class);
            $totalUser = $this->contactRepository->count();
        }

        return isset($totalUser) ? $totalUser : 0;
    }

    /**
     * @param $id
     * @return MessageRepository|int
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function totalSMS($id)
    {
        if (Auth::user()->hasRole(DashBoardService::ROLE_ADMIN)) {
            $totalSMSorMMS = $this->messageRepository->count();
        }
        else if (Auth::user()->hasRole(DashBoardService::ROLE_USER)) {
            $totalSMSorMMS = $this->messageRepository->findWhere(['user_id' => $id])->count();
        }
        else {
            $totalSMSorMMS = $this->messageRepository->findWhere(['user_id' => $id])->count();
        }

        return isset($totalSMSorMMS) ? $totalSMSorMMS : 0;
    }

    public function totalVoices($id)
    {
        if (Auth::user()->hasRole(DashBoardService::ROLE_ADMIN)) {
            $totalCalls = $this->callRepository->all()->count();
        }
        else if (Auth::user()->hasRole(DashBoardService::ROLE_USER)) {
            $totalCalls = $this->callRepository->findWhere(['user_id' => $id])->count();
        }
        else {
            $totalCalls = $this->callRepository->findWhere(['user_id' => $id])->count();
        }

        return isset($totalCalls) ? $totalCalls : 0;
    }

    public function totalReply($id)
    {
        $userLogged = $this->userRepository->find($id);
        $totalReply = $this->messageRepository->findWhere([
            'direction' => 'in',
            'to' => $userLogged->phone
        ])->count();

        if ( ! $totalReply) {
            return $totalReply = 0;
        }

        return $totalReply;
    }
}