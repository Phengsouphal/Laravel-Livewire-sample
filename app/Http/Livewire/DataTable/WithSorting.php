<?php

namespace App\Http\Livewire\DataTable;

trait WithSorting
{
    //sort only one column
    // public $sortField;
    // public $sortDirection = 'asc';
    public $sorts = [];

    public function sortBy($field)
    {

        if (!isset($this->sorts[$field])) {
            $this->sorts[$field] = 'asc';
            return;
        }

        if ($this->sorts[$field] === 'asc') {
            $this->sorts[$field] =  'desc';
            return;
        }


        unset($this->sorts[$field]);

        // if ($this->sortField === $field) {
        //     $this->sortDirection =  $this->sortDirection === 'asc' ? 'desc' : 'asc';
        // } else {
        //     $this->sortDirection = 'asc';
        // }

        // $this->sortField = $field;
    }

    public function applySorting($query)
    {
        // return   $query->orderBy($this->sortField, $this->sortDirection);
        foreach ($this->sorts as $field => $direct) {
            $query->orderBy($field, $direct);
        }

        return $query;
    }
}
