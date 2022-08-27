@extends('admin2.layout')

@section('main')

    <div class="row">
        <div class="col-md-3">
            @include('admin2.partials.setting_sidebar')
        </div>
        <div class="col-md-9">
            {!! Form::open(['url' => '','class'=> ' ajax-form', 'id'=>'add-edit-form-field-name-form']) !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="card" id="settings-card">
                        <div class="card-header">
                        <h4>@lang('module_settings.updateFormFieldsName')</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">@lang('app.name')</label>
                                        <textarea name="name" class="form-control">{{ $formFieldNames->name }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">@lang('app.firstName')</label>
                                        <textarea name="first_name" class="form-control">{{ $formFieldNames->first_name }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">@lang('app.lastName')</label>
                                        <textarea name="last_name" class="form-control">{{ $formFieldNames->last_name }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">@lang('app.email')</label>
                                        <textarea name="email" class="form-control">{{ $formFieldNames->email }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">@lang('app.phone')</label>
                                        <textarea name="phone" class="form-control">{{ $formFieldNames->phone }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-whitesmoke text-md-left">
                            <button class="btn btn-primary" onclick="updateSetting();return false">@lang('app.save')</button>
                        </div>
                    </div>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>



@endsection

@section('modals')
    @include('admin2.partials.add-edit-modal')
@endsection

@section('scripts')
    <script>
        function updateSetting () {
            $.easyAjax({
                url: '{{route('admin2.settings.form-field-name.store')}}',
                container: '#add-edit-form-field-name-form',
                type: "POST",
                file: true,
                messagePosition: "toastr"
            })
        }
    </script>
@endsection
