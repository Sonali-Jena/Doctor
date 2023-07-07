<!DOCTYPE html>
<html>
<head>
  <style>
    /* CSS styles */
    .form-container {
      width: 300px;
      margin: 0 auto;
    }

    .form-field {
      margin-bottom: 10px;
    }

    .form-label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .form-input {
      width: 100%;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .form-select {
      width: 100%;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .form-submit {
      padding: 10px 20px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
  </style>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
      crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
</head>
<body>
  <div class="form-container">
    <form  action="/insert"  method="post" enctype="multipart/form-data">
        @csrf
      {{-- <div class="form-field">
        <label for="name" class="form-label">Doctor Name:</label>
        <input type="text" id="name" name="doctorname" class="form-input" required>
      </div> --}}
      <div class="form-field">
        <label for="country" class="form-label">Doctor Name:</label>
        <select id="doctorname" name="doctorname" class="form-select" required>
          <option value="0">Select a Doctor Name</option>
          @foreach ($doctorData as $s)
          <option value="{{$s->Doctor_id}}">{{$s->Doctor_Name}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-field">
        <label for="country" class="form-label">Patient Name:</label>
        <select id="patientname" name="patientname" class="form-select" required>
          <option value="">Select a Patient Name</option>
        </select>
      </div>
      <div class="form-field">
        <label for="country" class="form-label">Disease Name:</label>
        <select id="diseasename" name="diseasename" class="form-select" required>
          <option value="">Select  Disease Name</option>
          @foreach ($diseaseData as $s)
          <option value="{{$s->disease_id}}">{{$s->disease_Name}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-field">
        <label for="country" class="form-label">Medicine Name:</label>
        <select id="medicinename" name="medicinename" class="form-select" required>
          <option value="">Select  Medicine Name</option>
        </select>
      </div>

      <div class="form-field">
        <label for="name" class="form-label">Prescription Details:</label>
        <textarea name="prescription" id="prescription" cols="30" rows="10"></textarea>
      </div>
      {{-- <div class="form-field">
        <label for="file" class="form-label">Upload File:</label>
        <input type="file" id="file" name="file" class="form-input" required>
      </div> --}}

      <div class="form-field">
        <input type="submit" value="Submit" class="form-submit">
      </div>
    </form>
  </div>
</body>
</html>
<table id="dataTable" class="table">
    <!-- Table content will be added dynamically -->
</table>

<script>

   $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#doctorname').change(function() {

                $.ajax({
                    url: 'PatientAjaxData',
                    type: 'get',
                    data: {
                        id: $(this).val(),
                        _token: '{{csrf_token()}}'
                    },
                    success: function(res) {
                        console.log(res);
                        $('#patientname').html(res);
                        // $('#tbl').
                    }
                });
            });
            $('#diseasename').change(function() {
                // alert('ok');
                $.ajax({
                    url: 'MedicineName',
                    type: 'get',
                    data: {
                        id: $(this).val(),
                        _token: '{{csrf_token()}}'
                    },
                    success: function(res) {
                        // console.log(res);
                        $('#medicinename').html(res);
                    }
                });
            });
            // -----------------------------------------------------------------------------------
            $(document).ready(function() {
            // Event handler for dropdown change
            $('#doctorname').on('change', function() {
                var selectedOption = $(this).val();
                if (selectedOption) {
                    // Perform Ajax request to fetch data for the selected option
                    $.ajax({
                        url: '/ShowData',
                        type: 'GET',
                        data: {
                            option: selectedOption
                        },
                        // console.log('data');
                        // alert(data);
                        success: function(data) {
                            var tableHTML = '<tr><th>Date_Of_appointment</th><th>Doctor_Name</th><th>Patient_Name</th><th>disease_Name</th><th>medicine_Name</th><th>Prescription Details</th><th>Download Links</th></tr>';
                        $.each(data, function(key, row) {
                            tableHTML += '<tr><td>' + row.Date_Of_appointment + '</td><td>' + row.Doctor_Name + '</td><td>' + row.Patient_Name + '</td><td>' + row.disease_Name + '</td><td>' + row.medicine_Name + '</td><td>' + row.prescription + '</td>  <td><a href="{{ url('pdf/') }}">Download</a></td></tr>';
                        });
                            // Update the table content
                            $('#dataTable').html(tableHTML);
                        }
                    });
                } else {
                    $('#dataTable').empty();
                }
            });
        });
// ---------------------------------------------------------------------
        //     $(document).ready(function() {
        //         $("#dataTable").hide();
        //         $("#doctorname").click(function(){
        //         $("#dataTable").show();
        //       });
        //     function updateTable() {
        //         $.ajax({
        //             url: '/ShowData',
        //             type: 'get',
        //             success: function(data) {
        //                 var tableHTML = '<tr><th>Date_Of_appointment</th><th>Patient_Name</th><th>Doctor_Name</th><th>disease_Name</th><th>medicine_Name</th></tr>';
        //                 $.each(data, function(key, row) {
        //                     tableHTML += '<tr><td>' + row.Date_Of_appointment + '</td><td>' + row.Doctor_Name + '</td><td>' + row.Patient_Name + '</td><td>' + row.disease_Name + '</td><td>' + row.medicine_Name + '</td></tr>';
        //                 });
        //                 $('#dataTable').html(tableHTML);
        //             }
        //         });
        //     }
        //     updateTable();
        //     $('#doctorname').change(function() {
        //         // updateTable();
        //     });
        // });
</script>
