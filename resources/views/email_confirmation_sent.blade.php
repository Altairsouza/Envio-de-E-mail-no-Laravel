@extends('layouts.app_layout')



@section('content')

    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h5>Foi enviado um email de confirmacao para <strong>{{$email_address}}</strong></h5>
                <p>Verifica a sua caixa de correrio ou a caixa do SPAM</p>
                <div class="my-5">
                    <a href="{{route('main_index')}}" class="btn btn-primary">voltar</a>
                </div>
            </div>
        </div>
    </div>


@endsection
