<div>
    <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
    <x-button.primary wire:click="showNotification()">
        showNotification
    </x-button.primary>
    <div class="py-4 space-y-4">
        <div class="flex justify-between">
            <div class="w-2/4 flex space-x-4">
                <x-input.text wire:model="filters.search" placeholder="Search Transaction..." />

                <x-button.link wire:click="toggleShowFilter">
                    @if ($showFilter)
                    <span>Hide </span>
                    @endif
                    <span>Advanced Search</span>
                </x-button.link>
            </div>

            <div class="space-x-2 flex items-center ">

                <x-input.group borderless paddingless for="perPage" label="Per Page">
                    <x-input.select wire:model="perPage" id="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="30">30</option>
                    </x-input.select>

                </x-input.group>

                <x-dropdown label="Bulk Actions">

                    <x-dropdown.item type="button"
                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                        wire:click="exportSelected()" class="flex items-center space-x-2">
                        <x-icon.download class="text-cool-gray-400" />
                        <span>Export</span>
                    </x-dropdown.item>

                    <x-dropdown.item type="button" wire:click="$toggle('showDeleteModal')"
                        class="flex items-center space-x-2">
                        <x-icon.trash class="text-cool-gray-400" />
                        <span>Delete</span>
                    </x-dropdown.item>

                </x-dropdown>

                <x-button.primary wire:click="create()">
                    <x-icon.plus />
                    Create
                </x-button.primary>
            </div>
        </div>

        <div>
            @if ($showFilter)
            <div class="bg-cool-gray-200 p-4 rounded shadow-inner flex relative">
                <div class="w-1/2 pr-2 space-y-4">
                    <x-input.group inline label="Filter Status" for="filter-status">
                        <x-input.select wire:model.lazy="filters.status" name="filter-status" id="filter-status">
                            <option disabled value="">Select Status...</option>
                            @foreach (App\Models\Transaction::STATUSES as $value => $label )
                            <option value="{{$value}}">{{$label}}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>

                    <x-input.group inline label="Min Amount" for="min-amount">
                        <x-input.money wire:model.lazy="filters.min-amount" id="min-amount" />
                    </x-input.group>


                    <x-input.group inline label="Max Amount" for="max-amount">
                        <x-input.money wire:model.lazy="filters.max-amount" id="max-amount" />
                    </x-input.group>


                </div>
                <div class="w-1/2 pl-2 space-y-4">
                    <x-input.group inline label="Min Date" for="min-date">
                        <x-input.date wire:model.lazy="filters.min-date" id="min-date" placeholder="MM/DD/YYYY" />
                    </x-input.group>

                    <x-input.group inline label="Max Date" for="max-date">
                        <x-input.date wire:model.lazy="filters.max-date" id="max-date" placeholder="MM/DD/YYYY" />
                    </x-input.group>

                    <x-button.link wire:click="resetFilter()" class="absolute right-0 bottom-0 p-4">
                        <span>Reset Filter</span>
                    </x-button.link>
                </div>
            </div>
            @endif
        </div>

        <div class=" flex-col space-y-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading class="pr-0 w-8">
                        <x-input.checkbox wire:model="selectPage" />
                    </x-table.heading>

                    <x-table.heading sortable multi-column wire:click="sortBy('title')" {{-- sort only 1 column --}}
                        {{-- :direction="$sortField === 'title' ? $sortDirection  : null" --}}
                        :direction="$sorts['title'] ?? null" class="w-full">
                        Title
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('amount')" {{--
                        :direction="$sortField === 'amount' ? $sortDirection  : null" --}}
                        :direction="$sorts['amount'] ?? null">
                        Amount
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('status')" {{--
                        :direction="$sortField === 'status' ? $sortDirection  : null" --}}
                        :direction="$sorts['status'] ?? null">
                        Status
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('date')" {{--
                        :direction="$sortField === 'date' ? $sortDirection  : null" --}}
                        :direction="$sort['date'] ?? null">
                        Date
                    </x-table.heading>
                    <x-table.heading>

                    </x-table.heading>
                </x-slot>

                <x-slot name="body">

                    @if ($selectPage)
                    <x-table.row wire:key="row-message" class="bg-cool-gray-200">
                        <x-table.cell colspan="6">
                            @unless ($selectAll)
                            <div>
                                <span>
                                    You selected <strong>{{$transactions->count()}}</strong> transactions, do you want
                                    to
                                    select
                                    all
                                    <strong>{{$transactions->total()}}</strong>?
                                    <x-button.link wire:click="selectAll" class="text-red-500 ml-1"> Select All
                                    </x-button.link>

                                </span>
                            </div>

                            @else
                            <span>
                                You are currently selecting all <strong>{{$transactions->total()}}</strong>.
                            </span>
                            @endunless

                        </x-table.cell>
                    </x-table.row>
                    @endif

                    @JSON($selected)

                    @forelse ($transactions as $item)
                    <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{$item->id}}">
                        <x-table.cell class="pr-0">
                            <x-input.checkbox wire:model="selected" value="{{$item->id}}" />
                        </x-table.cell>

                        <x-table.cell>
                            <span class="inline-flex space-x-2 truncate text-sm leading-5">
                                <x-icon.cash class="text-cool-gray-400" />
                                <p class="text-cool-gray-600 truncate">
                                    {{$item->title}}
                                </p>
                            </span>
                        </x-table.cell>

                        <x-table.cell>
                            <span class="text-cool-gray-900 font-medium">
                                $ {{$item->amount}} USD
                            </span>
                        </x-table.cell>

                        <x-table.cell>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-{{ $item->status_color }}-100 text-{{ $item->status_color }}-800 ">
                                {{$item->status}}
                            </span>
                        </x-table.cell>

                        <x-table.cell>
                            {{$item->date_for_humans}}
                        </x-table.cell>

                        <x-table.cell>
                            <x-button.link wire:click="edit({{$item->id}})">
                                Edit
                            </x-button.link>
                        </x-table.cell>
                    </x-table.row>
                    @empty
                    <x-table.row wire:loading.class.delay="opacity-50">
                        <x-table.cell colspan="6">
                            <div class="flex justify-center items-center space-x-2">
                                <x-icon.inbox class="h-8 w-8 text-cool-gray-300" />
                                <span class="font-medium py-8 text-cool-gray-400 text-xl">
                                    No transactions found
                                </span>
                            </div>

                        </x-table.cell>
                    </x-table.row>
                    @endforelse


                </x-slot>

            </x-table>

            <div>
                {{ $transactions->links() }}

            </div>
        </div>

        <form wire:submit.prevent="deleteSelected">
            <x-modal.confirmation wire:model.defer="showDeleteModal">
                <x-slot name="title">
                    Delete Transaction
                </x-slot>

                <x-slot name="content">
                    Are you sure you want to delete these transaction? This action is irreversible.
                </x-slot>

                <x-slot name="footer">
                    <x-button.secondary wire:click="$set('showDeleteModal', false)">
                        Cancel
                    </x-button.secondary>

                    <x-button.primary type="submit">
                        Delete
                    </x-button.primary>
                </x-slot>
            </x-modal.confirmation>
        </form>

        <form wire:submit.prevent="save">
            <x-modal.dialog wire:model.defer="showEditModal">
                <x-slot name="title">
                    Edit Transaction
                </x-slot>

                <x-slot name="content">
                    <x-input.group label="Title" for="title" :error="$errors->first('editing.title')">
                        <x-input.text wire:model="editing.title" id="title" />
                    </x-input.group>

                    <x-input.group label="Amount" for="amount" :error="$errors->first('editing.amount')">
                        <x-input.money wire:model="editing.amount" id="amount" />
                    </x-input.group>

                    <x-input.group label="Status" for="status" :error="$errors->first('editing.status')">
                        <x-input.select wire:model="editing.status" name="status" id="status">
                            @foreach (App\Models\Transaction::STATUSES as $value => $label )
                            <option value="{{$value}}">{{$label}}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group>

                    <x-input.group label="Date" for="date_for_editing"
                        :error="$errors->first('editing.date_for_editing')">
                        <x-input.date wire:model="editing.date_for_editing" id="date_for_editing" />
                    </x-input.group>

                </x-slot>

                <x-slot name="footer">
                    <x-button.secondary wire:click="cancel()">
                        Cancel
                    </x-button.secondary>

                    <x-button.primary type="submit">
                        Save
                    </x-button.primary>
                </x-slot>
            </x-modal.dialog>
        </form>


    </div>
</div>