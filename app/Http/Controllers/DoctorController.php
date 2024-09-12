<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Barryvdh\DomPDF\Facade\Pdf; // Use DomPDF facade
use App\Exports\DoctorExport;
use Maatwebsite\Excel\Facades\Excel;

class DoctorController extends Controller
{
    public function index(){
        $doctors = Doctor::paginate(10);
        return view("users.listing",['doctors' => $doctors]);
    }

    public function doctorsForm(){
        return view('users.form');
    }

    public function doctorSave(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'mci_number' => 'required|string|max:255',
            'faculty_delegate' => 'required|string|max:255',
        ]);
        
        $doctor = new Doctor;
        $doctor->fill($request->all());
        $doctor->save();

        return redirect()->back()
            ->with('success', 'Form Submitted successfully')
            ->with('doctor_id', $doctor->id);
    }

    public function download($doctor_id){
        $doctor = Doctor::find($doctor_id);

        $manager = new ImageManager(['driver' => 'imagick']);

        $certificatePath = public_path('assets/img/certificate.png');
        $certificate = $manager->make($certificatePath);

        $fontPath = public_path('assets/fonts/Nunito/Nunito-Regular.ttf');

        $certificate->text($doctor->name, 1700, 1000, function ($font) use ($fontPath) {
            $font->file($fontPath); // Ensure this path is correct
            $font->size(78);
            $font->color('#000000');
            $font->align('center');
            $font->valign('middle');
        });

        // $canvas->insert($certificate, 'top-left');
        $certificateWidth = $certificate->width();
        $certificateHeight = $certificate->height();
        $canvas = $manager->canvas($certificateWidth, $certificateHeight);
        $canvas->insert($certificate, 'top-left');
        $base64Image = (string) $canvas->encode('data-url');

        $base64Image = (string) $canvas->encode('data-url');

        // Pass image to PDF view
        $pdf = Pdf::loadView('users.pdf', compact('base64Image'))->setPaper([0, 0, 595, 842], 'landscape') // Example: Custom A4 size (landscape)
        ->setOption('margin-top', 0)
        ->setOption('margin-bottom', 0)
        ->setOption('margin-left', 0)
        ->setOption('margin-right', 0);

        return $pdf->download($doctor->name.'_certificate.pdf');
    }

    public function export()
    {
        return Excel::download(new DoctorExport, 'doctors.xlsx');
    }
}
