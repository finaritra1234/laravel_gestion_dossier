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
                  Modifier dossier au responsable
                </div>
                <hr>
                <div class="row no-print">
                <div class="col">
                    <blockquote>
                    <p>Veuillez completer les champs pour modifier  le dossier des traiteignant.</p>
                    <small>Appuer sur le bouton <i style="color:green">modifier</i> pour valider  le transfert</small>
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
                <h3 class="card-title">MODIFIER DOSSIER</h3>
              </div>

              <!-- form start -->
              <form method="POST" action="{{route('traitement.update', ['id' => $trait->id])}}">
                  @csrf

                <div class="card-body">


                   <h5><i class="fas fa-info"></i> Information sur le dossier:</h5>

                   <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="im">Date depot:</label>
                                <input type="date" class="form-control  {{ $errors->has('date_depot') ?  'is-invalid':'' }}" value="{{$trait->date_depot}}"   id="date_depot"  name="date_depot" >


                                @if ($errors->has('date_depot'))
                                    <span class="help-block">
                                        <i style="color: #ff00007a;">{{ $errors->first('date_depot') }}</i>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nom">DATE DE TRANSFERT</label>
                                <input type="date" class="form-control {{ $errors->has('date_envoye') ?  'is-invalid':'' }}" value="{{ $trait->date_envoye }}"    name="date_envoye" >
                                @if ($errors->has('date_envoye'))
                                <span class="help-block">
                                    <i style="color: #ff00007a;">{{ $errors->first('date_envoye') }}</i>
                                </span>
                                @endif
                            </div>
                        </div>

                   </div>

                   <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="im">RESPONSABLE:</label>
                                <select type="text" class="form-control  {{ $errors->has('responsable_id') ?  'is-invalid':'' }}"   id="responsable_id"  name="responsable_id" >
                                    <option value="{{$re->id}}">{{$re->nom}}</option>
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
                                <label for="nom">DATE DE RETOUR</label>
                                <input type="date" class="form-control {{ $errors->has('date_retour') ?  'is-invalid':'' }}" value="{{ $trait->date_retour }}"    name="date_retour" >
                                @if ($errors->has('date_retour'))
                                <span class="help-block">
                                    <i style="color: #ff00007a;">{{ $errors->first('date_retour') }}</i>
                                </span>
                                @endif
                            </div>
                        </div>

                   </div>
                   <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="im">STATUS</label>
                                <select type="text" class="form-control  {{ $errors->has('status') ?  'is-invalid':'' }}"   id="status"  name="status" >
                                    <option  value="{{ $trait->status }}">{{ $trait->status }}</option>

                                    <option value="REJETER">REJETER</option>
                                    <option value="ACCEPTER">ACCEPTER</option>

                                </select>

                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <i style="color: #ff00007a;">{{ $errors->first('status') }}</i>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nom">MOTIF</label>
                                <input  class="form-control {{ $errors->has('motif') ?  'is-invalid':'' }}" value="{{ $trait->motif }}"    name="motif" >
                                @if ($errors->has('motif'))
                                <span class="help-block">
                                    <i style="color: #ff00007a;">{{ $errors->first('motif') }}</i>
                                </span>
                                @endif
                            </div>
                        </div>

                   </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Modifier</button>
                  <a class="btn btn-info float-right" href="{{route('traitement.liste')}}">LISTE DOSSIER</a>
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
