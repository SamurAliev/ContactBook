@extends('layout')

@section('lastNumberId')
{{$lastNumberId}}
@endsection

@section('lastEmailId')
{{$lastEmailId}}
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-danger w-100">
            {{ session('status') }}
        </div>
    @endif

    <div class="col-5 mt-5 ml-auto mr-auto">
        <form method="POST" action="{{route('contacts.update', $contact)}}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Contact Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name"
                       value="{{$contact->name}}">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="numbers">
                @foreach($numbers as $number)


                    <div class="form-group">
                        <label for="number1">Number</label>
                        <input type="tel" class="form-control" id="number1" placeholder="Number" name="number[{{$number['id']}}]"
                               value="{{$number['number']}}">
                    </div>

                    @error('number.*')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                @endforeach
            </div>

            <button id="add_number" type="button" class="btn btn-info">+ Add one more number</button>
            <div class="emails">
                @foreach($emails as $email)

                    <div class="form-group">
                        <label for="email1">Email</label>
                        <input type="email" class="form-control" id="email1" placeholder="Email" name="email[]"
                               value="{{$email['email']}}">
                    </div>

                    @error('email.*')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                @endforeach
            </div>
            <button id="add_email" type="button" class="btn btn-info">+ Add one more email</button>


            <button type="submit" class="btn btn-success d-block mt-5 pr-5 pl-5">Edit</button>
        </form>

    </div>
@endsection

