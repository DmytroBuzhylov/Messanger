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

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#friendsModal">
                                    Список друзей
                                </button>
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

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestsModal">
                                    Ваши запросы
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <div class="modal fade" id="friendsModal" tabindex="-1" aria-labelledby="friendsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="friendsModalLabel">Список друзей</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group">
                                @foreach($contacts as $contact)
                                    @if($contact->status == 'accepted')

                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            @php
                                                if ($contact->user->name != auth()->user()->name) {
                                                    echo  "<span>{$contact->user->name}</span>";
                                                } elseif ($contact->contact->name != auth()->user()->name) {
                                                    echo  "<span>{$contact->contact->name}</span>";
                                                }

                                            @endphp

                                            <form action="{{ route('delete.contact') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="contact_id" value="{{ $contact->id }}">
                                                <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                                            </form>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>



            <div class="modal fade" id="requestsModal" tabindex="-1" aria-labelledby="requestsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="requestsModalLabel">Ваши запросы</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                        </div>
                        <div class="modal-body">
                            <ul class="list-group">
                                @foreach($contacts as $contact)
                                    @if($contact->status == 'pending' && $contact->user_id == auth()->user()->id)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>{{ $contact->contact->email }}</span>
                                            <form action="{{ route('delete.contact') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="contact_id" value="{{ $contact->id }}">
                                                <button type="submit" class="btn btn-danger btn-sm">Отменить</button>
                                            </form>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
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


                                    <form action="{{ route('delete.contact') }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="contact_id" value="{{ $contact->id }}">
                                        <input class="btn btn-danger btn-sm" type="submit" value="  Deny ">
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
