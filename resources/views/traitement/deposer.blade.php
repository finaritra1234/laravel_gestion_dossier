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
                Enregistrement de dossier des enseignant
                </div>
                <hr>
                <div class="row no-print">
                <div class="col">
                    <blockquote>
                    <p>Veuillez completer les champs pour enregister  le dossier des enseignant.</p>
                    <small>Appuer sur le bouton <i style="color:green">enregister</i> pour enregistre  le dossier</small>
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
                <h3 class="card-title">ENREGISTRER DOSSIER</h3>
              </div>

              <!-- form start -->
              <form method="POST" action="{{route('traitement.add')}}">
                  @csrf
                <div class="card-body">
                   <h5><i class="fas fa-info"></i> Information sur l'enseignant:</h5><br>
                   <input type="text" style="display:none" class="form-control {{ $errors->has('enseignant_id') ?  'is-invalid':'' }} " value="{{ $ens->id }}"  id="enseignant_id"  name="enseignant_id">
                    <div class="row">
                        <div class="col-sm-6">

                        <address>
                            <strong>IM &nbsp&nbsp&nbsp&nbsp: </strong> {{$ens->im}}<br>
                            <strong>Nom &nbsp&nbsp&nbsp&nbsp: </strong> {{$ens->nom}}<br>
                            <strong>Date de naissance: </strong> {{$ens->date_naiss}}.<br>
                            <strong>Lieu de naissance : </strong> {{$ens->lieu_naiss}}.<br>


                        </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">

                        <address>
                            <strong>Cord &nbsp&nbsp: </strong> {{$ens->corps}}<br>
                            <strong>Grad &nbsp&nbsp: </strong> {{$ens->grad}}<br>
                            <strong>Indice &nbsp&nbsp: </strong>  {{$ens->indice}}.<br>
                            <strong>Acte &nbsp&nbsp: </strong> {{$ens->acte}}.<br>

                        </address>
                        </div>

                    </div><hr>

                   <h5><i class="fas fa-info"></i> Information sur le dossier:</h5>
                   <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="im">Type dossier</label>
                            <select type="text" class="form-control"   id="dossier_id"  name="dossier_id" >
                                @foreach ($doss as $d)
                                    <option value="{{$d->id}}">{{$d->type_dossier}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('dossier_id'))
                                <span class="help-block">
                                    <i style="color: #ff00007a;">{{ $errors->first('im') }}</i>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="im">Responsable</label>
                            <select type="text" class="form-control"   id="responsable_id"  name="responsable_id" >
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

                  </div>
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom">DATE DE DEPOT DE DOSSIER</label>
                            <input type="date" class="form-control {{ $errors->has('date_depot') ?  'is-invalid':'' }}" value="{{ $ens->date_depot }}"    name="date_depot"  placeholder="Entrer date_depot">
                            @if ($errors->has('date_depot'))
                            <span class="help-block">
                                <i style="color: #ff00007a;">{{ $errors->first('date_depot') }}</i>
                            </span>
                            @endif
                        </div>
                    </div>


                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Enregister</button>
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
