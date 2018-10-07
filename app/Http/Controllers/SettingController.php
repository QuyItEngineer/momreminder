<?php

namespace App\Http\Controllers;

use App\DataTables\SettingDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSettingRequest;
use App\Http\Requests\TestEmailRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Mail\TestMail;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class SettingController extends AppBaseController
{
    /** @var  SettingRepository */
    private $settingRepository;

    public function __construct(SettingRepository $settingRepo)
    {
        $this->settingRepository = $settingRepo;
    }

    /**
     * Display a listing of the Setting.
     *
     * @param SettingDataTable $settingDataTable
     * @return Response
     */
    public function index(SettingDataTable $settingDataTable)
    {
        return $settingDataTable->render('settings.index');
    }

    /**
     * Show the form for creating a new Setting.
     *
     * @return Response
     */
    public function create()
    {
        $allSettings = Setting::allSettings('core');
        return view('settings.create', [
            'settings' => $allSettings
        ]);
    }

    /**
     * Store a newly created Setting in storage.
     *
     * @param CreateSettingRequest $request
     *
     * @return Response
     * @throws \Throwable
     */
    public function store(CreateSettingRequest $request)
    {
        $input = $request->except(['_token']);

        Setting::updateAllSettings('core', $input);

        Flash::success('Setting saved successfully.');

        return redirect(route('settings.create'));
    }

    /**
     * Display the specified Setting.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $setting = $this->settingRepository->findWithoutFail($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(route('settings.index'));
        }

        return view('settings.show')->with('setting', $setting);
    }

    /**
     * Show the form for editing the specified Setting.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $setting = $this->settingRepository->findWithoutFail($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(route('settings.index'));
        }

        return view('settings.edit')->with('setting', $setting);
    }

    /**
     * Update the specified Setting in storage.
     *
     * @param  int $id
     * @param UpdateSettingRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update($id, UpdateSettingRequest $request)
    {
        $setting = $this->settingRepository->findWithoutFail($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(route('settings.index'));
        }

        $setting = $this->settingRepository->update($request->all(), $id);

        Flash::success('Setting updated successfully.');

        return redirect(route('settings.index'));
    }

    /**
     * Remove the specified Setting from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $setting = $this->settingRepository->findWithoutFail($id);

        if (empty($setting)) {
            Flash::error('Setting not found');

            return redirect(route('settings.index'));
        }

        $this->settingRepository->delete($id);

        Flash::success('Setting deleted successfully.');

        return redirect(route('settings.index'));
    }

    /**
     * Show emailer to view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show_emailer()
    {
        $allSettings = Setting::allSettings('email');
        $system_email = Setting::getSetting('core', 'site_system_email', '');

        return view('settings.emailer', [
            'settings' => $allSettings,
            'system_email' => $system_email
        ]);
    }

    /**
     * Store Emailer Setting
     *
     * @param CreateSettingRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store_emailer(CreateSettingRequest $request)
    {
        if ($request->isMethod('POST')) {
            $input = $request->except(['_token']);
            try {
                Setting::updateAllSettings('email', $input);
                Flash::success('Setting saved successfully.');
                return redirect(route('settings.emailer'));
            } catch (\Throwable $e) {
                Flash::error('Error!');
            }
        }
    }

    /**
     * Update Test Emailer Setting
     *
     * @param TestEmailRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function testEmailer(TestEmailRequest $request)
    {
        $email = $request->get('email');
        try {
            \Mail::to([(object)['name' => 'Tester', 'email' => $email]])
                ->send(new TestMail());
        } catch (\Exception $ex) {
            Flash::error('Email setting error! [' . $ex->getMessage() . ']');
        }

        return redirect(route('settings.emailer'));
    }

}
