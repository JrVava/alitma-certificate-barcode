<?php

namespace App\Exports;

use App\Models\Doctor;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class DoctorExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $doctors = Doctor::get();
        $reponse = $doctors->map(function ($doctor) {
            return [
                $doctor->name,
                $doctor->place,
                $doctor->mci_number,
                $doctor->faculty_delegate,
                route('download', ['doctor_id' => $doctor->id])
            ];
        });
        return $reponse;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Place',
            'MCI Number',
            'Faculty / delegate',
            'Certificate',
        ];
    }
}
