@extends('layouts.page_content')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>GERER enseignant</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">enseignant</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if(Session::has('success'))
        <div class="alert alert-success" >
            <p><i class="fa fa-check-circle"></i> {{Session::get('success')}}</p>

        </div>
        @endif
        <div class="row">

          <!-- /.col -->
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste des enseignants</h3><br><hr>
                <a class="btn btn-info" href="{{route('enseignant.liste')}}">LISTE ENSEIGNANT</a>
                <a class="btn btn-info" href="{{route('enseignant.add')}}">AJOUTER ENSEIGNANT</a>
                <a href="#" data-toggle="modal" data-target="#modal-sm" class="btn btn-default"><i class="fas fa-print"></i> Impression</a>
                <form class="form-inline ml-3 float-right" method="POST" action="{{route('enseignant.search')}}">
                    @csrf

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">

                         <select name="critere" id="critere"  class="form-control form-control-navbar" >
                             <option value="im">IM</option>
                             <option value="cisco">Cisco</option>
                             <option value="grad">grad</option>
                             <option value="cord">cord</option>
                             <option value="indice">indice</option>
                             <option value="acte">acte</option>
                         </select>
                         </div>
                        <input class="form-control form-control-navbar"  type="text" name="cle" id="cle"  value="{{old('cle')}}" aria-label="Search">
                        <div class="input-group-append">
                        <button class="btn btn-info" type="submit">
                            Entrer
                        </button>
                        </div>

                    </div>
                </form>
            </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="col-12 table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>IM</th>
                      <th>Nom et Prenom</th>

                      <th>Date et lieu de naissance</th>

                      <th>Corp et Grad</th>

                      <th>Indice</th>
                      <th>Acte</th>
                      <th>Cisco</th>
                      <th> Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach($liste_ens as $ens)

                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$ens->im}}</td>
                      <td>{{$ens->nom}} {{$ens->prenom}} </td>

                      <td> {{\Carbon\Carbon::parse($ens->date_naiss)->formatLocalized('%d %B %Y')}} à {{$ens->lieu_naiss}} </td>

                      <td> {{$ens->corps}} / {{$ens->grad}}</td>

                      <td> {{$ens->indice}} </td>
                      <td> {{$ens->acte}} </td>
                      <td> {{$ens->cisco}} </td>

                      <td>

                        <a href="{{route('enseignant.edit', ['id' => $ens->id])}}" class="btn btn-info btn-sm" title="Modifier"><i class="fas fa-pencil-alt"></i></a>&nbsp
                        <a href="{{route('enseignant.delete', ['id' => $ens->id])}}" onclick="return confirm('Voulez vous supprimer?')" title="Supprimer" class="btn btn-danger  btn-sm"><i class="fas fa-trash"></i></a>&nbsp
                        <a href="{{route('traitement.deposer', ['id' => $ens->id])}}" class="btn btn-success  btn-sm" title="Deposer dossier"><i class="fas fa-folder"></i></a>

                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">

                  @if ($liste_ens->onFirstPage())
                  <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                    @else
                    <li class="page-item"><a  class="page-link" href="{{ $liste_ens->previousPageUrl() }}">&laquo;</a></li>
                    @endif

                    @foreach ($liste_ens->getUrlRange(1, $liste_ens->lastPage()) as $page => $url)
                        @if ($page == $liste_ens->currentPage())
                            <li class="page-item active" ><span  class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a  class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    @if ($liste_ens->hasMorePages())
                        <li class="page-item"><a  class="page-link" href="{{ $liste_ens->nextPageUrl() }}" >&raquo;</a></li>
                    @else
                    <li class="page-item disabled"><a class="page-link" href="#">&raquo;</a></li>
                    @endif
                </ul>
              </div>
            </div>
            <!-- /.card -->


            <!-- /.card -->
          </div>
          <div class="modal fade" id="modal-sm">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Impression</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Imprimer: </h5>
                        <a href="{{route('enseignant.print')}}" class="btn btn-default" target="_blank">TOUT LES ENSEIGNANTS</a>

                        <form class="form-inline ml-3" method="POST" action="{{route('enseignant.print_c')}}" target="_blank">
                            @csrf
                            <label for="cisco">Imprimer par:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">

                                <select name="critere1" id="critere1"  class="form-control form-control-navbar" >
                                    <option value="im">IM</option>
                                    <option value="cisco">Cisco</option>
                                    <option value="grad">grad</option>
                                    <option value="cord">cord</option>
                                    <option value="indice">indice</option>
                                    <option value="acte">acte</option>
                                </select>
                                </div>
                                <input class="form-control form-control-navbar"  type="text" name="cle1" id="cle1"  value="{{old('cle1')}}" aria-label="Search">
                                <div class="input-group-append">
                                <button class="btn btn-info" type="submit">
                                    Entrer
                                </button>
                                </div>

                            </div>
                        </form><hr>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.col -->

        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
