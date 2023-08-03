@extends('layouts.page_content')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>GERER ETABLISSEMENT</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Etablissement</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{Session::get('success')}}

        </div>
        @endif
        <div class="row">
        <div class="col-md-3">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ajouter nouveau etablissement</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{route('etablissement.add')}}">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="cisco">Cisco</label>
                    <input type="text" class="form-control {{ $errors->has('cisco') ?  'is-invalid':'' }} " value="{{ old('cisco') }}"   name="cisco"  placeholder="Entrer cisco">
                    @if ($errors->has('cisco'))
                        <span class="help-block">
                            <i style="color: #ff00007a;">{{ $errors->first('cisco') }}</i>
                        </span>
                    @endif
                </div>

                  <div class="form-group">
                    <label for="nom_etab">Nom etablissement</label>
                    <input type="text" class="form-control {{ $errors->has('nom_etabl') ?  'is-invalid':'' }}" value="{{ old('nom_etabl') }}"    name="nom_etabl"  placeholder="Entrer nom etablissement">
                    @if ($errors->has('nom_etabl'))
                    <span class="help-block">
                        <i style="color: #ff00007a;">{{ $errors->first('nom_etabl') }}</i>
                    </span>
                 @endif
                </div>


                  <div class="form-group">
                    <label for="adrs_etab">Adresse etablissement</label>
                    <input type="text" class="form-control {{ $errors->has('adresse_etabl') ?  'is-invalid':'' }} " value="{{ old('adresse_etabl') }}"   name="adresse_etabl"  placeholder="Entrer adresse etablissement">
                    @if ($errors->has('adresse_etabl'))
                    <span class="help-block">
                        <i style="color: #ff00007a;">{{ $errors->first('adresse_etabl') }}</i>
                    </span>
                    @endif
                </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Enregister</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des etablissements</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Cisco</th>
                      <th>Nom etablissement</th>
                      <th>Adresse</th>
                      <th> Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach($liste_etab as $etabl)

                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$etabl->cisco}}</td>
                      <td> {{$etabl->nom_etabl}} </td>
                      <td>{{$etabl->adresse_etabl}}</td>
                      <td>
                          <a href="{{route('etablissement.edit', ['id' => $etabl->id])}}" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a> |  <a href="{{route('etablissement.delete', ['id' => $etabl->id])}}" onclick="return confirm('Voulez vous supprimer?')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">

                  @if ($liste_etab->onFirstPage())
                  <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                    @else
                    <li class="page-item"><a  class="page-link" href="{{ $liste_etab->previousPageUrl() }}">&laquo;</a></li>
                    @endif

                    @foreach ($liste_etab->getUrlRange(1, $liste_etab->lastPage()) as $page => $url)
                        @if ($page == $liste_etab->currentPage())
                            <li class="page-item active" ><span  class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a  class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    @if ($liste_etab->hasMorePages())
                        <li class="page-item"><a  class="page-link" href="{{ $liste_etab->nextPageUrl() }}" >&raquo;</a></li>
                    @else
                    <li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
                    @endif
                </ul>
              </div>
            </div>
            <!-- /.card -->


            <!-- /.card -->
          </div>
          <!-- /.col -->

        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
