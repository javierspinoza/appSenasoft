@extends('auth.contenido')

@section('login')
<div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group mb-0 ">
          <div class="card p-4 bg-dark">
          <form class="form-horizontal was-validated" method="POST" action="{{ route('login')}}">
          {{ csrf_field() }}
              <div class="card-body text-white">
    
              <p class="text-muted ">Control de acceso al sistemaaa</p>
              <div class="form-group mb-3{{$errors->has('usuario' ? 'is-invalid' : '')}}">
                <span class="input-group-addon"><i class="icon-user"></i></span>
                <input type="text" value="{{old('usuario')}}" name="usuario" id="usuario" class="form-control" placeholder="Usuario">
                {!!$errors->first('usuario','<span class="invalid-feedback">:message</span>')!!}
              </div>
              <!-- <div class="form-group mb-3{{$errors->has('usuario' ? 'is-invalid' : '')}}">
                <span class="input-group-addon"><i class="icon-user"></i></span>
                <input type="text" value="{{old('usuario')}}" name="usuario" id="usuario" class="form-control" placeholder="Usuario">
                {!!$errors->first('usuario','<span class="invalid-feedback">:message</span>')!!}
              </div> -->
              <div class="form-group mb-4{{$errors->has('password' ? 'is-invalid' : '')}}">
                <span class="input-group-addon"><i class="icon-lock"></i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!}
              </div>
              <div class="row">
                <div class="col-6">
                  <button type="submit" class="btn btn-primary px-4">Acceder</button>
                </div>
              </div>
            </div>
          </form>
          </div>
          <div class="card bg-white " style="width:50%">
            <div class="card-body text-center">
              <div>
                <img src="img\siigosena.png" class="card-img-top" alt="Cinque Terre" >              
                <h6 class="text-muted" style="color:#ABB2B9">Sistema prueba SENASOFT 2020 CAT..</h6>                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
