@extends('layouts.app')

@section('title', 'Add New Product')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add New Product</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" 
                           class="form-control @error('name') is-invalid @enderror" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select @error('type') is-invalid @enderror" 
                            id="type" 
                            name="type" 
                            required>
                        <option value="">Select Type</option>
                        <option value="bouquet" {{ old('type') == 'bouquet' ? 'selected' : '' }}>Bouquet</option>
                        <option value="hamper" {{ old('type') == 'hamper' ? 'selected' : '' }}>Hamper</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" 
                              name="description" 
                              rows="3" 
                              required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price (Rp)</label>
                    <input type="number" 
                           class="form-control @error('price') is-invalid @enderror" 
                           id="price" 
                           name="price" 
                           value="{{ old('price') }}" 
                           min="0" 
                           step="1000" 
                           required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" 
                           class="form-control @error('stock') is-invalid @enderror" 
                           id="stock" 
                           name="stock" 
                           value="{{ old('stock') }}" 
                           min="0" 
                           required>
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Product Image</label>
                    <input type="file" 
                           class="form-control @error('image') is-invalid @enderror" 
                           id="image" 
                           name="image"
                           accept="image/*"
                           onchange="previewImage(this);">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="mt-2">
                        <img id="image-preview" src="#" alt="Preview" style="max-width: 200px; display: none;">
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Create Product</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '#';
                preview.style.display = 'none';
            }
        }
    </script>
    @endpush
@endsection 