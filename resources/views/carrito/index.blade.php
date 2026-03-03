@extends('layout')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Mi Carrito de Compras</h1>

@if(count($articulos) > 0)
<div class="bg-white shadow-md rounded my-6 overflow-x-auto">
    <table class="min-w-full w-full table-auto">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Producto</th>
                <th class="py-3 px-6 text-center">Precio</th>
                <th class="py-3 px-6 text-center">Cantidad</th>
                <th class="py-3 px-6 text-center">Subtotal</th>
                <th class="py-3 px-6 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
            @foreach($articulos as $articulo)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left whitespace-nowrap">
                    <span class="font-medium">{{ $articulo->nombre }}</span>
                </td>
                <td class="py-3 px-6 text-center">
                    ${{ number_format($articulo->precio, 2) }}
                </td>
                <td class="py-3 px-6 text-center">
                    {{ $articulo->pivot->cantidad }}
                </td>
                <td class="py-3 px-6 text-center">
                    ${{ number_format($articulo->precio * $articulo->pivot->cantidad, 2) }}
                </td>
                <td class="py-3 px-6 text-center">
                    <form action="{{ route('carrito.remove', $articulo->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 font-bold">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="flex justify-end items-center mt-6">
    <div class="text-2xl font-bold text-gray-800 mr-6">
        Total: ${{ number_format($total, 2) }}
    </div>
    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition duration-300">
        Proceder al Pago
    </button>
</div>
@else
<div class="bg-blue-100 border-t-4 border-blue-500 rounded-b text-blue-900 px-4 py-3 shadow-md" role="alert">
    <div class="flex">
        <div class="py-1"><svg class="fill-current h-6 w-6 text-blue-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
            </svg></div>
        <div>
            <p class="font-bold">Tu carrito está vacío</p>
            <p class="text-sm">¡Ve a la tienda y añade algunos productos!</p>
        </div>
    </div>
</div>
<div class="mt-6">
    <a href="{{ route('tienda.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
        Ir a la Tienda
    </a>
</div>
@endif
@endsection