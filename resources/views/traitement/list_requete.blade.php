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
              <li class="breadcrumb-item active">dossier</li>
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
                <h3 class="card-title">Liste des dossiers des enseignants</h3><br><hr>
                <a class="btn btn-outline-secondary btn-sm" href="{{route('traitement.liste')}}">LISTE</a>
                <a class="btn btn-outline-secondary  btn-sm" href="{{route('traitement.rejeter')}}">LISTE REJETER</a>
                <a class="btn btn-outline-secondary  btn-sm" href="{{route('traitement.accepter')}}">LISTE ACCEPTER</a>
                <a class="btn btn-outline-secondary  btn-sm" href="{{route('traitement.attente')}}">LISTE EN ATTENTE</a>
                <a class="btn btn-outline-secondary  btn-sm" href="#"  data-toggle="modal" data-target="#modal-sm" >REJETER PAR:</a>

                <form class="form-inline ml-3 float-right" method="POST" action="{{route('traitement.search')}}" style="width: 22%;">
                    @csrf

                    <div class="input-group mb-3" >
                        <div class="input-group-prepend">

                         <select name="critere" id="critere"  class="form-control form-control-navbar form-control-sm" >
                             <option value="im">IM</option>
                             <option value="nom">Nom</option>
                             <option value="prenom">Prenom</option>
                             <option value="grad">Grad</option>
                             <option value="cord">Cord</option>
                             <option value="indice">Indice</option>
                             <option value="acte">Acte</option>
                         </select>
                         </div>
                        <input required class="form-control form-control-navbar form-control-sm"  type="text" name="cle" id="cle"  value="{{session('last_input_value')}}" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-info btn-sm" type="submit">
                                Entrer
                            </button>
                        </div>

                    </div>
                </form>
                <form class="form-inline ml-3 float-right" method="POST" action="{{route('traitement.search_date')}}">
                    @csrf

                    <div class="input-group mb-3" >
                        <div class="input-group-prepend">

                         <select name="critere1" id="critere1"  class="form-control form-control-navbar form-control-sm" >
                             <option value="date_depot">Date depot</option>
                             <option value="date_transfert">Date transfert</option>
                             <option value="date_retour">Date retour</option>

                         </select>
                         </div>
                        <input required class="form-control form-control-navbar form-control-sm"  type="date" name="cle1" id="cle"  value="{{old('cle1')}}" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-info btn-sm" type="submit">
                                Entrer
                            </button>
                        </div>

                    </div>
                </form>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                  <div id="table">
                    <h3 class="text-info"><i class="fas fa-folder"></i> LISTE DES DOSSIERS {{ $titre }} ({{count($liste_ens)}})</h3>
                    <div class="col-12 table-responsive">
                        <table class="table table-bordered">
                        <thead>
                            <tr>

                            <th>DATE RETOUR</th>
                            <th>IM</th>
                            <th>NOM PRENOM</th>
                            <th>CORPS/GRAD</th>
                            <th>TYPE DOSSIER</th>
                            <th>STATUS</th>
                            <th>TRAITE PAR</th>
                            <th>MOTIF</th>

                            <th> Action &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp.</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($liste_ens as $ens)

                            <tr>
                            <td>
                                    @if ($ens->date_retour == null)
                                    <span class="badge badge-info">en attente</span>
                                    @else
                                        {{ \Carbon\Carbon::parse($ens->date_retour)->format('d-m-Y')}}
                                    @endif
                            </td>

                            <td>{{$ens->im}}</td>
                            <td>{{$ens->nom_enseignant}}  {{$ens->prenom}}</td>
                            <td> {{$ens->corps}} / {{$ens->grad}} </td>
                            <td> {{$ens->type_dossier}}  </td>

                            <td>
                                    @if ($ens->status == null)
                                    <span class="badge badge-warning">en attente</span>
                                    @elseif($ens->status == 'REJETER')
                                    <span class="badge badge-danger"> {{$ens->status}}</span>
                                    @else
                                    <span class="badge badge-success"> {{$ens->status}}</span>
                                    @endif
                            </td>
                            <td> {{$ens->nom}}  </td>
                            <td> {{$ens->motif}}  </td>

                            <td>
                            <div>
                                @if ($ens->date_envoye == null)
                                <a href="{{route('traitement.transfer', ['id' => $ens->id])}}" class="btn btn-default btn-sm" title="Transferer ce dosssier"><i class="fas fa-arrow-right"></i></a>&nbsp

                                @endif
                                <a href="{{route('traitement.edit', ['id' => $ens->id])}}" class="btn btn-info btn-sm" title="Modifier ce dosssier"><i class="fas fa-pencil-alt"></i></a>&nbsp
                                <a href="{{route('enseignant.delete', ['id' => $ens->id])}}" onclick="return confirm('Voulez vous supprimer?')" title="Supprimer ce dosssier" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>&nbsp
                                <a href="{{route('traitement.print', ['id' => $ens->id])}}" target="_blank" class="btn btn-default btn-sm" title="imprimer"><i class="fas fa-print"></i></a>&nbsp
                            </div>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                <button class="btn btn-default float-left" target="_blank" id="print"><i class="fas fa-print">Imprimer</i></button>
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
              <div class="modal fade" id="modal-sm">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">REJETER PAR</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="btn-group show">
                                    <a class="btn btn-info" href="{{route('traitement.rejeter_par_finance')}}">Finance</a>|
                                    <a class="btn btn-info"href="{{route('traitement.rejeter_par_visa')}}">Visa prefet</a>

                                </div>

                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>

                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div>
            <!-- /.card -->


            <!-- /.card -->
          </div>
          <!-- /.col -->

        </div>

      </div><!-- /.container-fluid -->
    </section>
    <script>
        document.getElementById('print').addEventListener('click', function(event){
            event.preventDefault();
            imprimerTable();
        });

        function imprimerTable(){
            //recuperer contenu de la table
            var contenuTable = document.getElementById('table').outerHTML;
            //ouvrir une nouvelle fenetre
            var nouvelleFenetre = window.open('', '_blank');
            nouvelleFenetre.document.write('<html><head></head><title>Impression de la table</title><body>'+contenuTable+'</body></html>');
            nouvelleFenetre.print();

        }


    </script>
    <!-- /.content -->
@endsection
