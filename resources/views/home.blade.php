@extends('layouts.app')

@section('content')
<div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Sistermine</h3>
                </div>
            </div>
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-group fa-fw"></i> Profile
                    </div>
                    <div class="panel-body" id="profile-panel">
                        <div class="row profile-info-row">
                            <div class="col-md-2 profile-info">Nama</div>
                            <div class="col-md-8" id="nama">{{ Auth::user()->name }}</div>
                        </div>
                        <div class="row profile-info-row">
                            <div class="col-md-2 profile-info">Email</div>
                            <div class="col-md-8" id="email">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
