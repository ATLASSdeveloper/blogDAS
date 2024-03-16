

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Vídeo Demo</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
    }
    .container {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }
    h1 {
        color: #333;
        margin-bottom: 10px;
    }
    p {
        color: #666;
        margin-bottom: 20px;
    }
    .video-container {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
        margin-bottom: 20px;
    }
    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>
</head>
<body>
<div>
    <a href="{{ route('obtenerFormulario') }}" class="btn btn-primary">Agregar</a>
</div>
<div class="container">
    @foreach($videos as $video)
    <div class="video-entry">
        <h1>{{ $video['titulo'] }}</h1>
        <div>
            {!! $video['descripcion'] !!}
        </div>
        <p>Autor: {{ $video['autor'] }}</p>
        @if(!empty($video['url_recurso']))
            <div class="video-container">
                <iframe width="560" height="315" src="{{ $video['url_recurso'] }}" frameborder="0" allowfullscreen></iframe>
            </div>
        @endif

        @if(!empty($video['imagenBlob']))
            <div>
                <img src="data:image/jpeg;base64,{{ $video['imagenBlob'] }}" alt="" class="card-img-top">
            </div>
        @endif
    </div>
    @endforeach
</div>

</body>
</html>