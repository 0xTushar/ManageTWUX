@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.token.title_singular') }}:
                    {{ trans('cruds.token.fields.id') }}
                    {{ $token->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('token.edit', [$token])
        </div>
    </div>
</div>
@endsection