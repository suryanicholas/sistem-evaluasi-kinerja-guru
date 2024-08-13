@extends('layouts.dashboard')


@section('contents')
    <div class="container h-100 d-flex flex-column">
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-lg-12 py-2 d-flex bg-light border rounded shadow gap-2">
                    <a href="{{ route('evaluations.index') }}" class="btn btn-secondary p-1 fs-6 material-symbols-outlined">keyboard_backspace</a>
                    <div class="vr me-auto"></div>
                    <a href="{{ route('evaluations.edit', $data->slug) }}" class="btn btn-secondary p-1 fs-6 material-symbols-outlined">edit</a>
                    <form action="{{ route('evaluations.destroy', $data->slug) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger p-1 fs-6 material-symbols-outlined" type="submit">delete</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row py-3 overflow-y-auto">
            <div class="col-lg-12">
                <div class="h4">{{ $data->title }}</div>
            </div>
            <div class="col-lg-8 text-center">
                <canvas class="bg-dark p-2 rounded" id="yearlyPerformance"></canvas>
            </div>
            <div class="col-lg-4">
                <button class="btn btn-primary col-lg-12" type="button" data-index="0" data-charts="@json(array_values($data->getResults()))">Semua Masukan</button>
                <hr>
                @foreach ($data->segments as $segment)
                    <div class="mb-3">
                        <button class="btn btn-light border col-lg-12 text-truncate" data-index="{{ $segment->index }}" type="button" data-charts="@json(array_values($segment->getResults()))">{{ $segment->label }}</button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('yearlyPerformance');
        var resChart;
        Chart.defaults.color = '#fff';
        Chart.defaults.borderColor = '#5e5e5e';

        function chartJS(chartLabel, dataLabels, chartData){
            return new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: dataLabels,
                        datasets: [{
                        label: chartLabel,
                        data: chartData,
                        borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                        y: {
                            beginAtZero: true
                        }
                        }
                    }
                    });
        }

        resChart = chartJS(['Respondent'], ['Sangat Tidak Setuju', 'Tidak Setuju', 'Netral', 'Setuju', 'Sangat Setuju'], $('button[data-index="0"]').data('charts'));
        $('button[data-charts]').click(function(){
            resChart.destroy();
            resChart = chartJS(['Respondent'], ['Sangat Tidak Setuju', 'Tidak Setuju', 'Netral', 'Setuju', 'Sangat Setuju'], $(this).data('charts'));
        });
    </script>
@endsection