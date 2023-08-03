<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Impression</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="container">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> Logo
          <small class="float-right">{{Carbon\Carbon::now()->formatLocalized('%d %B %Y')}}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div><br><br>
    <!-- info row -->
    <div class="row">
      <div class="col">
      
      <h1>Information de l'enseignant</h1>
      <ul>
          <li><strong>IM  &nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp : </strong>{{ $liste_ens->im}}</li>
          <li><strong>NOM ET PRENOM   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:  </strong>{{ $liste_ens->nom_enseignant}}  {{ $liste_ens->prenom}}</li>
          <li><strong>DATE DE NAISSANCE  &nbsp: </strong>{{ $liste_ens->date_naiss}}</li>
          <li><strong>LIEU DE NAISSANCE &nbsp : </strong>{{ $liste_ens->lieu_naiss}}</li>
          <li><strong>CORPS   &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp: </strong>{{ $liste_ens->corps}}</li>
          <li><strong>GRAD &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp: </strong>{{ $liste_ens->grad}}</li>
          <li><strong>ACTE &nbsp &nbsp&nbsp &nbsp&nbsp &nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp&nbsp &nbsp: </strong>{{ $liste_ens->acte}}</li>
         
      </ul>
      </div>
 
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <h1>Information sur le dossier</h1>
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>ID</th>
            <th>TYPE DOSSIER</th>
            <th>DATE DEPOSER</th>
            <th>DATE TRANSFERER</th>
            <th>DATE RETOUR</th>
            <th>STATUS</th>
            <th>TRAITE PAR</th>
            <th>MOTIF</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>{{ $liste_ens->id}}</td>
            <td>{{ $liste_ens->type_dossier}}</td>
            <td>{{ Carbon\Carbon::parse($liste_ens->date_depot)->formatLocalized('%d %B %Y')}}</td>
            <td>{{ Carbon\Carbon::parse($liste_ens->date_envoye)->formatLocalized('%d %B %Y')}}</td>
            <td>{{ Carbon\Carbon::parse($liste_ens->date_retour)->formatLocalized('%d %B %Y')}}</td>
            <td>{{ $liste_ens->status}}</td>
            <td>{{ $liste_ens->nom}}</td>
            <td>{{ $liste_ens->motif}}</td>
           
           
          </tr>
       
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6">
        <p class="lead">Payment Methods:</p>
        <img src="../../dist/img/credit/visa.png" alt="Visa">
        <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
        <img src="../../dist/img/credit/american-express.png" alt="American Express">
        <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr
          jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
        </p>
      </div>
      <!-- /.col -->
      <div class="col-6">
        <p class="lead">Amount Due 2/22/2014</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td>$250.30</td>
            </tr>
            <tr>
              <th>Tax (9.3%)</th>
              <td>$10.34</td>
            </tr>
            <tr>
              <th>Shipping:</th>
              <td>$5.80</td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>$265.24</td>
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
