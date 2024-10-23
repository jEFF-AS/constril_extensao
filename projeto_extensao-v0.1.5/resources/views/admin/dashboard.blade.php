@extends('admin.layout')
@section('titulo', 'Dashboard')
@section('conteudo')

    <div class="row container">
        <section class="info">

            <div class="col s12 m4">
                <article class="bg-gradient-green card z-depth-4 ">
                    <i class="material-icons">paid</i>
                    <p>Faturamento</p>
                    <h3>R$ {{ number_format(\Cart::getTotal(), 2, ',', '.') }}</h3>
                </article>
            </div>

            <div class="col s12 m4">
                <article class="bg-gradient-blue card z-depth-4 ">
                    <i class="material-icons">face</i>
                    <p>Usuários</p>
                    <h3>{{ $usuarios }} </h3>
                </article>
            </div>

            <div class="col s12 m4">
                <article class="bg-gradient-orange card z-depth-4 ">
                    <i class="material-icons">shopping_cart</i>
                    <p>Pedidos este mês</p>
                    <h3>0</h3>
                </article>
            </div>

        </section>
    </div>

    <div class="row container ">
        <section class="graficos col s12 m6">
            <div class="grafico card z-depth-4">
                <h5 class="center"> Aquisição de usuários</h5>
                <canvas id="grafico-usuarios" width="400" height="200"></canvas>
            </div>
        </section>

        <section class="graficos col s12 m6">
            <div class="grafico card z-depth-4">
                <h5 class="center"> Produtos </h5>
                <canvas id="grafico-produtos" width="400" height="200"></canvas>
            </div>
        </section>
    </div>

@endsection

@push('graficos')
    <script>
        // Gráfico de usuários
        var ctx = document.getElementById('grafico-usuarios');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($userAno) !!},
                datasets: [{
                    label: 'Usuários',
                    data: {!! json_encode($userAno) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // Gráfico de produtos
        var ctx = document.getElementById('grafico-produtos');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($catLabel) !!},
                datasets: [{
                    label: 'Produtos',
                    data: {!! json_encode($catTotal) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132)',
                        'rgba(54, 162, 235)',
                        'rgba(255, 159, 64)'
                    ]
                }]
            }
        });
    </script>
@endpush