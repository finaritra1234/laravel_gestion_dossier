@extends('layouts.page_content')
@section('content')
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">TABLEAU DE BORD</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">tableau de bord</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-folder"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">DOSSIER REJETER</span>
                <span class="info-box-number">
                  {{$count_rejeter}}

                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-folder"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">DOSSIER ACCEPTER</span>
                <span class="info-box-number">  {{$count_accepter}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-folder"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">DOSSIER EN ATTENTE</span>
                <span class="info-box-number">  {{$count_attente}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">ADMIN</span>
                <span class="info-box-number">{{$count_admin}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
            <!-- MAP & BOX PANE -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">LISTE DES 5 DERNIERS DOSSIERS</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>IM</th>
                      <th>NOM ET PRENOM</th>
                      <th>STATUS</th>
                      <th>RESPONSABLE</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($dossiers as $doss )


                        <tr>
                            <td>{{$doss->im}}</td>
                            <td>{{$doss->nom_enseignant}} {{$doss->prenom}}</td>
                            <td>
                                @if ($doss->status == null)
                                <span class="badge badge-warning">en attente</span>
                                @elseif($doss->status == 'REJETER')
                                <span class="badge badge-danger"> {{$doss->status}}</span>
                                @else
                                <span class="badge badge-success"> {{$doss->status}}</span>
                                @endif
                            </td>
                            <td>
                                {{$doss->nom}}
                            </td>
                        </tr>
                        @endforeach



                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="{{route('enseignant.liste')}}" class="btn btn-sm btn-info float-left">Enregitre nouveau dossier</a>
                <a href="{{route('traitement.liste')}}" class="btn btn-sm btn-secondary float-right">Voir liste dossier</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->



          </div>
          <!-- /.col -->

          <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 bg-warning">
              <span class="info-box-icon"><i class="fas fa-folder"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">DOSSIER EN ATTENTE</span>
                <span class="info-box-number">{{$count_attente}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-success">
              <span class="info-box-icon"><i class="far fa-folder"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">DOSSIER ACCEPTER</span>
                <span class="info-box-number">{{$count_accepter}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 bg-danger">
              <span class="info-box-icon"><i class="fas fa-folder"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">DOSSIER REJETER</span>
                <span class="info-box-number">{{$count_rejeter}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->



            <!-- /.card -->


            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <div class="row">
              <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Liste administrateur</h3>

                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">
                      @foreach ($admins as $admin)
                        <li>
                            <img src="{{asset('dist/img/user.png')}}" alt="User Image">
                            <a class="users-list-name" href="#">{{$admin->name}}</a>
                            <span class="users-list-date">{{ \Carbon\Carbon::parse($admin->created_at)->formatLocalized('%d %B %Y')}}</span>
                        </li>


                      @endforeach

                    </ul>
                    <!-- /.users-list -->
                  </div>

                  <!-- /.card-footer -->
                </div>
                <!--/.direct-chat -->
              </div>
              <!-- /.col -->

              <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Liste responsable</h3>

                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">
                      @foreach ($resps as $respo)
                        <li>
                            <img src="{{asset('dist/img/resp.png')}}" alt="User Image">
                            <a class="users-list-name" href="#">{{$respo->nom}}</a>
                            <span class="users-list-date">{{$respo->desc}}</span>
                        </li>


                      @endforeach

                    </ul>
                    <!-- /.users-list -->
                  </div>

                  <!-- /.card-footer -->
                </div>
                <!--/.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
@endsection

@section('script')

<!-- PAGE SCRIPTS -->
<script src="{{asset('dist/js/pages/dashboard2.js')}}"></script>
@endsection
