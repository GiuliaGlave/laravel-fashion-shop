@extends('layouts.app')

@section('title')

<h1 class="fs-2 text-center py-2 mb-3 fw-bold">Elenco Scarpe</h1>
@endsection

@section('cdn')
{{-- Bootstrap Icons --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
@endsection

@section('content')
  <table class="table table-info">
  <thead>
    <tr class="text-center">
      <th scope="col">ID</th>
      <th scope="col">Marca</th>
      <th scope="col">Modello</th>
      <th scope="col">Colore</th>
      <th scope="col">Taglia</th>
      <th scope="col">Prezzo</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    @forelse($shoes as $shoe)
    <tr class="table-primary text-center">
      <th scope="row">{{ $shoe->id}}</th>
      <td>{{ $shoe->marca}}</td>
      <td>{{ $shoe->modello}}</td>
      <td>{{ $shoe->colore}}</td>
      <td>{{ $shoe->taglia}}</td>
      <td>{{ $shoe->prezzo}}</td>
      <td class="text-center"> 
        <a href="{{route('shoes.show', $shoe)}}">
          <i class="bi bi-eye-fill"></i>
        </a>

        <a href="{{ route('shoes.edit', $shoe) }}">
          <i class="bi bi-pencil-fill text-primary ms-2"></i>
        </a>

        <button class="bi bi-trash3-fill text-danger btn-trash border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#delete-modal-{{ $shoe->id }}"></button>
      </td>
      </td>
    </tr>
    
    @empty
    @endforelse
  </tbody>
</table>

<div class="d-flex justify-content-center my-4">
  {{ $shoes->links() }}
</div>
@endsection

@section('modals')
@foreach ($shoes as $shoe)
<!-- Modal -->
<div class="modal fade" id="delete-modal-{{ $shoe->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-bg">
        <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">L' item n° {{ $shoe->id }} sta per essere eliminato</h1>
        <a type="button" class="text-light" data-bs-dismiss="modal" aria-label="Close">
          <i class="bi bi-x-circle"></i>
        </a>
      </div>
      <div class="modal-body modal-bg">
        Vuoi eliminare definitivamente l' item? <br>
        La risorsa non potrà essere recuperata
      </div>
      <div class="modal-footer modal-bg">

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="bi bi-file-arrow-down"></i>
          Annulla
        </button>
      
        <form action="{{ route('shoes.destroy', $shoe) }}" method="POST">
          @csrf
          @method('delete')
          
          <button class="btn btn-danger">
            <i class="bi bi-trash3-fill"></i>
            Delete
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection