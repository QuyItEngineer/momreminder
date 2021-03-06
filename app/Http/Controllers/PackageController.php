<?php

namespace App\Http\Controllers;

use App\DataTables\PackageDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Repositories\PackageRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class PackageController extends AppBaseController
{
    /** @var  PackageRepository */
    private $packageRepository;

    public function __construct(PackageRepository $packageRepo)
    {
        $this->packageRepository = $packageRepo;
    }

    /**
     * Display a listing of the Package.
     *
     * @param PackageDataTable $packageDataTable
     * @return Response
     */
    public function index(PackageDataTable $packageDataTable)
    {
        return $packageDataTable->render('packages.index');
    }

    /**
     * Show the form for creating a new Package.
     *
     * @return Response
     */
    public function create()
    {
        return view('packages.create');
    }

    /**
     * Store a newly created Package in storage.
     *
     * @param CreatePackageRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CreatePackageRequest $request)
    {
        $input = $request->all();

        $package = $this->packageRepository->create($input);

        Flash::success('Package saved successfully.');

        return redirect(route('packages.index'));
    }

    /**
     * Display the specified Package.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $package = $this->packageRepository->findWithoutFail($id);

        if (empty($package)) {
            Flash::error('Package not found');

            return redirect(route('packages.index'));
        }

        return view('packages.show')->with('package', $package);
    }

    /**
     * Show the form for editing the specified Package.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $package = $this->packageRepository->findWithoutFail($id);

        if (empty($package)) {
            Flash::error('Package not found');

            return redirect(route('packages.index'));
        }

        return view('packages.edit')->with('package', $package);
    }

    /**
     * Update the specified Package in storage.
     *
     * @param  int $id
     * @param UpdatePackageRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update($id, UpdatePackageRequest $request)
    {
        $package = $this->packageRepository->findWithoutFail($id);

        if (empty($package)) {
            Flash::error('Package not found');

            return redirect(route('packages.index'));
        }

        $package = $this->packageRepository->update($request->all(), $id);

        Flash::success('Package updated successfully.');

        return redirect(route('packages.index'));
    }

    /**
     * Remove the specified Package from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $package = $this->packageRepository->findWithoutFail($id);

        if (empty($package)) {
            Flash::error('Package not found');

            return redirect(route('packages.index'));
        }

        $this->packageRepository->delete($id);

        Flash::success('Package deleted successfully.');

        return redirect(route('packages.index'));
    }

    /**
     * buy credit with package
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @author quyhbn <quyhbn@nal.vn>
     */
    public function buyCredit()
    {
        $packages = $this->packageRepository->scopeQuery(function($query){
            $query->orderBy('sort_order','asc');
            $query->orderBy('updated_at','desc');
            return $query;
        })->all();

        return view('packages.buy_credit', compact('packages'));
    }
}
