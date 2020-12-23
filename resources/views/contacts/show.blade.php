@extends('layout')

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Number</th>
            <th scope="col">Email</th>
            <th scope="col">Edit/Delete</th>
        </tr>
        </thead>
        <tbody>
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
        </tbody>
    </table>

@endsection
