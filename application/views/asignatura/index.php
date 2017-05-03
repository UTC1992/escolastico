<style>
    .contenidoAsignatura {
        margin-top: 50px;
    }
</style>
<div  class="contenidoAsignatura" ng-app="appAsignatura" ng-controller="asignaturaDatos">
        
<!--menu -->
<div class="container">
    <center><h2>Administrar Asignaturas</h2></center>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a id="mostrarListaAsig" href="#" class="nav-link">Listar</a>
            <input id="urlConsultarAsig"  type="hidden" value="<?= base_url() ?>admin_/asignaturas/listar">
        </li>
        <li class="nav-item">
            <a id="mostrarRegistroAsig" href="#" class="nav-link">Registrar</a>
            <input id="urlRegistroAsig" type="hidden" value="<?= base_url() ?>admin_/periodoacademico/nuevo">
        </li>
    </ul>
</div>
<br>
<!--menu -->

<!--cuerpo -->
<input class="btn btn-default"  name="omar" value="perror hola" data-id="A" type="button">
<input class="btn btn-default" name="omar" value="gato" data-id="<?= base_url() ?>{{dato}}" type="button">
<input  name="omar" value="hola" type="text" ng-model="datosModel">

<button ng-mousedown="elemento(event);" id="enlace" >Hola click</button>
<!--cuerpo -->

<a  href="#" id="{{idEditar}}" ng-click="ShowId($event)" >Hola mundo</a>   


</div>

<script type="text/javascript" language="javascript" src="<?= base_url() ?>disenio/angular_asignatura/controller.js"></script>
