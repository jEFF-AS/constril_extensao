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

            @can('access')
                <div class="col s12 m4">
                    <article class="bg-gradient-blue card z-depth-4 ">
                        <i class="material-icons">face</i>
                        <p>Usuários</p>
                        <h3>{{ $usuarios }} </h3>
                    </article>
                </div>
            @endcan

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
        @can('access')
            <section class="graficos col s12 m6">
                <div class="grafico card z-depth-4">
                    <h5 class="center"> Aquisição de usuários</h5>
                    <canvas id="grafico-usuarios" width="400" height="200"></canvas>
                </div>
            </section>
        @endcan

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
        @can('access')
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
        @endcan


        // Gráfico de produtos
        var ctx = document.getElementById('grafico-produtos');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($catNome) !!},
                datasets: [{
                    label: 'Produtos',
                    data: {!! json_encode($catTotal) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)', // Rosa Claro
                        'rgba(54, 162, 235, 0.8)', // Azul Claro
                        'rgba(255, 206, 86, 0.8)', // Amarelo
                        'rgba(75, 192, 192, 0.8)', // Verde Água
                        'rgba(153, 102, 255, 0.8)', // Roxo Claro
                        'rgba(255, 159, 64, 0.8)', // Laranja
                        'rgba(255, 99, 71, 0.8)', // Vermelho Tomate
                        'rgba(60, 179, 113, 0.8)', // Verde médio
                        'rgba(100, 149, 237, 0.8)', // Azul de Madeira
                        'rgba(255, 105, 180, 0.8)' // Rosa Chocotone
                    ]
                }]
            }
        });
    </script>
@endpush
