<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('js/tinymce/skins/ui/oxide/skin.min.css') }}">
<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>


<title>Blog</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f8f9fa;
    }
    .container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
        margin-bottom: 20px;
        color: #333;
    }
    form {
        background-color: #f2f2f2;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    label {
        display: block;
        margin-bottom: 5px;
        color: #555;
    }
    input[type="text"],
    textarea {
        width: calc(100% - 22px);
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>

<div>
    <a href="{{ route('cargarDatos') }}" class="btn btn-primary">Regresar</a>
</div>

<div class="container">
    <h2>Agregar Publicacion</h2>
    <form id="formulario">
    @csrf
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" required>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" rows="4"></textarea>


    <label for="autor">Autor:</label>
    <input type="text" id="autor" name="autor" required>


    <label for="url">URL de YouTube:</label>
    <input type="text" id="url" name="url_recurso">

    <label for="imagen" class="form-label">Imagen</label>
    <input type="file" class="form-control" name="imagen" id="imagen"> 

    <input type="submit" value="Guardar">
</form>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#formulario').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this); 
            var fileInput = document.getElementById('imagen');
            var file = fileInput.files[0];
            formData.append('imagen', file);

            $.ajax({
                type: 'POST',
                url: '{{ route('guardar') }}',
                data: formData,
                contentType: false, 
            processData: false, 
                success: function(response) {
                    alert(response);
                },
                error: function(xhr, status, error) {
                    alert('Error al guardar el video: ' + error);
                }
            });
        });
    });
</script>

<script>
    tinymce.init({
        selector: '#descripcion',
        plugins: 'lists link',
        toolbar: 'undo redo | formatselect | bold italic underline | bullist numlist | link',
        menubar: false
    });
</script>
</body>

</html>

