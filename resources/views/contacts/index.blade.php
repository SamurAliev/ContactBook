@extends('layout')

@section('content')

    @if (session('status'))
        <div class="alert alert-success w-100">
            {{ session('status') }}
        </div>
    @endif


    <a href="{{route('contacts.create')}}" type="button" class="btn btn-success m-3">Create new contact</a>
    <nav class="navbar navbar-light bg-light ml-auto">
        <form method="POST" class="form-inline" action="{{route('contact.show')}}">
            @csrf
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="content">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </nav>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">@sortablelink('name', 'Name')</th>
            <th scope="col">Number</th>
            <th scope="col">Email</th>
            <th scope="col">Edit/Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contacts as $contact)
        <tr>
            <td>{{$contact->name}}</td>
            <td>
                @foreach($contact->numbers->pluck('number') as $number)
                    {{$number}} <br>
                @endforeach
            </td>
            <td>
                @foreach($contact->emails->pluck('email') as $email)
                    {{$email}} <br>
                @endforeach
            </td>
            <td><a href="{{route('contacts.edit', $contact)}}" type="button" class="btn btn-info w-100 mb-2">Edit</a>
                <form action="{{ route('contacts.destroy', $contact)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button onclick="return confirm('Are you sure?')"  type="submit" class="btn btn-danger w-100">Delete</button>

                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {!! $contacts->appends(Request::except('page'))->render() !!}

    <p class="w-100">
        Displaying {{$contacts->count()}} of {{ $contacts->total() }} contact(s).
    </p>

@endsection
