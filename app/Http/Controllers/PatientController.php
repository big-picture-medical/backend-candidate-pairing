<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PatientController
{
    /**
     * @return AnonymousResourceCollection<Patient>
     */
    public function index(): AnonymousResourceCollection
    {
        return PatientResource::collection(Patient::paginate());
    }

    public function store(CreatePatientRequest $request): PatientResource
    {
        $patient = Patient::create($request->validated());

        return PatientResource::make($patient);
    }

    public function show(Patient $patient): PatientResource
    {
        return PatientResource::make($patient);
    }

    public function update(UpdatePatientRequest $request, Patient $patient): PatientResource
    {
        $patient->update($request->validated());

        return PatientResource::make($patient);
    }
}
