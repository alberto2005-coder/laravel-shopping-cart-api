@extends('layout')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">{{ $articulo->nombre }}</h2>

    <div class="mb-4">
        <span class="text-gray-600 font-bold">Descripción:</span>
        <p class="text-gray-700 mt-1">{{ $articulo->descripcion }}</p>
    </div>

    <div class="mb-4 grid grid-cols-2 gap-4">
        <div>
            <span class="text-gray-600 font-bold">Precio:</span>
            <p class="text-green-600 font-bold text-xl">${{ number_format($articulo->precio, 2) }}</p>
        </div>
        <div>
            <span class="text-gray-600 font-bold">Stock:</span>
            <p class="text-blue-600 font-bold text-xl">{{ $articulo->stock }}</p>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('articulos.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-300">
            Volver
        </a>
    </div>
</div>
@endsection