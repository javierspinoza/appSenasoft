@extends('principal')
@section('contenido')
    <template v-if="menu==1">
        <persona></persona>
    </template>
    <template v-if="menu==2">
        <producto></producto>
    </template>
    <template v-if="menu==3">
        <sucursales></sucursales>
    </template>
    {{-- <template v-if="menu==4">
        <componente></componente>
    </template> --}}
    <template v-if="menu==5">
        <roles></roles>
    </template>
    <template v-if="menu==8">
        <bodega></bodega>
    </template>
    <template v-if="menu==9">
        <tenan></tenan>
    </template>
@endsection