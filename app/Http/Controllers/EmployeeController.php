<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Services\EmployeesService;
use App\Http\Services\SequencesService;
use Illuminate\Http\Request;

class EmployeeController extends BaseController
{
    public function index(Request $request, EmployeesService $employeesService)
    {
        return [
            "statusCode" => 200,
            "data" => $employeesService->all()
        ];
    }

    public function store(Request $request, EmployeesService $employeesService)
    {
        return [
            "statusCode" => 201,
            "uuid" => $employeesService->save($request->all()),
        ];
    }

    public function update($id, Request $request, EmployeesService $employeesService)
    {
        $employeesService->update($id, $request->all());
        return [
            "statusCode" => 200,
        ];
    }

    public function destroy($id, EmployeesService $employeesService)
    {
        $employeesService->delete($id);
        return [
            "statusCode" => 200,
        ];
    }
}
