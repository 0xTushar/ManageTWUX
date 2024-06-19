<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('token.private_key') ? 'invalid' : '' }}">
        <label class="form-label required" for="private_key">{{ trans('cruds.token.fields.private_key') }}</label>
        <input class="form-control" type="text" name="private_key" id="private_key" required wire:model.defer="token.private_key">
        <div class="validation-message">
            {{ $errors->first('token.private_key') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.token.fields.private_key_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('token.uxwallet') ? 'invalid' : '' }}">
        <label class="form-label" for="uxwallet">{{ trans('cruds.token.fields.uxwallet') }}</label>
        <input class="form-control" type="text" name="uxwallet" id="uxwallet" wire:model.defer="token.uxwallet">
        <div class="validation-message">
            {{ $errors->first('token.uxwallet') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.token.fields.uxwallet_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('token.token') ? 'invalid' : '' }}">
        <label class="form-label" for="token">{{ trans('cruds.token.fields.token') }}</label>
        <textarea class="form-control" name="token" id="token" wire:model.defer="token.token" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('token.token') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.token.fields.token_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('token.aff') ? 'invalid' : '' }}">
        <label class="form-label" for="aff">{{ trans('cruds.token.fields.aff') }}</label>
        <input class="form-control" type="text" name="aff" id="aff" wire:model.defer="token.aff">
        <div class="validation-message">
            {{ $errors->first('token.aff') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.token.fields.aff_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('token.status') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.token.fields.status') }}</label>
        @foreach($this->listsForFields['status'] as $key => $value)
            <label class="radio-label"><input type="radio" name="status" wire:model="token.status" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('token.status') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.token.fields.status_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.tokens.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>