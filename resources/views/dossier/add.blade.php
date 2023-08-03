@extends('layouts.page_content')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>GERER ENSEIGNANT</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Enseignant</li>
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
                <h3 class="card-title">Requete sur les enseignants</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             <div class="card-body">
                <form class="form-inline ml-3" method="POST" action="{{route('enseignant.im')}}">
                  @csrf
                    <label for="search">Rechercher par IM</label>
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" name="search" id="search" placeholder="Entre IM" aria-label="Search">
                        <div class="input-group-append">
                        <button class="btn btn-info" type="submit">
                            Entrer
                        </button>
                        </div>
                    </div>
                </form> <hr>
                <form class="form-inline ml-3" method="POST" action="{{route('enseignant.cisco')}}">
                    @csrf
                    <label for="cisco">Rechercher par cisco</label>
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" name="cisco" id="cisco" placeholder="cisco" value="{{old('cisco')}}" aria-label="Search">
                        <div class="input-group-append">
                        <button class="btn btn-info" type="submit">
                            Entrer
                        </button>
                        </div>
                    </div>
                </form><hr>

                <form class="form-inline ml-3" method="POST" action="{{route('enseignant.search')}}">
                    @csrf
                    <label for="cisco">Rechercher par:</label>
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
                </form><hr>
                <div class="row no-print">
                <div class="col">
                  <a href="#" data-toggle="modal" data-target="#modal-sm" class="btn btn-default"><i class="fas fa-print"></i> Impression</a>

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
                <h3 class="card-title">Ajouter enseignant</h3>
              </div>

              <!-- form start -->
              <form method="POST" action="{{route('enseignant.add')}}" name="myForm" onsubmit="return ima()">
                  @csrf
                <div class="card-body">
                   <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="im">IM</label>
                            <input type="text" class="form-control {{ $errors->has('im') ?  'is-invalid':'' }} " value="{{ old('im') }}"  id="im"  name="im"  placeholder="Entrer im">
                            @if ($errors->has('im'))
                                <span class="help-block">
                                    <i style="color: #ff00007a;">{{ $errors->first('im') }}</i>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom" class>NOM</label>
                            <input type="text" class="form-control {{ $errors->has('nom') ?  'is-invalid':'' }}" value="{{ old('nom') }}"    name="nom"  placeholder="Entrer  nom">
                            @if ($errors->has('nom'))
                            <span class="help-block">
                                <i style="color: #ff00007a;">{{ $errors->first('nom') }}</i>
                            </span>
                            @endif
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom">PRENOM</label>
                            <input type="text" class="form-control {{ $errors->has('prenom') ?  'is-invalid':'' }}" value="{{ old('prenom') }}"    name="prenom"  placeholder="Entrer prenom">
                            @if ($errors->has('prenom'))
                            <span class="help-block">
                                <i style="color: #ff00007a;">{{ $errors->first('prenom') }}</i>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom">DATE DE NAISSANCE</label>
                            <input type="date" class="form-control {{ $errors->has('date_naiss') ?  'is-invalid':'' }}" value="{{ old('date_naiss') }}"    name="date_naiss"  placeholder="Entrer date de naissance ">
                            @if ($errors->has('date_naiss'))
                            <span class="help-block">
                            <i style="color: #ff00007a;">{{ $errors->first('date_naiss') }}</i>
                            </span>
                            @endif
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom">LIEU DE NAISSANCE</label>
                            <input type="text" class="form-control {{ $errors->has('lieu_naiss') ?  'is-invalid':'' }}" value="{{ old('lieu_naiss') }}"    name="lieu_naiss"  placeholder="Entrer lieu de naissance">
                            @if ($errors->has('lieu_naiss'))
                            <span class="help-block">
                                <i style="color: #ff00007a;">{{ $errors->first('lieu_naiss') }}</i>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom">CORPS</label>
                            <input type="text" class="form-control {{ $errors->has('corps') ?  'is-invalid':'' }}" value="{{ old('corps') }}"    name="corps"  placeholder="Entrer le corp">
                            @if ($errors->has('corps'))
                            <span class="help-block">
                                <i style="color: #ff00007a;">{{ $errors->first('corps') }}</i>
                            </span>
                            @endif
                        </div>
                    </div>
                   </div>
                   <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom">GRAD</label>
                            <input type="text" class="form-control {{ $errors->has('grad') ?  'is-invalid':'' }}" value="{{ old('grad') }}"    name="grad"  placeholder="Entrer grad">
                            @if ($errors->has('grad'))
                            <span class="help-block">
                                <i style="color: #ff00007a;">{{ $errors->first('grad') }}</i>
                            </span>
                            @endif
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom">INDICE</label>
                            <input type="text" class="form-control {{ $errors->has('indice') ?  'is-invalid':'' }}" value="{{ old('indice') }}"    name="indice"  placeholder="Entrer indice">
                            @if ($errors->has('indice'))
                            <span class="help-block">
                                <i style="color: #ff00007a;">{{ $errors->first('indice') }}</i>
                            </span>
                            @endif
                        </div>
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom">ACTE</label>
                            <input type="text" class="form-control {{ $errors->has('acte') ?  'is-invalid':'' }}" value="{{ old('acte') }}"    name="acte"  placeholder="Entrer acte">
                            @if ($errors->has('acte'))
                            <span class="help-block">
                                <i style="color: #ff00007a;">{{ $errors->first('acte') }}</i>
                            </span>
                            @endif
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="nom">ETABLISSEMENT</label>
                            <select type="text" class="form-control {{ $errors->has('etablissement_id') ?  'is-invalid':'' }}" value="{{ old('etablissement_id') }}"    name="etablissement_id" >
                               <option value="">Choisir etablissement</option>
                                @foreach ($etabl as $eta)
                                <option value="{{ $eta->id }}">{{ $eta->cisco }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('etablissement_id'))
                            <span class="help-block">
                                <i style="color: #ff00007a;">{{ $errors->first('etablissement_id') }}</i>
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
    <script>
      function ima(){
        var im = document.forms["myForm"]["im"].value;

        //im
        if (isNaN(im) === false) {
            var isa = im.length;
            if (isa == 6) {
                document.forms["myForm"]["im"].value = im.substring(0, 3) + "" + im.substring(3, 6);

            } else {
                alert("IM est invalide");
                document.getElementById('im').className = "form-control is-invalid"
                return false;
            }
        } else {
            alert("IM est incorrecte");
            document.getElementById('im').className = "form-control is-invalid"

            return false;
        }
      }
    </script>
    <!-- /.content -->
@endsection
