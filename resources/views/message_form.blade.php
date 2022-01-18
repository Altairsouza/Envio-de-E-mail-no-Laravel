@extends('layouts.app_layout');



@section('content')

    <div class="row">
        <div class="col-sm-4 offset-sm-4">


            <form action="{{route('main_init')}}" method="post">
                @csrf
                <div class="form-group">
                    <label For="text_from">From:</label>
                    <input type="email" name="text_from" class="form-control" value="{{old('text_from')}}">

                </div>

                 <div class="form-group">
                    <label For="text_to">To:</label>
                    <input type="email" name="text_to" class="form-control" value="{{old('text_to')}}">

                </div>


                 <div class="form-group">
                    <label>Message:</label>
                    <textarea name="text_message" rows="5" class="form-control"value="{{old('text_message')}}"></textarea>

                </div>

                <div class="text-center">

                    <input type="submit" value="Sed One Time Message" class="btn btn-primary">
                </div>

            </form>

            @if ($errors->any())
            <div class="alert alert-danger p-2 my-3">
                <ul>
                    @foreach ($errors->all() as $error )
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

    </div>
@endsection
