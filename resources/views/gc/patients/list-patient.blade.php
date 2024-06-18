@extends('layouts.master')
@section('title')Metrica @endsection
@section('content')
<!-- this is breadcrumbs -->
@component('components.breadcrumb')
@slot('li_1') Metrica @endslot
@slot('li_2') Hospital @endslot
@slot('title') All Patients @endslot
@endcomponent
<div class="row">
    <list-patients-component></list-patients-component>
</div>
@endsection
