{{-- resources/views/products/edit.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Product</h4>
                </div>

                <div class="card-body">
                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                value="{{ old('name', $product->name) }}" 
                                class="form-control" 
                                required
                            >
                        </div>

                        {{-- Image --}}
                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            @if($product->image)
                                <div class="mb-2 text-center">
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="Product Image" 
                                         class="img-fluid rounded shadow-sm" 
                                         style="max-height: 150px; object-fit: cover;">
                                </div>
                            @endif
                            <input type="file" name="image" id="image" class="form-control">
                        </div>

                        {{-- Price --}}
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input 
                                type="number" 
                                name="price" 
                                id="price" 
                                min="0"
                                value="{{ old('price', $product->price) }}" 
                                step="0.01" 
                                class="form-control" 
                                required
                            >
                        </div>

                        {{-- Quantity --}}
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input 
                                type="number" 
                                name="quantity" 
                                id="quantity" 
                                min="0"
                                value="{{ old('quantity', $product->quantity) }}" 
                                class="form-control" 
                                required
                            >
                        </div>

                        {{-- Soft Delete Toggle --}}
                        <div class="mb-3 form-check">
                            <input 
                                type="checkbox" 
                                name="is_deleted" 
                                id="is_deleted" 
                                value="1" 
                                class="form-check-input"
                                {{ old('is_deleted', $product->is_deleted) ? 'checked' : '' }}
                            >
                            <label for="is_deleted" class="form-check-label">Mark as Deleted</label>
                        </div>

                        {{-- Submit Buttons --}}
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Update Product
                            </button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left-circle"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
