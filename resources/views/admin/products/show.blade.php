@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Product Details</h2>

    <div class="card">
        <div class="card-body">
            {{-- Image --}}
            @if($product->image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         width="200">
                </div>
            @endif

            {{-- Name --}}
            <h4>{{ $product->name }}</h4>

            {{-- Price --}}
            <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>

            {{-- Quantity --}}
            <p><strong>Quantity:</strong> {{ $product->quantity }}</p>

            {{-- Deleted status --}}
            <p>
                <strong>Status:</strong> 
                @if($product->is_deleted)
                    <span class="badge bg-danger">Deleted</span>
                @else
                    <span class="badge bg-success">Active</span>
                @endif
            </p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
