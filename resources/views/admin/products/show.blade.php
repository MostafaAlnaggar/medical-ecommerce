@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Product Details</h4>
                    <span class="badge {{ $product->is_deleted ? 'bg-danger' : 'bg-success' }}">
                        {{ $product->is_deleted ? 'Deleted' : 'Active' }}
                    </span>
                </div>

                <div class="card-body text-center">
                    {{-- Product Image --}}
                    <center>
                    @if($product->image)
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="img-fluid rounded shadow-sm" 
                                 style="max-height: 250px; object-fit: cover;">
                        </div>
                    @else
                        <div class="mb-4">
                            <img src="https://via.placeholder.com/250x200?text=No+Image" 
                                 alt="No Image" 
                                 class="img-fluid rounded shadow-sm">
                        </div>
                    @endif
                    </center>

                    {{-- Product Name --}}
                    <h3 class="fw-bold text-dark">{{ $product->name }}</h3>

                    {{-- Price & Quantity --}}
                    <p class="fs-5 mt-3">
                        <span class="badge bg-info text-dark px-3 py-2">
                            Price: ${{ number_format($product->price, 2) }}
                        </span>
                    </p>
                    <p class="fs-6 text-muted">
                        <i class="bi bi-box-seam"></i> Quantity: {{ $product->quantity }}
                    </p>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle"></i> Back
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
