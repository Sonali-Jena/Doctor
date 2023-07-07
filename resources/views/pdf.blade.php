
<table class="table">
    <thead>
        <tr>
            <th scope="col">Sl No</th>
            <th scope="col">Date_Of_appointment</th>
            <th scope="col">Patient_Name</th>
            <th scope="col">Doctor_Name</th>
            <th scope="col">disease_Name</th>
            <th scope="col">medicine_Name</th>
            <th scope="col">Download PDF</th>

        </tr>
    </thead>
    <?php
    // print_r($disease)
    ?>
    <tbody>
        @foreach ($ShowData as $s)
        <tr>
            <td>{{ $s->slno}}</td>
            <td>{{ $s->Date_Of_appointment}}</td>
            <td>{{ $s->Patient_Name}}</td>
            <td>{{ $s->Doctor_Name}}</td>
            <td>{{ $s->disease_Name}}</td>
            <td>{{ $s->medicine_Name}}</td>
            {{-- <td><a href="{{url('/pdf')}}/{{ $s->slno}}"><button class="btn btn-success">Download in PDF Format</button></a></td> --}}

          {{-- </tr>
          @endforeach
    </tbody>
