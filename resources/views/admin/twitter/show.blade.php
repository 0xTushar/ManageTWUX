@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.twitter.title_singular') }}:
                    {{ trans('cruds.twitter.fields.id') }}
                    {{ $twitter->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.twitter.fields.id') }}
                            </th>
                            <td>
                                {{ $twitter->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.twitter.fields.username') }}
                            </th>
                            <td>
                                {{ $twitter->username }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.twitter.fields.password') }}
                            </th>
                            <td>
                                **********
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.twitter.fields.status') }}
                            </th>
                            <td>
                                {{ $twitter->status_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.twitter.fields.token') }}
                            </th>
                            <td>
                                @if($twitter->token)
                                    <span class="badge badge-relationship">{{ $twitter->token->private_key ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('twitter_edit')
                    <a href="{{ route('admin.twitters.edit', $twitter) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.twitters.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection