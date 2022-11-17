<?php

namespace App\Http\Livewire;

use App\Http\Livewire\DataTable\WithCacheRows;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Plants;
use Livewire\Component;

class PlantList extends Component
{
    use WithPerPagePagination, WithSorting,  WithCacheRows;

    public $showEditModal = false;
    public $showDeleteModal = false;


    public $filters = [
        'search' => "",

    ];

    public Plants $editing;

    public function mount()
    {
        $this->editing = $this->makeBlankPlant();
    }

    public function makeBlankPlant()
    {
        return  Plants::make(['title' => '',]);
    }

    public function rules()
    {
        return [
            'editing.title' => 'required|min:3',
            'editing.price' => 'required|numeric|min:0|not_in:0',
            'editing.stock' => 'required|numeric|min:0|not_in:0',
            'editing.description' => '',
        ];
    }

    public function edit(Plants $plant)
    {
        // $this->useCacheRows();
        if ($this->editing->isNot($plant)) {
            $this->editing =  $plant;
        }
        $this->showEditModal = true;
    }

    public function create()
    {
        // $this->useCacheRows(); 
        if ($this->editing->getKey()) {
            $this->editing = $this->makeBlankPlant();
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


    public function getRowsQueryProperty()
    {
        $query = Plants::query()
            // ->when($this->filters['status'], fn ($query, $status) => $query->where('status', $status))
            // ->when($this->filters['min-amount'], fn ($query, $amount) => $query->where('amount', '>=', $amount))
            // ->when($this->filters['max-amount'], fn ($query, $amount) => $query->where('amount', '<=', $amount))
            // ->when($this->filters['min-date'], fn ($query, $date) => $query->where('date', '>=', Carbon::parse($date)))
            // ->when($this->filters['max-date'], fn ($query, $date) => $query->where('date',  '<=', Carbon::parse($date)))
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
        return view('livewire.plant-list', [
            'plants' =>  $this->rows,
        ])->layout('layouts.app');
    }
}
