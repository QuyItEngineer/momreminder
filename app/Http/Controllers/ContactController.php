<?php

namespace App\Http\Controllers;

use App\DataTables\ContactDataTable;
use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use App\Repositories\ContactRepository;
use App\Repositories\GroupRepository;
use Carbon\Carbon;
use DB;
use Excel;
use Flash;
use Illuminate\Http\Request;
use Log;
use Response;

class ContactController extends AppBaseController
{
    /** @var  ContactRepository */
    private $contactRepository;
    /** @var  GroupRepository */
    private $groupRepository;

    public function __construct(ContactRepository $contactRepo, GroupRepository $groupRepo)
    {
        $this->contactRepository = $contactRepo;
        $this->groupRepository = $groupRepo;
    }

    /**
     * Display a listing of the Contact.
     *
     * @param ContactDataTable $contactDataTable
     * @return Response
     */
    public function index(ContactDataTable $contactDataTable)
    {
        $view_data['groups'] = $this->groupRepository->all();
        return $contactDataTable->render('contacts.index', $view_data);
    }

    /**
     * Show the form for creating a new Contact.
     *
     * @return Response
     */
    public function create()
    {
        $groups = $this->groupRepository->all();

        return view('contacts.create', compact('groups'));
    }

    /**
     * Store a newly created Contact in storage.
     *
     * @param CreateContactRequest $request
     *
     * @return Response
     * @throws \Exception
     */
    public function store(CreateContactRequest $request)
    {

        DB::beginTransaction();

        try {
            $contacts = $request->get('contacts');
            array_walk($contacts, function ($contact) use ($request) {
                /**
                 * @var Contact $contact
                 */
                $contact = $this->contactRepository->create($contact);
                $contact->groups()->sync($request->get('groups'));
            });
            DB::commit();
            Flash::success('Contact saved successfully.');
            return redirect(route('contacts.index'));
        } catch (\Exception $ex) {
            DB::rollBack();
            Flash::error('Contact saved error.');
            throw $ex;
        }
    }

    /**
     * Display the specified Contact.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contact = $this->contactRepository->findWithoutFail($id);

        if (empty($contact)) {
            Flash::error('Contact not found');

            return redirect(route('contacts.index'));
        }

        return view('contacts.show')->with('contact', $contact);
    }

    /**
     * Show the form for editing the specified Contact.
     *
     * @param ContactDataTable $contactDataTable
     * @param  int $id
     *
     * @return Response
     */
    public function edit(ContactDataTable $contactDataTable, $id)
    {
        $contact = $this->contactRepository->findWithoutFail($id);
        $member = [
            '0' => 'Member',
            '1' => 'Non-member'
        ];
        $status = [
            '0' => 'Active',
            '1' => 'Inactive'
        ];
        $groups = $this->groupRepository->all();

        if (empty($contact)) {
            Flash::error('Contact not found');

            return redirect(route('contacts.index'));
        }

        return view('contacts.edit', compact('contact', 'groups', 'member', 'status'));
    }

    /**
     * Update the specified Contact in storage.
     *
     * @param  int $id
     * @param UpdateContactRequest $request
     *
     * @return Response
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update($id, UpdateContactRequest $request)
    {
        $contact = $this->contactRepository->findWithoutFail($id);
        $params = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'birthday' => $request->get('birthday'),
            'member' => $request->get('member'),
            'status' => $request->get('status'),
        ];

        if (empty($contact)) {
            Flash::error('Contact not found');

            return redirect(route('contacts.index'));
        }

        $contact = $this->contactRepository->update($params, $id);
        $contact->groups()->sync($request->get('groups'));


        Flash::success('Contact updated successfully.');

        return redirect(route('contacts.index'));
    }

    /**
     * Remove the specified Contact from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contact = $this->contactRepository->findWithoutFail($id);

        if (empty($contact)) {
            Flash::error('Contact not found');

            return redirect(route('contacts.index'));
        }

        $this->contactRepository->delete($id);

        Flash::success('Contact deleted successfully.');

        return redirect(route('contacts.index'));
    }

    /**
     * Download template contact.
     */
    public function download_example()
    {
        $data = [
            'name' => 'name',
            'tony' => 'tony',
            'birthday' => ' birthday'
        ];

        return Excel::create('momsms-import-sample', function($excel) use ($data) {
            $excel->setTitle('Our new awesome title');
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->rows([
                    ['Name', 'Phone','Email', 'Birthday','Member'],
                    ['Jack', '4695356759','info@foszo.com', '1983-12-11','0'],
                    ['Tony', '7146007020','aritalee7B@gmail.com', '1983-03-09','1']
                ]);

            });
        })->export('xls');
    }

    /**
     * Download template contact.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function import()
    {
        $groups = $this->groupRepository->all();

        return view('contacts.import', compact('groups'));
    }

    /**
     * Import data contact.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function import_data(Request $request)
    {
        $file = $request->file('file');

        if ($file->getSize() > (2097152)) {
            Flash::error('Import file is not lager than 2MB');
            return redirect(route('contacts.import'));
        }

        if (($file->getClientOriginalExtension() !== "xls") && ($file->getClientOriginalExtension() !== "xlsx") && ($file->getClientOriginalExtension() !== "csv")) {
            Flash::error('Import file must be .xls, .xlsx, .csv');
            return redirect(route('contacts.import'));
        }

        DB::beginTransaction();
        try{
            Excel::load($file, function($reader) use ($request){

                $results = $reader->get();

                foreach ($results as $line) {
                    $params = [
                        'name' => $line['name'],
                        'email' => $line['email'],
                        'phone' => $line['phone'],
                        'birthday' => Carbon::parse($line['birthday'])->format('Y-m-d'),
                        'member' => $line['member'],
                        'status' => '0'
                    ];

                    $contact = $this->contactRepository->create($params);
                    $contact->groups()->sync($request->get('groups'));
                }
            });

            \DB::commit();
            Flash::success('Contact created successfully.');
            return redirect(route('contacts.index'));
        }
        catch (\Exception $exception) {
            \DB::rollBack();
            Flash::error('Contact saved error.');
            Log::debug('BUG: '.$exception->getMessage());
        }

        return redirect(route('contacts.index'));
    }
}
