@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-xl">
  <h1 class="text-2xl mb-4">Create Product</h1>

  @if($errors->any())
    <div class="mb-4 p-2 bg-red-100 text-red-800 rounded">
      <ul>
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label class="block mb-2">Name
      <input name="name" value="{{ old('name') }}" class="w-full border p-2 rounded" />
    </label>

    <label class="block mb-2">Price
      <input name="price" value="{{ old('price') }}" class="w-full border p-2 rounded" />
    </label>

    <label class="block mb-2">Quantity
      <input name="quantity" value="{{ old('quantity', 0) }}" class="w-full border p-2 rounded" />
    </label>

    <label class="block mb-4">Image
      <input type="file" name="image" />
    </label>

    <button class="px-4 py-2 bg-blue-600 text-white rounded">Create</button>
    <a href="{{ route('admin.products.index') }}" class="ml-2 text-gray-600">Cancel</a>
  </form>
</div>
@endsection
