<?php

namespace App\Http\Controllers\Admin2;


use App\Classes\Common;

use App\Http\Requests\Admin\User\DeleteRequest;
use App\Http\Requests\Admin\User\IndexRequest;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;

use App\Classes\Reply;
use App\Models\Appointment;
use App\Models\Callback;
use App\Models\Campaign;
use App\Models\Form;
use App\Models\Lead;
use App\Models\Role;
use App\Models\User;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends AdminBaseController
{
     /**
	 * UserController constructor.
	 */

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = trans('menu.staffMembers');
        $this->pageIcon = 'fa fa-user-secret';
        $this->userManagementMenuActive = 'active';
        $this->staffMemberActive = 'active';
    }

    /**
     * @param IndexRequest $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(IndexRequest $request)
    {
        return view('admin2.users.index', $this->data);
    }

     /**
	 * @return mixed
	 */
    public function getLists()
    {

        $users = User::select('id', 'image', 'first_name', 'last_name', 'email', 'status', 'created_at');

        return datatables()->eloquent($users)
            ->editColumn('first_name', function ($row) {
                return Common::getUserWidget($row);
            })
            ->editColumn(
                'status',
                function ($row) {
                    $color = ['enabled' => 'success', 'disabled' => 'danger', 'waiting' => 'warning'];
                    return "<div class='badge badge-".$color[$row->status]."'>".
                        trans('app.'.$row->status). '</span>';
                }
            )
            ->editColumn(
                'email',
                function ($row) {
                    $data = $row->email. ' ';

                    if($row->email_verified == 'yes') {
                        $data .= '<i class="fa fa-check-circle" style="color: green;"></i>';
                    }

                    return $data;
                }
            )
            ->editColumn(
                'created_at',
                function ($row) {
                    return $row->created_at->format('d F, Y');
                }
            )
            ->addColumn('action', function ($row) {

                    if($row->id == 1 && $this->user->id != $row->id)
                    {
                        $text = trans('messages.notAllowed');
                    } else {
                        $text = '<div class="buttons">';

                        if($this->user->ability('admin', 'staff_edit')) {
                            $text .= '<a href="javascript:void(0);" onclick="editModal(' . $row->id . ')" class="btn btn-icon icon-left"
                      data-toggle="tooltip" data-original-title="' . trans('app.edit') . '"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="cs-icon cs-icon-edit mb-3 d-inline-block text-primary"><path d="M14.6263 2.54529C15.0872 2.08443 15.6781 1.79144 16.2692 1.73078C16.8603 1.67012 17.4031 1.84676 17.7782 2.22183C18.1533 2.5969 18.3299 3.13969 18.2692 3.73078C18.2086 4.32188 17.9156 4.91286 17.4547 5.37372L6.53217 16.2963L2.22183 17.7782L3.70375 13.4678L14.6263 2.54529Z"></path></svg></a>';
                        }

                        if($this->user->ability('admin', 'staff_delete')) {
                            if ($row->id != 1 && $this->user->id != $row->id) {
                                $text .= '<button onclick="deleteModal(' . $row->id . ')" class="btn btn-icon icon-left"
                          data-toggle="tooltip" data-original-title="' . trans('app.delete') . '"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="red" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="cs-icon cs-icon-bin mb-3 d-inline-block text-primary"><path d="M4 5V14.5C4 15.9045 4 16.6067 4.33706 17.1111C4.48298 17.3295 4.67048 17.517 4.88886 17.6629C5.39331 18 6.09554 18 7.5 18H12.5C13.9045 18 14.6067 18 15.1111 17.6629C15.3295 17.517 15.517 17.3295 15.6629 17.1111C16 16.6067 16 15.9045 16 14.5V5"></path><path d="M14 5L13.9424 4.74074C13.6934 3.62043 13.569 3.06028 13.225 2.67266C13.0751 2.50368 12.8977 2.36133 12.7002 2.25164C12.2472 2 11.6734 2 10.5257 2L9.47427 2C8.32663 2 7.75281 2 7.29981 2.25164C7.10234 2.36133 6.92488 2.50368 6.77496 2.67266C6.43105 3.06028 6.30657 3.62044 6.05761 4.74074L6 5"></path><path d="M2 5H18M12 9V13M8 9V13"></path></svg></button>';
                            }
                        }

                        $text .= '</div>';
                    }



                return $text;
            })
            ->rawColumns(['first_name', 'action', 'status', 'email'])
            ->make(true);
    }

    public function create()
    {
        $this->icon = 'plus';

        $this->userDetails = new User();
        $this->roles = Role::all();
        return view('admin.users.add-edit', $this->data);
    }

    public function store(StoreRequest $request)
    {
        \DB::beginTransaction();

        $user = new User();
        $this->storeAndUpdate($user, $request);

        // Saving Twilio Client Name
        $name = trim(strtolower($user->first_name));
        if($user->last_name != '')
        {
            $name .= ' '. trim(strtolower($user->last_name));
        }
        $name = str_replace(' ', '_', $name);
        $checkIfNameAlreadyExists = \App\Models\User::where('client_name', $name)->count();
        if($checkIfNameAlreadyExists > 0)
        {
            $name = $name.'_'.$user->id;
        }
        $user->client_name = $name;
        $user->save();

        \DB::commit();
        return Reply::success('messages.createSuccess');

    }

    public function edit($id)
    {
        $this->icon = 'edit';
        $this->userDetails = User::find($id);
        $this->roles = Role::all();

        // Call the same create view for edit
        return view('admin2.users.add-edit', $this->data);
    }

    public function update(UpdateRequest $request,$id)
    {

        \DB::beginTransaction();

        $user         = User::find($id);
        $this->storeAndUpdate($user, $request);

        \DB::commit();
        return Reply::success('messages.updateSuccess');

    }

    public function destroy(DeleteRequest $request, $id)
    {
        // Can not delete admin or himself
        if($this->user->id == $id || $id == 1)
        {
            return Reply::error('messages.notAllowed');
        }

        // After deleting this user assign all leads, appintments and pending callbacks to user who delete it
        Lead::where('first_actioned_by', $id)
            ->update(['first_actioned_by' => $this->user->id]);
        Lead::where('last_actioned_by', $id)
            ->update(['last_actioned_by' => $this->user->id]);
        Campaign::where('created_by', $id)
                ->update(['created_by' => $this->user->id]);
        Appointment::where('created_by', $id)
            ->update(['created_by' => $this->user->id]);
        Callback::where('attempted_by', $id)
            ->update(['attempted_by' => $this->user->id]);
        Form::where('created_by', $id)
            ->update(['created_by' => $this->user->id]);


        $user  = User::find($id);

        //Deleting image
        $this->deleteUserImage($user->image);

        $user->delete();

        return Reply::success('messages.deleteSuccess');
    }

    private function  storeAndUpdate($user, $request)
    {
        // If User Image uploaded
        if($request->hasFile('image'))
        {
            $largeLogo  = $request->file('image');

            $fileName   = 'user_'.strtolower(Str::random(20)).'.'.$largeLogo->getClientOriginalExtension();
            $largeLogo->move($this->userImagePath, $fileName);

            //Deleting previous image
            $this->deleteUserImage($user->image);

            $user->image        = $fileName;
        }

        if($request->password != '')
        {
            $user->password = Hash::make($request->password);
        }

        $user->first_name   = $request->first_name;
        $user->last_name   = $request->last_name;
        $user->email = $request->email;
        $user->contact_number = $request->contact_number;
        $user->skype_id = $request->skype_id;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->zip_code = $request->zip_code;
        $user->status = $request->status;
        $user->save();

        if($request->has('role_id') && $request->role_id != '' && $this->user->ability('admin', 'assign_role') && $this->user->id != $user->id && $user->id != 1)
        {
            $roleID = $request->role_id;

            $user->updateRole($roleID);
        }
    }

    protected function deleteUserImage($imagePath)
    {
        if($imagePath != null) {
            if (File::exists($this->userImagePath . '/' . $imagePath))
            {
                Common::deleteCommonFiles($this->userImagePath . '/' . $imagePath);
            }
        }
    }

}
