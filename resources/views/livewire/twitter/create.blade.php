<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('twitter.username') ? 'invalid' : '' }}">
        <label class="form-label required" for="username">{{ trans('cruds.twitter.fields.username') }}</label>
        <input class="form-control" type="text" name="username" id="username" required wire:model.defer="twitter.username">
        <div class="validation-message">
            {{ $errors->first('twitter.username') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.twitter.fields.username_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('twitter.password') ? 'invalid' : '' }}">
        <label class="form-label" for="password">{{ trans('cruds.twitter.fields.password') }}</label>
        <input class="form-control" type="password" name="password" id="password" wire:model.defer="password">
        <div class="validation-message">
            {{ $errors->first('twitter.password') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.twitter.fields.password_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('twitter.status') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.twitter.fields.status') }}</label>
        @foreach($this->listsForFields['status'] as $key => $value)
            <label class="radio-label"><input type="radio" name="status" wire:model="twitter.status" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('twitter.status') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.twitter.fields.status_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('twitter.token_id') ? 'invalid' : '' }}">
        <label class="form-label" for="token">{{ trans('cruds.twitter.fields.token') }}</label>
        <x-select-list class="form-control" id="token" name="token" :options="$this->listsForFields['token']" wire:model="twitter.token_id" />
        <div class="validation-message">
            {{ $errors->first('twitter.token_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.twitter.fields.token_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.twitters.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>