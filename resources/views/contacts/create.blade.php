@extends('layout')

@section('content')

    <div class="col-5 mt-5 ml-auto mr-auto">
        <form method="POST" action="{{route('contacts.store')}}">
            @csrf
            <div class="form-group">
                <label for="name">Contact Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{old('name')}}">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="numbers">
                <div class="form-group">
                    <label for="number1">Number</label>
                    <input type="tel" class="form-control" id="number1" placeholder="Number" name="number[]" value="{{old('number.0')}}">
                </div>
                @error('number.*')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button id="add_number" type="button" class="btn btn-info">+ Add one more number</button>
            <div class="emails">
                <div class="form-group">
                    <label for="email1">Email</label>
                    <input type="email" class="form-control" id="email1" placeholder="Email" name="email[]" value="{{old('email.0')}}">
                </div>
                @error('email.*')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button id="add_email" type="button" class="btn btn-info">+ Add one more email</button>


            <button type="submit" class="btn btn-primary d-block mt-5">Create</button>
        </form>

    </div>


@endsection

