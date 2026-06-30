@extends('layouts.app')

@section('title', 'Over SkillShare')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Over SkillShare</h4>
                    </div>
                    <div class="card-body">
                        <h5>Wat is SkillShare?</h5>
                        <p>
                            SkillShare is een online leerplatform voor studenten waarop gebruikers kennis en ervaringen
                            kunnen delen over verschillende vakken en onderwerpen.
                        </p>

                        <h5 class="mt-4">Onze Missie</h5>
                        <p>
                            Wij geloven dat samen leren beter is dan alleen leren. SkillShare brengt studenten samen
                            om kennis te delen, vragen te stellen en elkaar te helpen bij het studeren.
                        </p>

                        <h5 class="mt-4">Wat kun je doen op SkillShare?</h5>
                        <ul>
                            <li>📚 Deel uitleg en samenvattingen</li>
                            <li>💬 Stel vragen en geef feedback</li>
                            <li>🤝 Help andere studenten</li>
                            <li>📝 Leer van bijdragen van anderen</li>
                        </ul>

                        <div class="mt-4">
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                <i class="fas fa-user-plus"></i> Word lid!
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
