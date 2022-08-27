<div class="modal-header">
    <h5 class="modal-title">
        <i class="fa fa-{{ $icon }}"></i> @lang('module_form.addNewField')
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span></button>
</div>
{!!  Form::open(['url' => '','autocomplete'=>'off','id'=>'form-field-add-form']) 	 !!}
<div class="modal-body">

    <div class="form-group row">
        <label class="col-sm-3 col-form-label">@lang('module_form.fieldName')</label>
        <div class="col-sm-9">
            <input type="text" id="new_field_name" name="new_field_name" class="form-control" value="">
        </div>
    </div>

</div>
<div class="modal-footer bg-whitesmoke">
    <button id="saveFormButton" type="submit" class="btn btn-icon icon-left btn-success" onclick="addNewField();return false"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="cs-icon cs-icon-check mb-3 d-inline-block text-primary"><path d="M16 5L7.7051 14.2166C7.32183 14.6424 6.65982 14.6598 6.2547 14.2547L3 11"></path></svg> @lang('app.add')</button>
    <button class="btn default" data-dismiss="modal" aria-hidden="true">@lang('app.cancel')</button>
</div>
{{Form::close()}}
