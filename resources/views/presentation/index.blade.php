@extends('layouts.presentation')

@section('links')
<link rel="stylesheet" href="{{ asset('gentelella/assets/cssPresentation/styles.css') }}">
@endsection

@section('content')
<header><br><br><br><br>
    <div class="container">
        <div class="header_wrapper">
            <div class="header_nav">
                <a href="#" class="nav_logo">
                    <!-- <img src="{{ asset('gentelella/assets/cssPresentation/Idocs Mali.png') }}" alt="Logo IDOCS MALI"
                            class="logo" width="100" height="100"> -->
                </a>
                <div class="nav_items">
                    <a href="{{ route('presentation.index') }}" class="nav_btn">Accueil</a>
                    <a href="{{ route('presentation.solution') }}" class="nav_btn">Nos Solutions</a>
                    <div class="text-center mali-header" style="margin-top: 20px;">
                        <div class="titre-mali">République du Mali</div>
                        <div class="badge bg-gradient-mali text-black mb-8">
                            <div class="text-uppercase slogan">
                                <span class="vert">Un peuple</span> &middot;
                                <span class="jaune">Un but</span> &middot;
                                <span class="rouge">Une foi</span>
                            </div>
                        </div><br>
                        <div class="wrapper">
                            <button onclick="window.location.href='{{ route('demande.choix') }}'">
                                Faire une demande!
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>




            <div class="header_content">
                <div class="header_empty_wrapper"></div>
                <div class="header_content_wrapper">
                    <h1 class="header_main_title">Une nouvelle approche numérique pour moderniser la gestion des
                        documents administratifs <span>IDOCS MALI</span></h1>
                    <p class="header_p">Facilitez l'accès, la demande et la délivrance des actes de naissance,
                        mariage, décès et certificats via une plateforme digitale dédiée aux mairies du Mali.</p>

                    <div class="header_btns">
                        <a href="{{ route('presentation.about') }}" class="header_btn_bg">EN SAVOIR PLUS</a>
                        <a href="{{ route('presentation.service') }}" class="header_btn_outline">Voir nos
                            services</a>
                    </div>
                </div>
                <div class="header_links">

                    <div class="header_social">
                        <img src="{{ asset('gentelella/assets/cssPresentation/twitter.png') }}" alt="Twitter"
                            class="social_icon" href="www.twitter.com">
                        <img src="{{ asset('gentelella/assets/cssPresentation/facebook.png') }}" alt="Facebook"
                            class="social_icon" href="www.facebook.com">
                        <img src="{{ asset('gentelella/assets/cssPresentation/linkedin.png') }}" alt="LinkedIn"
                            class="social_icon" href="www.linkedin.com">
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection