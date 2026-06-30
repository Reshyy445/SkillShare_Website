@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Contact</h4>
                    </div>
                    <div class="card-body">
                        <h5>Heb je vragen of opmerkingen?</h5>
                        <p>Neem contact met ons op via onderstaande gegevens.</p>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-envelope fa-2x text-primary"></i>
                                        <h6 class="mt-2">Email</h6>
                                        <p class="text-muted">info@skillshare.nl</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <i class="fas fa-phone fa-2x text-primary"></i>
                                        <h6 class="mt-2">Telefoon</h6>
                                        <p class="text-muted">+31 (0)20 123 4567</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h6>Adres</h6>
                                    <p class="text-muted">
                                        SkillShare B.V.<br>
                                        Educatielaan 123<br>
                                        1000 AA Amsterdam<br>
                                        Nederland
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
