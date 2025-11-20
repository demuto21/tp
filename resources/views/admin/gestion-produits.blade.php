@extends('layout.admin')
@section('title', 'Gestion des Produits')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/produits.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/produits.js') }}" defer></script>
@endpush

@section('content')
<div class="page-header">
    <div>
        <h1>Gestion des Produits</h1>
        <p class="page-subtitle">Gérez votre catalogue AllSports</p>
    </div>
    <a href="{{ route('admin.produits.create') }}" class="btn">Ajouter un produit</a>
</div>

<!-- Liste des produits -->
<div class="content-section">
    <h2 style="margin-bottom: 1.5rem; color: #1e3a8a;">Liste des produits</h2>

    <div class="filters-section">
        <input type="text" id="searchInput" placeholder="Rechercher un produit..." autocomplete="off">
        <select id="categoryFilter">
            <option value="">Toutes catégories</option>
            <option value="Femmes">Femmes</option>
            <option value="Hommes">Hommes</option>
            <option value="Matériel">Matériel</option>
        </select>
    </div>

    <div class="product-count" id="productCount">
        {{ $produits->count() }} produit(s)
    </div>

    <table id="productsTable">
        <thead>
            <tr>
                <th>Image</th>
                <th>Nom</th>
                <th>Catégorie</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="productsTableBody">
            @foreach($produits as $produit)
            <tr data-category="{{ $produit->categorie ?? '' }}">
                <td>
                    @if($produit->image_url)
                        <img src="{{ $produit->image_url }}" alt="{{ $produit->nom }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                    @else
                        <span style="color: #999;">—</span>
                    @endif
                </td>
                <td>{{ $produit->nom }}</td>
                <td>{{ $produit->categorie ?? '—' }}</td>
                <td>{{ number_format($produit->prix) }} FCFA</td>
                <td class="{{ $produit->stock <= 0 ? 'text-danger' : ($produit->stock <= 10 ? 'text-warning' : '') }}">
                    {{ $produit->stock }}
                </td>
                <td>
                    <form action="{{ route('admin.produits.destroy', $produit->id_produit) }}"
                          method="POST" style="display:inline;" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Supprimer ce produit ?')">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div id="noResults" class="text-center text-muted" style="display: none; margin-top: 1rem;">
        Aucun produit trouvé.
    </div>
</div>
@endsection
