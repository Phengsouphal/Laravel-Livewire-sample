<?php

namespace App\Http\Livewire;

use App\Http\Livewire\DataTable\WithBulkAction;
use App\Http\Livewire\DataTable\WithCacheRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{

    public function showNotification()
    {
        $this->dispatchBrowserEvent('notify', 'Some Message');
        $this->dispatchBrowserEvent('notify', 'Some Message');
        $this->dispatchBrowserEvent('notify', 'Some Message');
    }

    use WithPerPagePagination, WithSorting, WithBulkAction, WithCacheRows;

    public $showEditModal = false;
    public $showDeleteModal = false;

    public $showFilter = false;



    public $filters = [
        'search' => "",
        'status' => "",
        'min-amount' => null,
        'max-amount' => null,
        'min-date' => null,
        'max-date' => null,
    ];

    public Transaction $editing;

    protected $queryString = [];

    public function rules()
    {
        return [
            'editing.title' => 'required|min:3',
            'editing.amount' => 'required',
            'editing.status' => 'required|in:' . collect(Transaction::STATUSES)->keys()->implode(','),
            'editing.date_for_editing' => 'required',
        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankTransaction();
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }


    public function deleteSelected()
    {
        $this->selectedRowsQuery->delete();
        $this->showDeleteModal = false;
        //if not add this line it will show 404 not found when create and delete and continue search'
        $this->editing = $this->makeBlankTransaction();
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            dd(Transaction::whereKey($this->selected)->toCsv());
            echo Transaction::whereKey($this->selected)->toCsv();
        }, 'transaction.csv');
    }

    public function makeBlankTransaction()
    {
        return  Transaction::make(['date' => now(), 'status' => 'success']);
    }

    public function toggleShowFilter()
    {
        // $this->useCacheRows();
        $this->showFilter = !$this->showFilter;
    }

    public function create()
    {
        // $this->useCacheRows();

        if ($this->editing->getKey()) {
            $this->editing = $this->makeBlankTransaction();
        }
        $this->showEditModal = true;
    }

    public function edit(Transaction $transaction)
    {
        // $this->useCacheRows();

        if ($this->editing->isNot($transaction)) {
            $this->editing =  $transaction;
        }
        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->showEditModal = false;
    }

    public function cancel()
    {
        $this->showEditModal = false;
    }


    public function resetFilter()
    {
        $this->reset('filters');
    }


    public function getRowsQueryProperty()
    {
        $query = Transaction::query()
            ->when($this->filters['status'], fn ($query, $status) => $query->where('status', $status))
            ->when($this->filters['min-amount'], fn ($query, $amount) => $query->where('amount', '>=', $amount))
            ->when($this->filters['max-amount'], fn ($query, $amount) => $query->where('amount', '<=', $amount))
            ->when($this->filters['min-date'], fn ($query, $date) => $query->where('date', '>=', Carbon::parse($date)))
            ->when($this->filters['max-date'], fn ($query, $date) => $query->where('date',  '<=', Carbon::parse($date)))
            ->when($this->filters['search'], fn ($query, $search) => $query->where('title',  'like', '%' . $search . '%'));

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->cache(function () {
            return $this->applyPagination($this->rowsQuery);
        });
    }

    public function render()
    {

        if ($this->selectAll)  $this->selectPageRows();

        return view('livewire.dashboard', [
            'transactions' => $this->rows,
        ])->layout('layouts.app');
    }
}
