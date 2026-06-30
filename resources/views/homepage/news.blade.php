@extends('layouts.app')

@section('title', 'Nieuws')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Nieuws</h4>
                    </div>
                    <div class="card-body">
                        <div class="news-item border-bottom pb-3 mb-3">
                            <h5>🎉 SkillShare is gelanceerd!</h5>
                            <p class="text-muted small">Gepubliceerd: 30 juni 2026</p>
                            <p>
                                We zijn blij om te kunnen aankondigen dat SkillShare officieel is gelanceerd!
                                Studenten kunnen nu kennis delen en samenwerken op ons platform.
                            </p>
                        </div>

                        <div class="news-item border-bottom pb-3 mb-3">
                            <h5>📚 Nieuwe vakken toegevoegd</h5>
                            <p class="text-muted small">Gepubliceerd: 28 juni 2026</p>
                            <p>
                                We hebben nieuwe vakken toegevoegd aan het platform, waaronder Wiskunde,
                                Programmeren en Economie. Studenten kunnen nu bijdragen aan deze vakken.
                            </p>
                        </div>

                        <div class="news-item">
                            <h5>👥 Community groeit snel</h5>
                            <p class="text-muted small">Gepubliceerd: 25 juni 2026</p>
                            <p>
                                De SkillShare community groeit snel! We hebben al meer dan 50 studenten
                                die dagelijks kennis delen en elkaar helpen.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
