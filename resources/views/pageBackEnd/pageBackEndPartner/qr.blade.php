@extends('layouts.masterBackEndPartner')
@section('title', 'Type QR')
@section('content')
<div id="content" class="app-content">
    <div class="note note-primary">
        <div class="note-icon"><i class="fa fa-info"></i></div>
        <div class="note-content">
            <h4><b>Example Label QR Labelin.go</b></h4>
            <p> Ini adalah beberapa example QR dari Labelin.Co yang bisa partner pesan !!! Silahkan order melalui menu request QR. Pilih Type QR sesuai dengan kebutuhan bisnis anda. Terimakasih </p>
        </div>
    </div>

    <div class="row">

        @foreach($qr as $value)
        <div class="col-xl-3 ui-sortable">
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <div class="panel-heading ui-sortable-handle">
                    <h4 class="panel-title">Type : {{ $value->name }} - Harga : {{ $value->price }} / Pcs </h4>
                </div>
                <div class="panel-body">
                    <img src="{{ asset('storage/uploads/photos/' . $value->photo) }}" alt="photo" class="rounded" width="100px">
                </div>
                <center>
                    <a href="{{ asset('storage/uploads/photos/' . $value->photo) }}" class="btn btn-success" target="_blank"> <i class="fa fa-eye"></i> Klik To Preview </a>
                </center> <br>
            </div>


        </div>
        @endforeach

    </div>
</div>
</div>
@endsection
