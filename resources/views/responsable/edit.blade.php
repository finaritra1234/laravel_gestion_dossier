@extends('layouts.page_content')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>GERER RESPONSABLE</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Responsable</li>
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
                <h3 class="card-title">Modifier responsable</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{route('responsable.edit.submit',['id' => $resp->id ])}}">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="cisco">Nom</label>
                    <input type="text" class="form-control {{ $errors->has('nom') ?  'is-invalid':'' }} " value="{{$resp->nom }}"   name="nom"  placeholder="Entrer nom">
                    @if ($errors->has('nom'))
                        <span class="help-block">
                            <i style="color: #ff00007a;">{{ $errors->first('nom') }}</i>
                        </span>
                    @endif
                </div>

                  <div class="form-group">
                    <label for="nom_etab">Description</label>
                    <input type="text" class="form-control {{ $errors->has('desc') ?  'is-invalid':'' }}" value="{{$resp->desc }}"    name="desc"  placeholder="Entrer nom description">
                    @if ($errors->has('desc'))
                    <span class="help-block">
                        <i style="color: #ff00007a;">{{ $errors->first('desc') }}</i>
                    </span>
                 @endif
                </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des responsables</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nom responsable</th>
                      <th>description</th>
                      <th> Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach($liste_resp as $resp)

                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$resp->nom}}</td>
                      <td> {{$resp->desc}} </td>

                      <td>
                          <a href="{{route('responsable.edit', ['id' => $resp->id])}}" class="btn btn-info">Modifier</a> |  <a href="{{route('responsable.delete', ['id' => $resp->id])}}" onclick="return confirm('Voulez vous supprimer?')" class="btn btn-danger">Supprimer</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">

                  @if ($liste_resp->onFirstPage())
                  <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                    @else
                    <li class="page-item"><a  class="page-link" href="{{ $liste_resp->previousPageUrl() }}">&laquo;</a></li>
                    @endif

                    @foreach ($liste_resp->getUrlRange(1, $liste_resp->lastPage()) as $page => $url)
                        @if ($page == $liste_resp->currentPage())
                            <li class="page-item active" ><span  class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a  class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    @if ($liste_resp->hasMorePages())
                        <li class="page-item"><a  class="page-link" href="{{ $liste_resp->nextPageUrl() }}" >&raquo;</a></li>
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
