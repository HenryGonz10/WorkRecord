<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class TableClientes extends Component
{
    use WithPagination;

    public $search = '';
    public $sortColumn = 'users.id'; // Columna por defecto para ordenar
    public $sortDirection = 'asc';   // Dirección por defecto para ordenar
    public $showSearch = true;
    public $showPagination = true;
    public $visibleColumns = ['Id', 'Codigo', 'Empresa', 'Cliente', 'Email'];
    public $hasActionsColumn = true;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortColumn' => ['except' => 'users.id'],
        'sortDirection' => ['except' => 'asc'],
    ];

    public function sortBy($column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumn = $column;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = DB::table('users')
            ->select(
                'users.id as Id',
                'users.codigo as Codigo',
                'empresas.nombre as Empresa',
                'users.name as Cliente',
                'users.email as Email'
            )
            ->leftJoin('empresas', 'users.empresa_id', '=', 'empresas.id')
            ->where('users.estado', 1)
            ->whereNull('users.password');

        // Validar que $sortColumn no esté vacío y sea una columna válida para ordenar
        if (!empty($this->sortColumn)) {
            $query->orderBy($this->sortColumn, $this->sortDirection);
        } else {
            // Ordenar por defecto si $sortColumn está vacío
            $query->orderBy('users.id', 'asc');
        }

        // Aplicar búsqueda si se especifica
        if ($this->search) {
            $query->where(function ($query) {
                $query->where('users.name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.email', 'like', '%' . $this->search . '%')
                    ->orWhere('empresas.nombre', 'like', '%' . $this->search . '%');
            });
        }

        // Ejecutar la consulta paginada
        $data = $query->paginate(10);

        return view('livewire.table-clientes', [
            'data' => $data,
        ]);
    }
}
