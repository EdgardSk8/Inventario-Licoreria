<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Ventas</title>


    <link rel="stylesheet" href="{{ Vite::asset('resources/css/dashboard/Dashboard.css') }}">
    <script src="{{ Vite::asset('resources/js/dashboard/Dashboard.js') }}"></script>

</head>

<body>

    <div class="contenido">

        <div class="scrolling">

            @include('dashboard.VentasGrafica')
                        
        </div>

    </div>


</body>
</html>