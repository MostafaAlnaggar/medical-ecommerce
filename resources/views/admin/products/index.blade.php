@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
  <div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Products</h1>
    <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">New Product</a>
  </div>

  @if(session('success'))
    <div class="mb-4 p-2 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
  @endif

  <form method="GET" class="mb-4">
    <input name="search" value="{{ request('search') }}" placeholder="Search" class="border p-2 rounded">
    <button class="px-3 py-2 bg-gray-200 rounded">Search</button>
  </form>

  <div class="overflow-x-auto">
    <table class="min-w-full bg-white">
      <thead>
        <tr>
          <th class="px-4 py-2">#</th>
          <th class="px-4 py-2">Image</th>
          <th class="px-4 py-2">Name</th>
          <th class="px-4 py-2">Price</th>
          <th class="px-4 py-2">Quantity</th>
          <th class="px-4 py-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
        <tr class="border-t">
          <td class="px-4 py-2">{{ $product->id }}</td>
          <td class="px-4 py-2">
            @if($product->image)
              <img src="{{ asset('storage/' . $product->image) }}" class="h-12 w-12 object-cover" alt="">
            @else
              <div class="h-12 w-12 bg-gray-100 flex items-center justify-center">—</div>
            @endif
          </td>
          <td class="px-4 py-2">{{ $product->name }}</td>
          <td class="px-4 py-2">{{ number_format($product->price, 2) }}</td>
          <td class="px-4 py-2">{{ $product->quantity }}</td>
          <td class="px-4 py-2 space-x-2">
            
            <a href="{{ route('admin.products.show', $product) }}" class="px-2 py-1 bg-blue-300 rounded">View</a>

            <a href="{{ route('admin.products.edit', $product) }}" class="px-2 py-1 bg-yellow-300 rounded">Edit</a>
            
            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete?')">
              @csrf @method('DELETE')
              <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
              
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="mt-4">
    {{ $products->links() }}
  </div>
</div>
@endsection
