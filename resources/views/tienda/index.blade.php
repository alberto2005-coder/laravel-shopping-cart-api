@extends('layout')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Catálogo de Productos</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($articulos as $articulo)
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $articulo->nombre }}</h2>
            <p class="text-gray-600 mb-4 h-12 overflow-hidden">{{ Str::limit($articulo->descripcion, 80) }}</p>
            <div class="flex justify-between items-center">
                <span class="text-green-600 font-bold text-xl">${{ number_format($articulo->precio, 2) }}</span>
                <span class="text-sm text-gray-500">Stock: {{ $articulo->stock }}</span>
            </div>
            <div class="mt-4">
                <form action="{{ route('carrito.add', $articulo->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                        Añadir al Carrito
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection