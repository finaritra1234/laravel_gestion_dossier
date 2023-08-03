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
        <div class="alert alert-success alert-dismissible" role="alert">
            {{Session::get('success')}}

        </div>
        @endif
        <div class="row">
          <div class="col-md-3">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Requete</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             <div class="card-body">
                <div class="callout callout-info">
                <h5><i class="fas fa-info"></i> Note:</h5>
                  Transfert du dossier au responsable
                </div>
                <hr>
                <div class="row no-print">
                <div class="col">
                    <blockquote>
                    <p>Veuillez completer les champs pour transfert  le dossier des enseignant.</p>
                    <small>Appuer sur le bouton <i style="color:green">valider</i> pour valider  le transfert</small>
                    </blockquote>
                </div>
            </div>

            </div>
          </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">TRANSFERER DOSSIER</h3>
              </div>

              <!-- form start -->
              <form method="POST" action="{{route('traitement.transfert_update', ['id' => $ens->id])}}">
                  @csrf

                <div class="card-body">


                   <h5><i class="fas fa-info"></i> Information sur le transfert:</h5>



                   <div class="row">
                    <div class="col-md-6">
                            <div class="form-group">
                            <h1 style="color:green">IM : {{ $ens->im }}</h1>

                            </div>
                        </div>
                   </div>

                   <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="im">Transferer au:</label>
                                <select type="text" class="form-control  {{ $errors->has('responsable_id') ?  'is-invalid':'' }}"   id="responsable_id"  name="responsable_id" >
                                    <option value="">Choisir le responsable</option>
                                    @foreach ($resp as $re)
                                        <option value="{{$re->id}}">{{$re->nom}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('responsable_id'))
                                    <span class="help-block">
                                        <i style="color: #ff00007a;">{{ $errors->first('responsable_id') }}</i>
                                    </span>
                                @endif
                            </div>
                        </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom">DATE DE TRANSFERT</label>
                            <input type="date" class="form-control {{ $errors->has('date_envoye') ?  'is-invalid':'' }}" value="{{ $ens->date_envoye }}"    name="date_envoye" >
                            @if ($errors->has('date_envoye'))
                            <span class="help-block">
                                <i style="color: #ff00007a;">{{ $errors->first('date_envoye') }}</i>
                            </span>
                            @endif
                        </div>
                    </div>

                   </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Valider</button>
                  <a class="btn btn-info float-right" href="{{route('enseignant.liste')}}">LISTE ENSEIGNANT</a>
                </div>
              </form>
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
