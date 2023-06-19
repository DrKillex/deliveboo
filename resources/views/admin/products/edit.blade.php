@extends('layouts.app')

@section('content')

 {{-- validazione errori --}}
 @if ($errors->any())
 <div class="alert alert-danger">
     <ul>
         @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
         @endforeach
     </ul>
 </div>
 @endif
 {{-- validazione errori --}}


<div class="container">
    <h1>Inserisci i dati</h1>

    <form action="{{ route('admin.products.update', $product)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nome prodotto</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $product->name)}}" >
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione prodotto</label>
            <textarea class="form-control" name="description" id="description" rows="3">{{ old('description', $product->description)}}</textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Prezzo</label>
            <input type="number" name="price" class="form-control" id="price" value="{{ old('price', $product->price)}}" >
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <input class="form-control" name="image" type="file" id="image" value="{{ old('image', $product->image)}}">
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="gluten_free" id="gluten-free" value="1" {{ old('gluten_free', $product->gluten_free) ? 'checked' : '' }}>
            <label class="form-check-label" for="gluten_free">
                Gluten Free
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="vegan" id="vegan"  value="1" {{ old('vegan', $product->vegan) ? 'checked' : '' }}>
            <label class="form-check-label" for="vegan">
                Vegan
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="visible" id="visible"  value="1" {{ old('visible', $product->visible) ? 'checked' : '' }}>
            <label class="form-check-label" for="visible">
                visible
            </label>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Invia</button>

        {{-- show image upload --}}
        <div id="image_input_container">
            <div class="preview">
                <img id="file-image-preview" @if ($product->image) src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" @endif>
            </div>
        </div>

    </form>
</div>
@endsection