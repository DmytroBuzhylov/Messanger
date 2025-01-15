@extends('layouts.layout')
@section('content')

    <div class="container-fluid vh-100">
        <div class="row h-100">


            <div class="col-3 border-end bg-light">
                <h5 class="p-3">Друзья</h5>
                <ul class="list-group">
                    @if($contacts)
                        @foreach($contacts as $contact)
                            @if($contact->user->email != auth()->user()->email)
                                <li class="list-group-item"><a href="{{ route('messages', $contact->user->id) }}">{{ $contact->user->name }}</a></li>
                            @elseif($contact->contact->email != auth()->user()->email)
                                <li class="list-group-item"><a href="{{ route('messages', $contact->contact->id) }}">{{ $contact->contact->name }}</a></li>
                            @endif
                        @endforeach
                    @else
                        <p>Похоже, у тебя нет друзей</p>
                        <a href="{{ route('profile') }}" style="text-decoration: none">Добавить друга!</a>
                    @endif
                </ul>
            </div>


            <div class="col-9 d-flex flex-column">


                <div class="chat-box flex-grow-1 overflow-auto p-3">
                    <div class="d-flex flex-column gap-3">
                        @if($messages)
                            @foreach($messages as $message)
                                @if($message->sender_id == auth()->user()->id)

                                    <div class="d-flex justify-content-end align-items-start position-relative">
                                        <div class="bg-primary text-white p-2 rounded">
                                            {{ $message->message }}
                                        </div>

                                        <div class="dropdown ms-2">
                                            <button class="btn btn-light btn-sm p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <button class="dropdown-item edit-message-btn">Редактировать</button>
                                                </li>
                                                <li>
                                                    <form action="{{ route('message.delete', $message->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="dropdown-item text-danger">Удалить</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>


                                    <div class="edit-message-form bg-light p-2 rounded d-none">
                                        <form action="{{ route('message.update', $message->id) }}" method="POST" class="d-flex gap-2 align-items-center">
                                            @csrf
                                            @method('put')
                                            <input type="text" name="message" class="form-control message-input" value="{{ $message->message }}">
                                            <button type="submit" class="btn btn-primary btn-sm save-edit-btn">Сохранить</button>
                                            <button type="button" class="btn btn-secondary btn-sm cancel-edit-btn">Отмена</button>
                                        </form>
                                    </div>
                                @else

                                    <div class="d-flex justify-content-start">
                                        <div class="bg-dark text-white p-2 rounded">
                                            <strong>{{ $message->sender->name }}:</strong> {{ $message->message }}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>


                <div class="border-top p-3 bg-light">
                    <form class="d-flex gap-2" action="{{ route('messages.create') }}" method="POST">
                        @csrf
                        <input type="text" name="message" class="form-control" placeholder="Введите сообщение...">
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </form>
                </div>
            </div>

        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const editButtons = document.querySelectorAll(".edit-message-btn");
            const saveButtons = document.querySelectorAll(".save-edit-btn");
            const cancelButtons = document.querySelectorAll(".cancel-edit-btn");

            editButtons.forEach((button) => {
                button.addEventListener("click", function () {
                    const parent = button.closest(".d-flex");
                    const messageText = parent.querySelector(".bg-primary");
                    const editForm = parent.nextElementSibling;

                    editForm.classList.remove("d-none"); // Показать форму редактирования
                    messageText.classList.add("d-none"); // Скрыть текст сообщения
                });
            });


            saveButtons.forEach((button) => {
                button.addEventListener("click", function (event) {
                    const form = button.closest(".edit-message-form");
                    const parent = form.previousElementSibling;
                    const messageText = parent.querySelector(".bg-primary");

                    const newMessage = form.querySelector(".message-input").value;


                    messageText.textContent = newMessage;

                    form.classList.add("d-none");
                    messageText.classList.remove("d-none");
                });
            });


            cancelButtons.forEach((button) => {
                button.addEventListener("click", function () {
                    const form = button.closest(".edit-message-form");
                    const parent = form.previousElementSibling;
                    const messageText = parent.querySelector(".bg-primary");

                    form.classList.add("d-none");
                    messageText.classList.remove("d-none");
                });
            });
        });
    </script>

@endsection
