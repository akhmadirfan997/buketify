@extends('layouts.app')

@section('title', 'Dashboard Pembeli')

@section('content')
    <div class="text-center mt-5 mb-4">
        <h1 class="display-4">Selamat Datang, {{ Auth::user()->name }}!</h1>
        <p class="lead">Silakan pilih produk yang ingin Anda beli.</p>
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
                        @if($product->stock > 0)
                            <div class="d-grid mt-3">
                                <button class="btn btn-success btn-lg btn-beli" 
                                        data-nama="{{ $product->name }}"
                                        style="background: #28a745; border: none;">
                                    <i class="fas fa-shopping-cart me-1"></i> Beli
                                </button>
                            </div>
                        @else
                            <div class="d-grid mt-3">
                                <button class="btn btn-secondary btn-lg" style="background: #ccc; border: none;" disabled>
                                    <i class="fas fa-ban me-1"></i> Sold Out
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Belum ada produk tersedia.</div>
            </div>
        @endforelse
    </div>
    <div class="mt-4 d-flex justify-content-center">
        {{ $products->links() }}
    </div>

    <!-- Modal Konfirmasi Beli -->
    <div class="modal fade" id="modalKonfirmasiBeli" tabindex="-1" aria-labelledby="modalKonfirmasiBeliLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKonfirmasiBeliLabel">Konfirmasi Pembelian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin ingin membeli <span id="namaProdukModal" class="fw-bold"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <button type="button" class="btn btn-success" id="btnKonfirmasiBeli">Iya</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Animasi Sukses -->
    <div id="beliSuksesAlert" class="alert alert-success text-center position-fixed top-0 start-50 translate-middle-x mt-4" style="display:none; z-index: 9999; min-width: 300px;">
        <i class="fas fa-check-circle me-2"></i> Produk berhasil dibeli!
    </div>
@endsection

@push('scripts')
<script>
    let produkNama = '';
    document.querySelectorAll('.btn-beli').forEach(btn => {
        btn.addEventListener('click', function() {
            produkNama = this.getAttribute('data-nama');
            document.getElementById('namaProdukModal').textContent = produkNama;
            const modal = new bootstrap.Modal(document.getElementById('modalKonfirmasiBeli'));
            modal.show();
        });
    });
    document.getElementById('btnKonfirmasiBeli').addEventListener('click', function() {
        const modal = bootstrap.Modal.getInstance(document.getElementById('modalKonfirmasiBeli'));
        modal.hide();
        const alert = document.getElementById('beliSuksesAlert');
        alert.style.display = 'block';
        setTimeout(() => {
            alert.style.display = 'none';
        }, 2000);
    });
</script>
@endpush 