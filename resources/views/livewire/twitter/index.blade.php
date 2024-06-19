<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('twitter_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Twitter" format="csv" />
                <livewire:excel-export model="Twitter" format="xlsx" />
                <livewire:excel-export model="Twitter" format="pdf" />
            @endif


            @can('twitter_create')
                <x-csv-import route="{{ route('admin.twitters.csv.store') }}" />
            @endcan

        </div>
        <div class="w-full sm:w-1/2 sm:text-right">
            Search:
            <input type="text" wire:model.debounce.300ms="search" class="w-full sm:w-1/3 inline-block" />
        </div>
    </div>
    <div wire:loading.delay>
        Loading...
    </div>

    <div class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-index w-full">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        <th class="w-28">
                            {{ trans('cruds.twitter.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.twitter.fields.username') }}
                            @include('components.table.sort', ['field' => 'username'])
                        </th>
                        <th>
                            {{ trans('cruds.twitter.fields.status') }}
                            @include('components.table.sort', ['field' => 'status'])
                        </th>
                        <th>
                            {{ trans('cruds.twitter.fields.token') }}
                            @include('components.table.sort', ['field' => 'token.private_key'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($twitters as $twitter)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $twitter->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $twitter->id }}
                            </td>
                            <td>
                                {{ $twitter->username }}
                            </td>
                            <td>
                                {{ $twitter->status_label }}
                            </td>
                            <td>
                                @if($twitter->token)
                                    <span class="badge badge-relationship">{{ $twitter->token->private_key ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('twitter_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.twitters.show', $twitter) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('twitter_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.twitters.edit', $twitter) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('twitter_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $twitter->id }})" wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10">No entries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-body">
        <div class="pt-3">
            @if($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $twitters->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('confirm', e => {
    if (!confirm("{{ trans('global.areYouSure') }}")) {
        return
    }
@this[e.callback](...e.argv)
})
    </script>
@endpush