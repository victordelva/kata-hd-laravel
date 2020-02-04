<?php

namespace App\Http\Services;

use App\Domain\Elevator;
use App\Domain\ElevatorRequest;
use App\Domain\ElevatorStatus;
use App\Domain\Employee;
use App\Domain\SequenceElevatorRequest;
use App\Events\TurnOnElevators;
use App\Repositories\EmployeesRepositoryContract;
use App\Repositories\ElevatorRequestRepositoryContract;
use App\Repositories\SequenceElevatorRequestRepositoryContract;

class EmployeesService
{
    private $employeesRepository;

    public function __construct(
        EmployeesRepositoryContract $employeesRepository
    )
    {
        $this->employeesRepository = $employeesRepository;
    }


    public function all()
    {
        return $this->employeesRepository->all();
    }

    public function save(array $params)
    {
        $employee = new Employee($params);
        $employee->working_hours = $params["working-hours"] ?? "";
        $this->employeesRepository->save($employee);
        return $employee->id;
    }

    public function update($id, array $params)
    {
        $this->employeesRepository->update($id, $params);
    }

    public function delete($id)
    {
        $this->employeesRepository->delete($id);
    }
}
