<script>
    // gender char female, male
    new Chart(
        document.getElementById('genderChart'),
        {
            type: 'pie',
            data: {
                labels: [
                    'Male',
                    'Female'
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [{{$males}}, {{$females}}],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)'
                    ],
                    hoverOffset: 4
                }]
            },
        }
    );

    //age segmentation chart
    new Chart(
        document.getElementById('ageChart'),
        {
            type: 'bar',
            data: {
                labels: [
                    '0-20',
                    '20-40',
                    '40-80'
                ],
                datasets: [{
                    label: 'Age Segmentations',
                    data: [{{$ages['firstSegment']}},{{$ages['secondSegment']}}, {{$ages['thirdSegment']}}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(75, 192, 192)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        }
    );

    var data = [];
    @foreach($users_month as $key => $value)
        data.push('{{$value}}');
    @endforeach
    // users count per month
    new Chart(
        document.getElementById('monthChart'),
        {
            type: 'bar',
            data: {
                labels:  ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'User Creation',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        }
    );
</script>
