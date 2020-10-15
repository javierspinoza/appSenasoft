@extends('principal')
@section('contenido')
    <template v-if="menu==1">
        <componente></componente>
    </template>
    <template v-if="menu==2">
        <personas></personas>
    </template>
    <template v-if="menu==3">
        <sucursales></sucursales>
    </template>
    <template v-if="menu==4">
        <componente></componente>
    </template>
    <template v-if="menu==5">
        <roles></roles>
    </template>
@endsection