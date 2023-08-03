<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>IMPRESSION | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row pt-3">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> LOGO
          <small class="float-right">Date: 2/10/2014</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-12">
        <p>
           <center><h1>{{$titre}}</h1></center>
        </p>
      </div>

      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
      <table class="table table-striped ">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>IM</th>
                      <th>Nom</th>
                      <th>Prenom</th>
                      <th>Date naiss</th>
                      <th>Lieu</th>
                      <th>corp</th>
                      <th>Grad</th>
                      <th>Indice</th>
                      <th>Acte</th>
                      <th>Cisco</th>

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
                      <td>{{$ens->nom}}</td>
                      <td> {{$ens->prenom}} </td>
                      <td> {{$ens->date_naiss}} </td>
                      <td> {{$ens->lieu_naiss}} </td>
                      <td> {{$ens->corps}} </td>
                      <td> {{$ens->grad}} </td>
                      <td> {{$ens->indice}} </td>
                      <td> {{$ens->acte}} </td>
                      <td> {{$ens->cisco}} </td>


                    </tr>
                    @endforeach
                  </tbody>
                </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">


      <div class="col-6">


        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Total:</th>
              <td>{{count($liste_ens)}}</td>
            </tr>

          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript">
  window.addEventListener("load", window.print());
</script>
</body>
</html>
