@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold mb-0">Products Management</h1>
            <p class="text-muted">Manage your bouquets and hampers inventory</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Product
        </a>
    </div>

    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100">
                    <div class="position-relative">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $product->name }}"
                                 style="width: 100%; aspect-ratio: 4/5; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                 style="height: 200px;">
                                <i class="fas fa-image text-muted fa-3x"></i>
                            </div>
                        @endif
                        <div class="position-absolute top-0 end-0 p-3">
                            <span class="badge bg-{{ $product->stock > 0 ? 'success' : 'danger' }} rounded-pill">
                                {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-1">{{ $product->name }}</h5>
                        <p class="text-muted small mb-2">
                            <i class="fas fa-tag me-1"></i>
                            {{ ucfirst($product->type) }}
                        </p>
                        <h6 class="fw-bold text-primary mb-3">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </h6>
                        <p class="card-text text-muted small">
                            {{ $product->description }}
                        </p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small">
                                <i class="fas fa-box me-1"></i>
                                Stock: {{ $product->stock }}
                            </span>
                            <div class="btn-group">
                                <a href="{{ route('products.edit', $product) }}" 
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-outline-danger btn-sm" 
                                            onclick="return confirm('Are you sure you want to delete this product?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-box-open text-muted fa-3x mb-3"></i>
                        <h3 class="text-muted">No products found</h3>
                        <p class="text-muted mb-0">Start by adding your first product!</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
    
    <div class="mt-4 d-flex justify-content-center">
        {{ $products->links() }}
    </div>
@endsection 