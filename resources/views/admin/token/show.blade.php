@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.token.title_singular') }}:
                    {{ trans('cruds.token.fields.id') }}
                    {{ $token->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.token.fields.id') }}
                            </th>
                            <td>
                                {{ $token->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.token.fields.private_key') }}
                            </th>
                            <td>
                                {{ $token->private_key }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.token.fields.uxwallet') }}
                            </th>
                            <td>
                                {{ $token->uxwallet }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.token.fields.token') }}
                            </th>
                            <td>
                                {{ $token->token }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.token.fields.aff') }}
                            </th>
                            <td>
                                {{ $token->aff }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.token.fields.status') }}
                            </th>
                            <td>
                                {{ $token->status_label }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('token_edit')
                    <a href="{{ route('admin.tokens.edit', $token) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.tokens.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection