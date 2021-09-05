<div>
    <canvas id="queue-level"></canvas>

    @push('javascript')
        <script>
            const rand = function(min, max) {
                if (min==null && max==null)
                    return 0;

                if (max == null) {
                    max = min;
                    min = 0;
                }
                return min + Math.floor(Math.random() * (max - min + 1));
            };

            document.addEventListener('DOMContentLoaded', function () {
                const MONTHS = ['08/10/2021 18:21h'];
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

                let datasets = [];

                for (let i = 1; i <= 10; i++) {
                    let data = [];

                    for (let j = 0; j < MONTHS.length; j++) {
                        data.push(rand(0, 3));
                    }

                    datasets.push({
                        label: 'Sensor ' + i,
                        backgroundColor: COLORS[i-1],
                        data: data,
                        borderWidth: 1,
                    });
                }

                let barChartData = {
                    labels: MONTHS,
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
        </script>
    @endpush
</div>
