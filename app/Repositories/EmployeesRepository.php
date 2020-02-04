<?php

namespace App\Repositories;

use App\Domain\Employee;
use Illuminate\Support\Facades\DB;

class EmployeesRepository implements EmployeesRepositoryContract
{

    public function all()
    {
        return Employee::all();
    }

    public function save(Employee $employee)
    {
        return $employee->save();
    }

    public function update($id, $params)
    {
        Employee::where(['id' => $id])->update($params);
    }

    public function delete($id)
    {
        Employee::where(['id' => $id])->delete();
    }
}
