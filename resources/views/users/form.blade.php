<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doctor Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-image: url({{ asset('assets/img/1.svg') }});
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgb(255 255 255 / 17%);
            /* White overlay with 50% opacity */
            z-index: -1;
            /* Ensure the overlay is behind the content */
        }

        .card {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            border-radius: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            /* Slightly transparent background */
        }

        /* Optional: Center the form vertically and horizontally */
        .container {
            max-width: 700px;
        }
        .custom-ok-button {
            background-color: #01a4d7 !important;
            color: #ffffff !important;
            border-color: #01a4d7 !important;
        }
        button.swal2-confirm.custom-ok-button.swal2-styled {
            background-color: #01a4d7 !important;
            color: #ffffff !important;
            border-color: #01a4d7 !important;
        }

        .btn-primary{
            color: white !important;
            background-color: #01a4d7 !important
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card p-4">
            <form action="{{ route('doctors.form.save') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Names</label>
                    <input type="text" class="form-control" placeholder="Name" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="place" class="form-label">Place</label>
                    <input type="text" class="form-control" placeholder="Place" id="place" name="place" value="{{ old('place') }}">
                    @error('place')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="mci_number" class="form-label">MCI Number</label>
                    <input type="text" class="form-control" placeholder="MCI Number" id="mci_number"
                        name="mci_number" value="{{ old('mci_number') }}">
                    @error('mci_number')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="faculty_delegate" class="form-label">Faculty / Delegate</label>
                    <input type="text" class="form-control" placeholder="Faculty / delegate" id="faculty_delegate"
                        name="faculty_delegate" value="{{ old('faculty_delegate') }}">
                    @error('faculty_delegate')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <script>
        @if (session('success') && session('doctor_id'))
            Swal.fire({
                text: "{{ session('success') }}", // Display the success message
                showClass: {
                    popup: `
                            animate__animated
                            animate__fadeInUp
                            animate__faster
                        `
                },
                hideClass: {
                    popup: `
                        animate__animated
                        animate__fadeOutDown
                        animate__faster
                    `
                },
                customClass: {
                    confirmButton: 'custom-ok-button' // You can still use this to style
                },
                showConfirmButton: false, // Hide the default confirm button
                html: `
                    <p>{{ session('success') }}</p> <!-- Display success message -->
                    <a href="{{ route('download', ['doctor_id' => session('doctor_id')]) }}" class="btn btn-primary mt-3">Download
                                        Certificate</a>
        ` // Add custom link here
            });
        @endif
    </script>
</body>

</html>
