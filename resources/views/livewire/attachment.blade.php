@if ($currentStep != 3)
    <div style="display: none" class="row setup-content" id="step-3">
        @endif
        <div class="col-xs-12">
            <div class="col-md-12">
                <label style="color: red">{{trans('Parent_trans.Attachments')}}</label>
                <div class="form-group">
                    <input type="file" wire:model="photos" accept="image/*" multiple>
                </div>
                <br>

                <input type="hidden" wire:model="Parent_id">

                <h3 style="font-family: 'Cairo', sans-serif;">هل انت متاكد من حفظ البيانات ؟</h3><br>
                <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button"
                        wire:click="back">{{ trans('Parent_trans.Back') }}
                </button>
                @if($updateMode)
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                            wire:click="submitForm_edit"
                            type="button">{{trans('Parent_trans.Finish')}}
                    </button>
                @else
                    <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="submitForm"
                            type="button">{{ trans('Parent_trans.Finish') }}</button>
                @endif
            </div>
        </div>
    </div>
    </div>


    {{--//<div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">--}}
