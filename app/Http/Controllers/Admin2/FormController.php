<?php

namespace App\Http\Controllers\Admin2;


use App\Classes\Common;

use App\Http\Requests\Admin\Forms\DeleteRequest;
use App\Http\Requests\Admin\Forms\IndexRequest;
use App\Http\Requests\Admin\Forms\StoreRequest;
use App\Http\Requests\Admin\Forms\UpdateRequest;

use App\Classes\Reply;
use App\Models\EmailTemplate;
use App\Models\Form;
use App\Models\FormField;
use Illuminate\Http\Request;

class FormController extends AdminBaseController
{
     /**
	 * UserController constructor.
	 */

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = trans('menu.formBuilder');
        $this->pageIcon = 'fa fa-address-card';
        $this->settingsMenuActive = 'active';
        $this->formActive = 'active';
        $this->bootstrapModalRight = false;
        $this->defaultFormFields = ['First Name', 'Last Name', 'Company Name', 'Website', 'Notes', 'Email', 'Phone No', 'Mobile No', 'Telephone No'];
    }

    public function index(IndexRequest $request)
    {
        return view('admin2.forms.index', $this->data);
    }

    public function getLists()
    {

        $results = Form::select('forms.id', 'forms.form_name', 'forms.created_by', 'forms.created_at')
                     ->with('creator', 'fields');

        // Fetch data according to permission assigned
        if(!$this->user->ability('admin', 'form_view_all')) {
            $results = $results->where('forms.created_by', $this->user->id);
        }

        return datatables()->eloquent($results)
            ->addColumn('creator', function ($row) {
                return $row->creator ? Common::getUserWidget($row->creator) : '-';
            })
            ->addColumn('fields', function ($row) {
                $string = '<ul>';

                foreach ($row->fields as $field)
                {
                    $string .= '<li>'.$field->field_name.'</li>';
                }
                return $string;
            })
            ->editColumn(
                'created_at',
                function ($row) {
                    return $row->created_at->format('d F, Y');
                }
            )
            ->addColumn('action', function ($row) {
                $text = '<div class="buttons">';

                if($this->user->ability('admin', 'form_edit')) {
                    $text .= '<a href="' . route('admin.forms.edit', $row->id) . '" class="btn btn-icon icon-left"
                      data-toggle="tooltip" data-original-title="' . trans('app.edit') . '"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="cs-icon cs-icon-edit mb-3 d-inline-block text-primary"><path d="M14.6263 2.54529C15.0872 2.08443 15.6781 1.79144 16.2692 1.73078C16.8603 1.67012 17.4031 1.84676 17.7782 2.22183C18.1533 2.5969 18.3299 3.13969 18.2692 3.73078C18.2086 4.32188 17.9156 4.91286 17.4547 5.37372L6.53217 16.2963L2.22183 17.7782L3.70375 13.4678L14.6263 2.54529Z"></path></svg></a>';
                }

                if($this->user->ability('admin', 'form_delete')) {
                    $text .= '<button onclick="deleteModal(' . $row->id . ')" class="btn btn-icon icon-left"
                      data-toggle="tooltip" data-original-title="' . trans('app.delete') . '"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="red" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="cs-icon cs-icon-bin mb-3 d-inline-block text-primary"><path d="M4 5V14.5C4 15.9045 4 16.6067 4.33706 17.1111C4.48298 17.3295 4.67048 17.517 4.88886 17.6629C5.39331 18 6.09554 18 7.5 18H12.5C13.9045 18 14.6067 18 15.1111 17.6629C15.3295 17.517 15.517 17.3295 15.6629 17.1111C16 16.6067 16 15.9045 16 14.5V5"></path><path d="M14 5L13.9424 4.74074C13.6934 3.62043 13.569 3.06028 13.225 2.67266C13.0751 2.50368 12.8977 2.36133 12.7002 2.25164C12.2472 2 11.6734 2 10.5257 2L9.47427 2C8.32663 2 7.75281 2 7.29981 2.25164C7.10234 2.36133 6.92488 2.50368 6.77496 2.67266C6.43105 3.06028 6.30657 3.62044 6.05761 4.74074L6 5"></path><path d="M2 5H18M12 9V13M8 9V13"></path></svg></button>';
                }

                $text .= '</div>';

                return $text;
            })
            ->rawColumns(['creator', 'fields', 'action'])
            ->make(true);
    }

    public function create()
    {
        $this->pageTitle = trans('module_form.createForm');
        $this->icon = 'plus';

        $this->form = new Form();
        $this->allFormLists = Form::all();
        $this->formFields = [];
        $this->formFieldSelected = [];
        return view('admin2.forms.add-edit', $this->data);
    }

    public function store(StoreRequest $request)
    {

        \DB::beginTransaction();

        $form = new Form();
        $form->created_by = $this->user->id;
        $this->storeAndUpdate($form, $request);

        \DB::commit();

        return Reply::redirect(route('admin2.forms.index'), 'messages.createSuccess');

    }

    public function edit($id)
    {
        $this->pageTitle = trans('module_form.editForm');
        $this->icon = 'edit';

        $form = Form::findOrFail($id);

        // Check if current email template by logged in user
        // and not have permission to see all email templates
        if(!$this->user->ability('admin', 'form_view_all') && $form->created_by != $this->user->id) {
            return response()->view($this->forbiddenErrorView);
        }

        $this->form = $form;
        $this->allFormLists = Form::all();
        $this->formFields = FormField::select('form_fields.*')
                                    ->join('forms', 'forms.id', '=', 'form_fields.form_id')
                                    ->where('forms.id', '=', $id)
                                    ->orderBy('form_fields.order')
                                    ->get();

        $this->formFieldSelected = FormField::select('form_fields.*')
                                            ->join('forms', 'forms.id', '=', 'form_fields.form_id')
                                            ->where('forms.id', '=', $id)
                                            ->orderBy('form_fields.order')
                                            ->pluck('field_name')
                                            ->toArray();

        // Call the same create view for edit
        return view('admin2.forms.add-edit', $this->data);
    }

    public function update(UpdateRequest $request,$id)
    {
        \DB::beginTransaction();

        $form         = Form::findOrFail($id);

        // Check if current email template by logged in user
        // and not have permission to see all email templates
        if(!$this->user->ability('admin', 'form_view_all') && $form->created_by != $this->user->id) {
            return Reply::error('messages.notAllowed');
        }

        $this->storeAndUpdate($form, $request);

        \DB::commit();

        return Reply::redirect(route('admin2.forms.index'), 'messages.updateSuccess');

    }

    public function destroy(DeleteRequest $request, $id)
    {
        $form = Form::findOrFail($id);

        // Check if current email template by logged in user
        // and not have permission to see all email templates
        if(!$this->user->ability('admin', 'form_view_all') && $form->created_by != $this->user->id) {
            return Reply::error('messages.notAllowed');
        }

        $form->delete();
        return Reply::success('messages.deleteSuccess');
    }

    private function  storeAndUpdate($form, $request)
    {
        $form->form_name   = $request->form_name;
        $form->save();

        $formFields = $request->fields;
        $order = 1;

        foreach ($formFields as $formField)
        {
            $newFormField = FormField::where('field_name', trim($formField))
                                     ->where('form_id', '=', $form->id)
                                     ->first();

            if(!$newFormField)
            {
                $newFormField = new FormField();
                $newFormField->form_id = $form->id;
            }

            $newFormField->field_name = $formField;
            $newFormField->order = $order;
            $newFormField->save();

            $order++;
        }
    }

    public function selectFormData(Request $request)
    {
        $form = Form::find($request->selected_form_id);

        $this->formFields = FormField::where('form_id', $request->selected_form_id)
                                ->orderBy('order', 'asc')
                                ->get();
        $this->formFieldSelected = FormField::where('form_id', $request->selected_form_id)
                                            ->orderBy('order', 'asc')
                                            ->pluck('field_name')
                                            ->toArray();

        $output = view('admin2.forms.form-fields', $this->data)->render();
        $outputDefaultFields = view('admin2.forms.default-fields', $this->data)->render();

        return Reply::success('messages.dataFetchedSuccessfully', ['html' => $output, 'html1' => $outputDefaultFields,'form' => $form, 'formFields' => $this->formFields]);
    }

    public function uploadFieldsFromCSV(Request $request)
    {
        $file = fopen($request->import_from_csv, 'r');
        $row = 0;
        $csvFormFields = [];

        while(($lineArrayResults = fgetcsv($file)) !== FALSE)
        {

            if($row == 0)
            {
                foreach ($lineArrayResults as $lineArrayResultKey => $lineArrayResult)
                {
                    $csvFormFields[$lineArrayResultKey] = $lineArrayResult;
                }

                break;
            }

            $row++;
        }

        fclose($file);

        $this->csvFormFields = $csvFormFields;
        $this->formFieldSelected = $csvFormFields;

        $output = view('admin2.forms.csv-form-fields', $this->data)->render();
        $outputDefaultFields = view('admin2.forms.default-fields', $this->data)->render();

        return Reply::success('messages.csvFieldImportedSuccessfully', ['html' => $output, 'html1' => $outputDefaultFields]);
    }

    public function addNewField()
    {
        $this->icon = 'plus';

        return view('admin2.forms.add-field', $this->data);
    }
}
