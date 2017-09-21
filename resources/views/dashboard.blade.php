@extends('layouts.admin')
<!--
@section('pagetitle')
	{{ $sysdata['sitname'] }} - Admin Panel
@endsection
@section('pagekeywords')
	{{ $sysdata['sitname'] }} - Admin Panel
@endsection
-->

@section('pagecontent')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Bienvenido {{Auth::user()->name}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection