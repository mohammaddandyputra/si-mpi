@extends('layouts.app')

@section('content')
{{-- {{dd($year)}} --}}
<!--Content right-->
{{-- @foreach ($tes as $user)
    <p>{{ $user->nama_komponen }}</p>
@endforeach --}}
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <div class="row mt-3">
        <div class="col-sm-12">
            <div class="mt-1 mb-3 p-3 button-container bg-white shadow-sm border">
                <h6 class="mb-2 text-center">MPI</h6>
                <canvas class="mt-4" id="tes"  height="125px"></canvas>
            </div>
        </div>
    </div>

    <!--Footer-->
    <div class="row mt-5 mb-4 footer">
        <div class="col-sm-8">
            <span>&copy; All rights reserved 2019 designed by <a class="text-info" href="#">A-Fusion</a></span>
        </div>
        <div class="col-sm-4 text-right">
            <a href="#" class="ml-2">Contact Us</a>
            <a href="#" class="ml-2">Support</a>
        </div>
    </div>
    <!--Footer-->
</div>

<script>
    // let year = <?php echo $year; ?>;
    // let user = <?php echo $user; ?>;

    // var data = {
    //     labels: year,
    //     datasets: [
    //         {
    //             label: 'Nilai MPI ',
    //             data: user,
    //             backgroundColor: 'rgba(255, 99, 132, 0.2)',
    //             borderColor: 'rgba(255,99,132,1)',
    //             borderWidth: 1
    //         }
    //     ]
    // };

    // window.onload = function() {
    //     var barChartCanvas = document.getElementById("tes").getContext("2d");
    //     var barChart = new Chart(barChartCanvas, {
    //         type: 'bar',
    //         data: data
            
    //     });
    // }

    const year = <?php echo $year; ?>;
    const user = <?php echo $user; ?>;
    const backgroundColor = 'rgba(255, 99, 132, 0.2)'
    const borderColor = 'rgba(255,99,132,1)'

    let merged = year.map((border, i) => {
        return { "datapoint": user[i], "label": year[i] }
    });

    const dataSort = merged.sort(function(a, b){
        return b.datapoint - a.datapoint
    });

    const db = [];
    const lab = [];

    for(i = 0; i < dataSort.length; i++){
        db.push(dataSort[i].datapoint);
        lab.push(dataSort[i].label);
    }

    var data = {
        labels: lab,
        datasets: [
            {
                label: 'Nilai MPI ',
                data: db,
                backgroundColor: backgroundColor,
                borderColor: borderColor,
                borderWidth: 1
            }
        ]
    };

    window.onload = function() {
        var barChartCanvas = document.getElementById("tes").getContext("2d");
        var barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: data
            
        });
    }
</script>
@endsection