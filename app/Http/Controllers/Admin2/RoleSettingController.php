<?php

namespace App\Http\Controllers\Admin2;

use App\Classes\Reply;
use App\Http\Requests\Admin\Role\IndexRequest;
use App\Http\Requests\Admin\Role\DeleteRequest;
use App\Http\Requests\Admin\Role\StoreRequest;
use App\Http\Requests\Admin\Role\UpdateRequest;
use App\models\Permission;
use App\Models\Role;

class RoleSettingController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = trans('module_settings.roleAndPermissionSettings');
        $this->pageIcon = 'fa fa-user-cog';
        $this->settingMenuActive = 'active';
        $this->roleSettingsActive = 'active';
    }

    public function index(IndexRequest $request)
    {
        return view('admin2.settings.roles.index', $this->data);
    }

    public function getList()
    {
        $data = Role::select('id', 'name', 'display_name', 'description', 'created_at');

        return datatables()->eloquent($data)
            ->editColumn(
                'created_at',
                function ($row) {
                    return $row->created_at->format('d F, Y');
                }
            )
            ->addColumn('action', function ($row) {
                if($row->name == 'admin')
                {
                    return '-';
                } else {
                    return '<a href="javascript:void(0);" onclick="editModal('.$row->id.')" class="btn btn-icon icon-left mb-2"
                      data-toggle="tooltip" data-original-title="'.trans('app.edit').'"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="cs-icon cs-icon-check mb-3 d-inline-block text-primary"><path d="M16 5L7.7051 14.2166C7.32183 14.6424 6.65982 14.6598 6.2547 14.2547L3 11"></path></svg></a>

                      <button onclick="deleteModal('.$row->id.')" class="btn btn-icon icon-left mb-2"
                      data-toggle="tooltip" data-original-title="'.trans('app.delete').'"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="red" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="cs-icon cs-icon-bin mb-3 d-inline-block text-primary"><path d="M4 5V14.5C4 15.9045 4 16.6067 4.33706 17.1111C4.48298 17.3295 4.67048 17.517 4.88886 17.6629C5.39331 18 6.09554 18 7.5 18H12.5C13.9045 18 14.6067 18 15.1111 17.6629C15.3295 17.517 15.517 17.3295 15.6629 17.1111C16 16.6067 16 15.9045 16 14.5V5"></path><path d="M14 5L13.9424 4.74074C13.6934 3.62043 13.569 3.06028 13.225 2.67266C13.0751 2.50368 12.8977 2.36133 12.7002 2.25164C12.2472 2 11.6734 2 10.5257 2L9.47427 2C8.32663 2 7.75281 2 7.29981 2.25164C7.10234 2.36133 6.92488 2.50368 6.77496 2.67266C6.43105 3.06028 6.30657 3.62044 6.05761 4.74074L6 5"></path><path d="M2 5H18M12 9V13M8 9V13"></path></svg></button>';
                }

            })
            ->make(true);

    }

    public function create()
    {
        $this->icon = 'plus';

        $this->roleDetails = new Role();
        $this->permission = $this->calculatePermission();

        // Call the same create view for edit
        return view('admin2.settings.roles.add-edit', $this->data);
    }

    public function store(StoreRequest $request)
    {
        if($request->name == 'admin')
        {
            return Reply::error('messages.adminRoleNameNotAllowed');
        }

        \DB::beginTransaction();

        $role = new Role();
        $this->storeAndUpdate($role, $request);

        \DB::commit();
        return Reply::success('messages.createSuccess');

    }

    public function edit($id)
    {
        $this->icon = 'edit';
        $this->roleDetails = Role::find($id);
        $this->permission = $this->calculatePermission($id);

        // Call the same create view for edit
        return view('admin2.settings.roles.add-edit', $this->data);
    }

    public function update(UpdateRequest $request,$id)
    {
        \DB::beginTransaction();

        $role         = Role::find($id);

        if($role->name == 'admin')
        {
            return Reply::error('messages.adminRoleNameNotAllowed');
        }

        $this->storeAndUpdate($role, $request);

        \DB::commit();
        return Reply::success('messages.updateSuccess');

    }

    public function destroy(DeleteRequest $request, $id)
    {

        $role = Role::find($id);

        if($role->name == 'admin')
        {
            return Reply::error('messages.notAllowed');
        }

        $role->delete();

        return Reply::success('messages.deleteSuccess');
    }

    protected function calculatePermission($roleID = NULL)
    {
        $allPermissions = Permission::all();

        foreach ($allPermissions as $allPermission) {
            $permissionName = $allPermission->name;
            $permissionID = $allPermission->id;

            // If edit method fired
            if($roleID != NULL)
            {
                $isAttached = $allPermission->isPermissionAttachToRole($roleID);

                $status = $isAttached ? "checked" : '';

            }else{
                $status = '';
            }

            $permission[ $permissionName ] = ['id' => $permissionID, 'status' => $status];
        }

        return $permission;
    }

    private function  storeAndUpdate($role, $request)
    {
        $role->display_name   = $request->display_name;
        $role->name   = $request->name;
        $role->description   = $request->description;

        if($role->id != NULL)
        {
            $role->deleteRolePermissions();
        }

        $role->save();

        $permissions = $request->permissions;

        if($request->permissions){
            foreach($permissions as $permission)
            {
                $role->insertRolePermission($permission);
            }
        }

    }

}
