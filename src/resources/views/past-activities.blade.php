@extends('layout', ['no-footer' => true])

@section('content')
<section class="parque page activities-page">
    <div class="container">
        <div class="content">
            <h1>Actividades pasadas</h1>
            <main>
                <div id="activities" class="past">
                </div>
                <div id="loader">Loading</div>
            </main>
        </div>
    </div>
    <script src="/js/library.js"></script>
    <script src="/js/past-activities.js"></script>
</section>
@endsection

