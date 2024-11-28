<div>
    <h1 class="text-2xl font-semibold text-gray-900">Plants</h1>
    <div class="py-4 space-y-4">
        <div class="flex justify-between">
            <div class="w-2/4 flex space-x-4">
                <x-input.text wire:model="filters.search" placeholder="Search Transaction..." />

            </div>
            <div class="space-x-2 flex items-center ">
                <x-input.group borderless paddingless for="perPage" label="Per Page">
                    <x-input.select wire:model="perPage" id="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="30">30</option>
                    </x-input.select>

                </x-input.group>

                <x-button.primary wire:click="create()">
                    <x-icon.plus />
                    Create
                </x-button.primary>
            </div>
        </div>
        <div class=" flex-col space-y-4">
            <x-table>
                <x-slot name="head">

                    <x-table.heading sortable multi-column wire:click="sortBy('title')" {{-- sort only 1 column --}}
                        {{-- :direction="$sortField === 'title' ? $sortDirection  : null" --}}
                        :direction="$sorts['title'] ?? null" class="w-full">
                        Title
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('price')" {{--
                        :direction="$sortField === 'amount' ? $sortDirection  : null" --}}
                        :direction="$sorts['price'] ?? null">
                        Price
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('stock')" {{--
                        :direction="$sortField === 'status' ? $sortDirection  : null" --}}
                        :direction="$sorts['stock'] ?? null">
                        Stock
                    </x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('description')" {{--
                        :direction="$sortField === 'date' ? $sortDirection  : null" --}}
                        :direction="$sort['description'] ?? null">
                        Description
                    </x-table.heading>
                    <x-table.heading>

                    </x-table.heading>
                </x-slot>

                <x-slot name="body">

                    @forelse ($plants as $item)
                    <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{$item->id}}">

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

                                $ {{$item->price}} USD
                            </span>
                        </x-table.cell>

                        <x-table.cell>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-{{ $item->status_color }}-100 text-{{ $item->status_color }}-800 ">
                                {{$item->stock}} stock
                            </span>
                        </x-table.cell>

                        <x-table.cell>
                            {{$item->description}}
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
                                    No plants found
                                </span>
                            </div>

                        </x-table.cell>
                    </x-table.row>
                    @endforelse


                </x-slot>

            </x-table>

            <div>
                {{ $plants->links() }}

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

                    <x-input.group label="Price" for="price" :error="$errors->first('editing.price')">
                        <x-input.money wire:model="editing.price" id="price" />
                    </x-input.group>

                    <x-input.group label="Stock" for="stock" :error="$errors->first('editing.stock')">
                        <x-input.text type="number" min="0" wire:model="editing.stock" id="stock" />
                    </x-input.group>

                    <x-input.group label="Description" for="description">

                        <x-input.textarea wire:initial-value="editing.description" wire:model.lazy="editing.description"
                            id="description" name="description" />
                    </x-input.group>


                    {{--
                    <x-input.group label="Status" for="status" :error="$errors->first('editing.status')">
                        <x-input.select wire:model="editing.status" name="status" id="status">
                            @foreach (App\Models\Transaction::STATUSES as $value => $label )
                            <option value="{{$value}}">{{$label}}</option>
                            @endforeach
                        </x-input.select>
                    </x-input.group> --}}

                    {{-- <x-input.group label="Date" for="date_for_editing"
                        :error="$errors->first('editing.date_for_editing')">
                        <x-input.date wire:model="editing.date_for_editing" id="date_for_editing" />
                    </x-input.group> --}}

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

    {{-- The Master doesn't talk, he acts. --}}
</div>