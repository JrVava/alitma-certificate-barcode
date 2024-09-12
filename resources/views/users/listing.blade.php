@extends('layouts.app-layout')

@section('title', 'Doctors')

@section('content')

<div class="row">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Doctors</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Place</th>
                            <th>MCI Number</th>
                            <th>Faculty/ delegate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctors as $key => $doctor)
                            <tr>
                                <td>
                                    {{ $key+1 }}
                                </td>
                                <td>
                                    {{ $doctor->name }}
                                </td>
                                <td>
                                    {{ $doctor->place }}
                                </td>
                                <td>
                                    {{ $doctor->mci_number }}
                                </td>
                                <td>
                                    {{ $doctor->faculty_delegate }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
        {!! $doctors->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>
@endsection
