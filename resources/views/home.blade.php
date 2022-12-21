<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@extends('layouts.head')

@if ($errors->any())
    <body id="home-body" onload="getData(); selectLastSection();">
@else
    <body id="home-body" onload="getData()">
@endif

    <div id="cont">
        <aside id="sidebar" class="d-flex flex-column p-3 text-bg-dark">
            <a href="/" class="mb-2 text-center text-white text-decoration-none">
                <span class="fs-4">Benvenuto!</span>
            </a>
            <hr class="my-1">
            <ul id="sidebar-ul" class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="to-select nav-link text-white active" aria-current="page"
                        data-selected='0'>
                        <i class="me-2 bi bi-person-badge" style="font-size: 1.2em;"></i>
                        Chi sono
                    </a>
                </li>
                <li>
                    <a href="#" onclick="typeWriter('div[data-selected=\'1\']')"
                        class="to-select nav-link text-white" data-selected='1'>
                        <i class="me-2 bi bi-star" style="font-size: 1.2em;"></i>
                        Cosa mi piace
                    </a>
                </li>
                <li>
                    <a href="#" class="to-select nav-link text-white" data-selected='2'>
                        <i class="me-2 bi bi-instagram" style="font-size: 1.2em;"></i>
                        I miei contatti social
                    </a>
                </li>
                <li>
                    <a href="#" class="to-select nav-link text-white" data-selected='3'>
                        <i class="me-2 bi bi-envelope-at" style="font-size: 1.2em;"></i>
                        Contattami
                    </a>
                </li>
            </ul>
            <hr class="my-1">
            <div class="dropdown bg-dark">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://robohash.org/{{ Auth::user()->name }}" alt="" width="36"
                        height="36" class="rounded-circle me-2">
                    <strong>{{ Auth::user()->name }}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </aside>

        <main>
            @if ($message = Session::get('success')) 
                <div class="alert alert-success">   
                    <p class="mb-0">{{ $message }}</p> 
                </div>
            @endif
            
            <div class="content" data-selected='0'>
                <h2 class="text-center">
                    Benvenuto
                    <img src="{{ URL("images/hello.webp") }}" width="30px" />
                </h2>
                <h3 class="text-center mt-3 fst-italic"></h3>
            </div>

            <div class="content" data-selected='1' style="display:none">
                <h2 class="text-center">
                    Cosa mi piace
                    <img src="{{ URL("images/stars.gif") }}" width="30px" >
                </h2>
                <p class="mt-3"></p>
            </div>

            <div class="content" data-selected="2" style="display:none">
                <h2 class="text-center">
                    I miei canali
                </h2>
                <div class="mt-3" id="badges">

                </div>
            </div>

            <div class="content" data-selected="3" style="display:none">
                <h3 class="text-center">Contattami</h3>
                <form method="POST" action="{{ route('contact-us.store') }}" id="contactUSForm"
                    onsubmit="selectLastSection(event)">
                    <input id="emailTo" type="hidden" name="to">
                    @csrf
                    <div class="mt-3 row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Nome:</strong>
                                <input type="text" name="name" class="form-control" placeholder="Nome"
                                    value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Cognome: </strong>
                                <input type="text" name="last_name" class="form-control" placeholder="Cognome"
                                    value="{{ old('last_name') }}">

                                @if ($errors->has('last_name'))
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Oggetto:</strong>
                                <input type="text" name="subject" class="form-control" placeholder="Oggetto"
                                    value="{{ old('subject') }}">

                                @if ($errors->has('subject'))
                                    <span class="text-danger">{{ $errors->first('subject') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Messaggio:</strong>
                                <textarea name="message" rows="3" class="form-control">{{ old('message') }}</textarea>

                                @if ($errors->has('message'))
                                    <span class="text-danger">{{ $errors->first('message') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center my-2">
                        <button class="btn btn-dark btn-submit" type="submit">Invia</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
