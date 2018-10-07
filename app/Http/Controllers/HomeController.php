<?php

namespace App\Http\Controllers;

use App\Repositories\ActivityRepository;
use App\Repositories\UserRepository;
use App\Services\DashBoardService;
use Auth;

class HomeController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ActivityRepository
     */
    private $activityRepo;
    /**
     * @var DashBoardService
     */
    private $dashBoardService;

    /**
     * Create a new controller instance.
     *
     * @param UserRepository $userRepository
     * @param ActivityRepository $activityRepo
     * @param DashBoardService $dashBoardService
     */
    public function __construct(
        UserRepository $userRepository,
        ActivityRepository $activityRepo,
        DashBoardService $dashBoardService
    )
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->activityRepo = $activityRepo;
        $this->dashBoardService = $dashBoardService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function index()
    {
        $id = Auth::user()->id;

        if (!empty(Auth::user()->id)) {
            $totalUsers = $this->dashBoardService->totalUsers(Auth::user()->id);
            $totalSMSorMMS = $this->dashBoardService->totalSMS(Auth::user()->id);
            $totalVoices = $this->dashBoardService->totalVoices(Auth::user()->id);
            $totalReply = $this->dashBoardService->totalReply(Auth::user()->id);
        }

        $activities = $this->activityRepo
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->paginate();

        return view('home', [
            'activities' => $activities,
            'total_users' => isset($totalUsers) ? $totalUsers : 0,
            'total_messages' => isset($totalSMSorMMS) ? $totalSMSorMMS : 0,
            'total_calls' => isset($totalVoices) ? $totalVoices : 0,
            'total_replies' => isset($totalReply) ? $totalReply : 0,
        ]);
    }

    public function horizon()
    {
        return view('horizon');
    }
}
