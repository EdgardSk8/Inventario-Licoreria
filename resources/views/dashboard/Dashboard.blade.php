<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Ventas</title>

    <link rel="stylesheet" href="{{ Vite::asset('resources/css/dashboard/Dashboard.css') }}">
    <script src="{{ Vite::asset('resources/js/dashboard/VentaGrafica.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/dashboard/GananciaGrafica.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/dashboard/Movimiento_InventarioGrafica.js') }}"></script>

</head>

<body>

    <div class="contenido">

        <div class="scrolling">

            @include('dashboard.VentasGrafica')
            @include('dashboard.GananciasGrafica')
            @include('dashboard.Movimiento_InventarioGrafica')
                        
        </div>

    </div>


</body>
</html>