@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                      <div class="panel">
                        <h5>Lista de usuarios</h5>
                      </div>
                      <div class="panel">
                        <table>
                          <thead>
                            <td>#</td>
                            <td>Codigo</td>
                            <td>Identificacion</td>
                            <td>Nombre</td>
                            <td colspan="2">Acciones</td>
                          </thead>
                        @foreach($CodigosOyd as $key => $value)
                            <tr>
                              <td>{{$key}}</td>
                              <td>{{$value->lngID}}</td>
                              <td>{{$value->strNroDocumento}}</td>
                              <td>{{$value->strNombre}}</td>
                              <td><input type="radio" class="accion-radio-code" name="code" value="{{trim($value->lngID)}}"></td>
                            </tr>
                        @endforeach
                        </table>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
