@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Productos</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre']) && isset($_POST['precio'])) {
                        $nombre = $_POST['nombre'];
                        $precio = $_POST['precio'];

                        $conn = new mysqli("localhost", "usuario", "contrasena", "laravel");

                        if ($conn->connect_error) {
                            die("Conexión fallida: " . $conn->connect_error);
                        }

                        $sql = "INSERT INTO productos (nombre, precio) VALUES ('$nombre', $precio)";
                        
                        if ($conn->query($sql) === TRUE) {
                            echo "Producto agregado con éxito";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }

                        $conn->close();
                    }
                    ?>
                    <form method="POST" action="">
                        Nombre: <input type="text" name="nombre">
                        Precio: <input type="text" name="precio">
                        <input type="submit" value="Agregar Producto">
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
