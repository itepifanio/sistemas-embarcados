<div>
    <canvas id="queue-level"></canvas>

    @push('javascript')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let datasets = [];
                const COLORS = [
                    "#a491d3",
                    "#818aa3",
                    "#c5dca0",
                    "#f5f2b8",
                    "#F9DAD0",
                    "#30292f",
                    "#c73e1d",
                    "#3b1f2b",
                    "#0a014f",
                    "#d36135",
                    "#69385c",
                ];

                window.axios.get('{{ route('api.queue-status') }}').then(res => {
                    let keys = Object.keys(res.data);

                    for (let i = 0; i < keys.length; i++) {
                        for(let j = 0; j < res.data[keys[i]].length; j++) {
                            datasets.push({
                                label: res.data[keys[i]][j].restaurant.name,
                                backgroundColor: COLORS[i - 1],
                                data: [res.data[keys[i]][j].queue_status],
                                borderWidth: 1,
                            });
                        }
                    }

                    let barChartData = {
                        labels: ['Status'],
                        datasets: datasets
                    };

                    const ctx = document.getElementById("queue-level").getContext("2d");

                    new window.Chart(ctx, {
                        type: 'bar',
                        data: barChartData,
                        options: {
                            responsive: true,
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Chart.js Bar Chart'
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
</div>
