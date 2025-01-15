@extends('layouts.layout')
@section('content')
<style>
    body {
        background-color: #d9dfe8;
    }
</style>

    <div class="container py-5">


        @if(isset($error))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ $error  }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        @endif


        <div class="row mb-4">
            <div class="col-md-4 text-center">

                <h3>{{ auth()->user()->name }}</h3>
                <p class="text-muted">{{ auth()->user()->email }}</p>
            </div>
            <div class="col-md-8 d-flex flex-column justify-content-center">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card text-center shadow">
                            <div class="card-body">
                                <h5 class="card-title">Друзья</h5>
                                <p class="card-text fs-4">
                                    @php
                                        $contacts = $outgoingContacts->merge($incomingContacts);
                                $i = 0;
                                foreach ($contacts as $contact) {
                                     if ($contact->status == 'accepted') {
                                        $i++;
                                    }
                                }
                                echo $i;
                                    @endphp
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card text-center shadow">
                            <div class="card-body">
                                <h5 class="card-title">Ваших запросов</h5>
                                <p class="card-text fs-4">
                                    @php
                                        $i = 0;

                                        foreach ($contacts as $contact) {
                                             if ($contact->status == 'pending' && $contact->user_id == auth()->user()->id) {
                                                $i++;
                                            }
                                        }
                                        echo $i;
                                    @endphp
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <h4>Запросы в друзья</h4>
                <ul class="list-group">

                        @foreach($incomingContacts as $contact)



                        @if($contact->status == 'pending')
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $contact->user->name }}</strong>
                                    <p class="mb-0 text-muted">{{ $contact->user->email }}</p>
                                </div>
                                <div style="align-items: center">

                                    <form action="{{ route('update_contact') }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <input class="btn btn-success btn-sm me-2" type="submit" name="accepted" value="Accept">
                                    </form>


                                    <form action="{{ route('delete_contact') }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input class="btn btn-danger btn-sm" type="submit" name="rejected" value="  Deny ">
                                    </form>


                                </div>
                            </li>
                        @endif

                    @endforeach



                </ul>
            </div>
        </div>






        <div class="row mt-4">
            <div class="col">
                <h4>Добавить друга</h4>
                <form class="d-flex gap-2" action="{{ route('add_contact') }}" method="post">
                    @csrf
                    <input name="email" type="email" class="form-control" placeholder="Введите email друга" required>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </form>

            </div>

        </div>



    </div>

@endsection
