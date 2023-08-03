@extends('layouts.page_content')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DOSSIER</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Dossier</li>
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
                <h3 class="card-title">Modifier dossier</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{route('dossier.edit.submit',['id' => $doss->id ])}}">
                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="type_dossier">Type dossier</label>
                    <input type="text" class="form-control {{ $errors->has('type_dossier') ?  'is-invalid':'' }} " value="{{$doss->type_dossier }}"   name="type_dossier"  placeholder="Entrer type_dossier">
                    @if ($errors->has('type_dossier'))
                        <span class="help-block">
                            <i style="color: #ff00007a;">{{ $errors->first('type_dossier') }}</i>
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
                <h3 class="card-title">Liste des dossiers</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>type_dossier</th>
                      <th>Nombre</th>

                      <th> Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach($liste_doss as $doss)

                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$doss->type_dossier}}</td>
                      <td> {{$doss->nb_dossier}} </td>

                      <td>
                          <a href="{{route('dossier.edit', ['id' => $doss->id])}}" class="btn btn-info">Modifier</a> |  <a href="{{route('dossier.delete', ['id' => $doss->id])}}" onclick="return confirm('Voulez vous supprimer?')" class="btn btn-danger">Supprimer</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">

                  @if ($liste_doss->onFirstPage())
                  <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                    @else
                    <li class="page-item"><a  class="page-link" href="{{ $liste_doss->previousPageUrl() }}">&laquo;</a></li>
                    @endif

                    @foreach ($liste_doss->getUrlRange(1, $liste_doss->lastPage()) as $page => $url)
                        @if ($page == $liste_doss->currentPage())
                            <li class="page-item active" ><span  class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a  class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    @if ($liste_doss->hasMorePages())
                        <li class="page-item"><a  class="page-link" href="{{ $liste_doss->nextPageUrl() }}" >&raquo;</a></li>
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
