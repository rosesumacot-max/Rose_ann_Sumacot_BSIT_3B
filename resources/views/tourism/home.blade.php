@extends('tourism.layout')

@section('content')
<div class="min-h-screen hero-bg text-white">

    {{-- NAVBAR --}}
    <nav class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">

        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center text-2xl shadow-lg border border-white/20">
                🌊
            </div>

            <div>
                <h1 class="font-extrabold text-2xl tracking-tight">
                    Hinunangan Tourism
                </h1>

                <p class="text-xs text-white/80 font-medium">
                    Tourist Experience Satisfaction Survey
                </p>
            </div>
        </div>

        <div class="flex gap-4 items-center">
            <a href="{{ route('login') }}"
               class="px-5 py-2.5 rounded-2xl bg-white text-sky-700 font-extrabold shadow-xl hover:bg-sky-50 transition-all duration-200">
                Start Survey
            </a>

            <a href="{{ route('login') }}"
               class="px-5 py-2.5 rounded-2xl border border-white/50 text-white font-bold hover:bg-white/10 transition-all duration-200">
                Official Login
            </a>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="max-w-7xl mx-auto px-6 pt-24 pb-20">

        <div class="max-w-4xl">

            <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white/20 backdrop-blur-xl border border-white/20 mb-8 shadow-lg">
                <span>🌴</span>
                <span class="font-semibold text-white">
                    Discover San Pablo, San Pedro, Tahusan & More
                </span>
            </div>

            <h1 class="text-6xl md:text-7xl font-extrabold leading-[0.95] tracking-tight drop-shadow-lg">
                Hinunangan Tourist
                <br>
                Experience Survey
                <br>
                System
            </h1>

            <p class="mt-8 text-xl text-white/90 leading-relaxed max-w-3xl font-medium">
                A multi-role tourism survey platform for tourists, staff, and administrators.
                Collect feedback, rate destinations, manage survey questions,
                and generate tourism analytics reports.
            </p>

            <div class="mt-10 flex gap-4 flex-wrap">
                <a href="{{ route('login') }}"
                   class="px-7 py-3 rounded-2xl bg-white text-sky-700 font-extrabold shadow-2xl hover:bg-sky-50 transition-all duration-200">
                    Start Survey
                </a>

                <a href="{{ route('login') }}"
                   class="px-7 py-3 rounded-2xl border border-white/50 text-white font-bold hover:bg-white/10 backdrop-blur-md transition-all duration-200">
                    Official Login
                </a>
            </div>
        </div>
    </section>

    {{-- FEATURE CARDS --}}
    <section class="max-w-7xl mx-auto px-6 pb-24 grid md:grid-cols-3 gap-8">

        {{-- Tourist --}}
        <div class="bg-white/15 backdrop-blur-2xl rounded-3xl p-8 border border-white/20 shadow-2xl hover:translate-y-[-5px] transition-all duration-300">
            <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center text-4xl mb-6 shadow-lg">
                🧭
            </div>

            <h3 class="font-extrabold text-3xl text-white">
                Tourist Panel
            </h3>

            <p class="text-white/80 mt-4 text-lg leading-relaxed">
                Select destinations and submit real tourist satisfaction feedback.
            </p>
        </div>

        {{-- Staff --}}
        <div class="bg-white/15 backdrop-blur-2xl rounded-3xl p-8 border border-white/20 shadow-2xl hover:translate-y-[-5px] transition-all duration-300">
            <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center text-4xl mb-6 shadow-lg">
                📝
            </div>

            <h3 class="font-extrabold text-3xl text-white">
                Staff Panel
            </h3>

            <p class="text-white/80 mt-4 text-lg leading-relaxed">
                Encode walk-in tourist responses and monitor submissions.
            </p>
        </div>

        {{-- Admin --}}
        <div class="bg-white/15 backdrop-blur-2xl rounded-3xl p-8 border border-white/20 shadow-2xl hover:translate-y-[-5px] transition-all duration-300">
            <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center text-4xl mb-6 shadow-lg">
                📊
            </div>

            <h3 class="font-extrabold text-3xl text-white">
                Admin Dashboard
            </h3>

            <p class="text-white/80 mt-4 text-lg leading-relaxed">
                Manage destinations, survey questions, analytics, and reports.
            </p>
        </div>

    </section>
</div>
@endsection