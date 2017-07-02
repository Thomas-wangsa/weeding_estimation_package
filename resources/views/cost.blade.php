@extends('layouts.header')

@section('content')

<!-- Container (Services Section) -->
<div id="services" class="container-fluid text-center">
  <h2> COST </h2>
  <h4> Detail Cost </h4>
  <br>
  <div class="row ">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-home logo-small"></span>
      <h4>PACKAGE</h4>
      <p> Wedding Package</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-heart logo-small"></span>
      <h4>Bridal</h4>
      <p>Bridall Add On </p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-plus logo-small"></span>
      <h4> Food </h4>
      <p> Food Add On </p>
    </div>
  </div>
  <br><br>
  <div class="row">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-shopping-cart logo-small"></span>
      <h4>Exclude </h4>
      <p> Exclude Add On</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-user logo-small"></span>
      <h4>Event </h4>
      <p>Event Budget </p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-thumbs-up logo-small"></span>
      <h4 style="color:#303030;">Other</h4>
      <p>Cost & Etc </p>
    </div>
  </div>
</div>


@endsection