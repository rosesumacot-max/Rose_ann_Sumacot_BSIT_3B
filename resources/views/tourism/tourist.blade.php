@extends('tourism.layout')

@section('content')
<div class="min-h-screen bg-slate-50 text-slate-800 flex flex-col justify-between">

    {{-- TOP NAV --}}
    <nav class="sticky top-0 bg-white border-b border-slate-200 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">

            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-sky-600 flex items-center justify-center text-white shadow-sm">
                    <span class="text-xl font-black">≋</span>
                </div>

                <div class="text-left">
                    <span class="font-bold text-slate-900 tracking-tight text-base block">
                        HINUNANGAN PORTAL
                    </span>

                    <span class="block text-[10px] uppercase font-bold tracking-wide text-slate-500">
                        Tourism Satisfaction System
                    </span>
                </div>
            </div>

            <div class="flex items-center gap-4">

                <div class="flex items-center gap-2.5 bg-slate-50 border border-slate-300 px-3.5 py-1.5 rounded-xl text-left">
                    <div class="w-7 h-7 rounded-full bg-sky-100 border border-sky-300 flex items-center justify-center text-sky-700 font-bold text-xs">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div class="hidden md:block leading-tight">
                        <p class="text-xs font-bold text-slate-800">
                            {{ auth()->user()->name }}
                        </p>

                        <div class="flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                            <p class="text-[9px] uppercase font-bold text-slate-500 tracking-wider">
                                Tourist ({{ auth()->user()->nationality ?? 'Philippines' }})
                            </p>
                        </div>
                    </div>
                </div>

                <div class="hidden md:flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-wide">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                    Database Synced
                </div>

                <button onclick="location.reload()"
                        class="w-9 h-9 rounded-lg border border-slate-300 flex items-center justify-center text-slate-700 hover:bg-slate-100 transition">
                    ⟳
                </button>

                <div class="h-8 w-px bg-slate-200 hidden md:block"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button class="px-4 py-2 rounded-xl border border-red-200 text-slate-900 text-xs font-bold hover:bg-red-50 transition">
                        ⇱ Sign Out
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- AUTHENTICATED ACCESS CARD --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 w-full text-left">
        <div class="bg-white border border-slate-200 p-4 rounded-2xl flex items-center justify-between gap-4 shadow-sm">
            <div class="space-y-1">
                <span class="text-[10px] uppercase font-bold tracking-widest text-sky-600 block">
                    AUTHENTICATED SECTOR ACCESS
                </span>

                <h3 class="font-extrabold text-slate-900 text-sm">
                    🗺️ Traveler Satisfaction Survey Questionnaire
                </h3>

                <p class="text-xs text-slate-500 font-medium leading-relaxed">
                    Welcome to beautiful Southern Leyte, {{ auth()->user()->name }}!
                    Fill out the questionnaires to aid our municipality.
                </p>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full flex-1">

        {{-- HERO --}}
        <div class="relative overflow-hidden rounded-2xl bg-[#073b59] text-white min-h-[300px] flex items-center mb-10">

            <img src="{{ asset('images/hinunangan_paradise_1779325004774.png') }}"
                 class="absolute inset-0 w-full h-full object-cover opacity-10"
                 alt="Hinunangan twins island panorama">

            <div class="relative z-10 p-8 md:p-10 max-w-3xl">

                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-sky-300 bg-sky-900/30 text-[10px] font-extrabold tracking-widest uppercase text-sky-100">
                    🌞 Southern Leyte Eco-Sanctuary • Visitor Feedback
                </div>

                <h1 class="mt-5 text-4xl md:text-6xl font-extrabold tracking-tight leading-tight">
                    Hinunangan Eco-Tourism Survey
                </h1>

                <p class="mt-5 text-sky-100/80 text-base md:text-lg leading-relaxed font-medium">
                    Your honest feedback enables the Southern Leyte Tourism Office to protect
                    our marine sanctuaries, elevate hospitality services, and preserve the natural allure
                    of our twin islands.
                </p>

                <div class="flex gap-2 mt-8">
                    <span class="w-2 h-2 bg-slate-500 rounded-full"></span>
                    <span class="w-2 h-2 bg-slate-500 rounded-full"></span>
                    <span class="w-8 h-2 bg-sky-400 rounded-full"></span>
                    <span class="w-2 h-2 bg-slate-500 rounded-full"></span>
                </div>
            </div>

            <div class="absolute right-12 top-12 w-40 h-40 rounded-full border-[14px] border-white/10 hidden lg:flex items-center justify-center">
                <div class="text-7xl text-white/10">◇</div>
            </div>
        </div>

        {{-- DESTINATIONS --}}
        <section id="destinationStep" class="space-y-8">

            <div class="text-center max-w-xl mx-auto">
                <h2 class="text-4xl font-extrabold text-slate-900">
                    Which site did you explore?
                </h2>

                <p class="mt-3 text-slate-500 text-sm">
                    Select the Hinunangan destination you recently visited to deliver targeted feedback.
                </p>
            </div>

            <div id="destinationsGrid"
                 class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
            </div>

            <div class="text-center pt-2">
                <button onclick="window.history.back()"
                        class="px-8 py-3 rounded-xl border border-slate-700 text-slate-700 text-sm font-medium hover:bg-white transition">
                    ← Edit Profile Details
                </button>
            </div>
        </section>

        {{-- SURVEY STEP --}}
        <section id="surveyStep" class="hidden">
            <div class="max-w-3xl mx-auto bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="p-6 bg-slate-50 border-b border-slate-200 flex items-start justify-between">

                    <div class="flex gap-4">
                        <div class="w-14 h-14 rounded-xl bg-sky-600 text-white flex items-center justify-center text-3xl shadow-sm">
                            ⚓
                        </div>

                        <div>
                            <span id="selectedCategory"
                                  class="text-[10px] uppercase font-black tracking-widest text-sky-700">
                            </span>

                            <h2 id="selectedTitle"
                                class="text-2xl font-extrabold text-slate-900 mt-1">
                            </h2>

                            <p id="selectedLocation"
                               class="text-xs text-slate-500 mt-1">
                            </p>
                        </div>
                    </div>

                    <div class="hidden sm:block bg-white px-3 py-2 rounded-lg text-xs font-semibold text-slate-600">
                        Respondent:
                        <b class="text-slate-900">
                            {{ auth()->user()->name }}
                        </b>
                    </div>
                </div>

                <div class="p-6 space-y-6">

                    <div class="bg-sky-50 border border-sky-300 text-sky-700 rounded-xl p-4 text-xs font-medium">
                        ✨ Your review takes less than 60 seconds. Simply answer the standard metrics below and press submit.
                    </div>

                    <div id="questionsBox" class="space-y-6"></div>

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-slate-700">
                            💬 Overall Experience Statement
                        </label>

                        <textarea id="generalFeedback"
                                  rows="4"
                                  placeholder="Share any special highlight, local memory, or quick message about people or food."
                                  class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 text-slate-800 placeholder-slate-400 text-sm"></textarea>
                    </div>

                    <div class="flex gap-3 pt-4 border-t border-slate-300">

                        <button type="button"
                                onclick="backToSites()"
                                class="flex-1 py-3 border border-slate-200 text-slate-600 font-semibold rounded-xl hover:bg-slate-50 transition-all text-sm">
                            ← Back to Sites
                        </button>

                        <button type="button"
                                onclick="submitSurvey()"
                                class="flex-1 py-3 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-xl transition-all shadow-sm hover:shadow flex items-center justify-center gap-2 text-sm">
                            Submit Satisfaction Survey ✈
                        </button>
                    </div>
                </div>
            </div>
        </section>

        {{-- SUCCESS --}}
        <section id="successStep" class="hidden">
            <div class="max-w-xl mx-auto bg-white rounded-2xl border border-slate-200 p-8 shadow-sm text-center space-y-6">

                <div class="w-16 h-16 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto text-3xl font-black">
                    ✓
                </div>

                <div class="space-y-2">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full">
                        Feedback Locked In
                    </span>

                    <h2 class="text-3xl font-extrabold text-slate-900">
                        Salamat Kaayo, {{ auth()->user()->name }}!
                    </h2>

                    <p class="text-slate-500 text-sm leading-relaxed max-w-sm mx-auto font-medium">
                        Your evaluation is saved inside the Hinunangan Municipal Tourism Office system.
                    </p>
                </div>

                <button onclick="location.reload()"
                        class="px-6 py-3 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-xl shadow-sm text-sm">
                    Submit Another Site Survey
                </button>
            </div>
        </section>
    </main>

    {{-- FOOTER --}}
    <footer class="bg-white border-t border-slate-200 mt-12 py-5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs font-medium text-slate-500">

            <div class="flex items-center gap-4">
                <div class="flex items-center gap-1.5">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                    <span class="font-semibold text-slate-700">
                        System Operational
                    </span>
                </div>

                <span class="text-slate-300 hidden sm:inline">|</span>

                <span class="text-slate-400 italic font-normal">
                    Hinunangan, Southern Leyte Philippines
                </span>
            </div>

            <div class="flex items-center gap-3 text-slate-400 text-[11px] font-mono">
                <span>Survey Engine v2.4.1</span>

                <span class="bg-slate-100 text-slate-600 px-2.5 py-0.5 rounded-md font-medium">
                    Build 0524
                </span>
            </div>
        </div>
    </footer>
</div>

<script>
let destinations = [];
let questions = [];
let selectedDestination = null;
let answers = {};

async function loadTouristData() {
    destinations = await fetch('/api/destinations').then(r => r.json());
    questions = await fetch('/api/questions').then(r => r.json());

    renderDestinations();
}

function getRating(d) {
    return d.average_rating ?? d.averageRating ?? 0;
}

function categoryPill(category) {
    if (category === 'Island') return 'bg-sky-50 text-sky-700 border border-sky-100';
    if (category === 'Beach') return 'bg-amber-50 text-amber-700 border border-amber-100';
    if (category === 'Spring') return 'bg-cyan-50 text-cyan-700 border border-cyan-100';
    return 'bg-purple-50 text-purple-700 border border-purple-100';
}

function renderDestinations() {
    const grid = document.getElementById('destinationsGrid');

    grid.innerHTML = destinations.map(dest => `
        <div onclick="selectDestination(${dest.id})"
             class="bg-white rounded-3xl border border-slate-200 p-7 shadow-sm hover:shadow-xl hover:border-sky-400 transition-all duration-300 cursor-pointer flex flex-col justify-between group min-h-[260px]">

            <div>
                <div class="flex items-start justify-between">

                    <span class="px-3 py-1 text-[11px] font-bold rounded-full ${categoryPill(dest.category)}">
                        ${dest.category}
                    </span>

                    <div class="flex items-center gap-1 bg-amber-50 px-3 py-1 rounded-lg text-amber-700 text-sm font-bold">
                        ★ ${getRating(dest)}
                    </div>
                </div>

                <h3 class="font-extrabold text-slate-900 text-2xl mt-6 group-hover:text-sky-600 transition-colors">
                    ${dest.name}
                </h3>

                <p class="text-slate-500 text-sm leading-relaxed mt-5 line-clamp-3">
                    ${dest.description}
                </p>
            </div>

            <div class="pt-5 mt-5 border-t border-slate-100 flex items-center justify-between text-sm">
                <span class="text-slate-400 font-medium">
                    ⌖ ${dest.location}
                </span>

                <span class="text-sky-600 font-bold group-hover:translate-x-1 transition-transform">
                    Survey ›
                </span>
            </div>
        </div>
    `).join('');
}

function selectDestination(id) {
    selectedDestination = destinations.find(d => Number(d.id) === Number(id));
    answers = {};

    document.getElementById('destinationStep').classList.add('hidden');
    document.getElementById('surveyStep').classList.remove('hidden');

    document.getElementById('selectedTitle').innerText = selectedDestination.name;
    document.getElementById('selectedLocation').innerText = '⌖ ' + selectedDestination.location;
    document.getElementById('selectedCategory').innerText = selectedDestination.category + ' Assessment';

    renderQuestions();

    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function renderQuestions() {
    const box = document.getElementById('questionsBox');
    box.innerHTML = '';

    const activeQuestions = questions.filter(q => q.is_active || q.isActive);

    activeQuestions.forEach((q, index) => {

        if (q.type === 'rating') {

            answers[q.id] = 5;

            box.innerHTML += `
                <div class="survey-border rounded-2xl p-6 bg-white">
                    <div class="flex gap-4">

                        <div class="w-9 h-9 rounded-lg bg-sky-100 text-sky-700 flex items-center justify-center text-sm font-extrabold shrink-0">
                            ${index + 1}
                        </div>

                        <div class="flex-1">
                            <div class="text-[10px] uppercase font-extrabold tracking-widest text-slate-400">
                                ${q.category}
                            </div>

                            <h4 class="font-bold text-slate-900 text-lg leading-relaxed mt-2">
                                ${q.text}
                            </h4>

                            <div class="flex items-center gap-4 mt-6">
                                <div id="stars-${q.id}" class="flex gap-2">
                                    ${[1,2,3,4,5].map(n => `
                                        <button type="button"
                                                onclick="setRating(${q.id}, ${n})"
                                                class="star-btn">
                                            ★
                                        </button>
                                    `).join('')}
                                </div>

                                <span id="label-${q.id}"
                                      class="px-3 py-1.5 bg-sky-50 text-sky-700 rounded-lg text-xs font-bold">
                                    Excellent
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        if (q.type === 'yes_no') {

            answers[q.id] = true;

            box.innerHTML += `
                <div class="survey-border rounded-2xl p-6 bg-white">
                    <div class="flex gap-4">

                        <div class="w-9 h-9 rounded-lg bg-sky-100 text-sky-700 flex items-center justify-center text-sm font-extrabold shrink-0">
                            ${index + 1}
                        </div>

                        <div class="flex-1">
                            <div class="text-[10px] uppercase font-extrabold tracking-widest text-slate-400">
                                ${q.category}
                            </div>

                            <h4 class="font-bold text-slate-900 text-lg leading-relaxed mt-2">
                                ${q.text}
                            </h4>

                            <div class="flex gap-3 mt-6">
                                <button type="button"
                                        id="yes-${q.id}"
                                        onclick="setYesNo(${q.id}, true)"
                                        class="px-6 py-2.5 bg-sky-600 text-white rounded-xl text-sm font-bold shadow-sm">
                                    Yes, absolutely
                                </button>

                                <button type="button"
                                        id="no-${q.id}"
                                        onclick="setYesNo(${q.id}, false)"
                                        class="px-6 py-2.5 bg-white text-slate-700 border border-slate-200 rounded-xl text-sm font-bold">
                                    No, not really
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        if (q.type === 'text') {

            answers[q.id] = '';

            box.innerHTML += `
                <div class="survey-border rounded-2xl p-6 bg-white">
                    <div class="flex gap-4">

                        <div class="w-9 h-9 rounded-lg bg-sky-100 text-sky-700 flex items-center justify-center text-sm font-extrabold shrink-0">
                            ${index + 1}
                        </div>

                        <div class="flex-1">
                            <div class="text-[10px] uppercase font-extrabold tracking-widest text-slate-400">
                                ${q.category}
                            </div>

                            <h4 class="font-bold text-slate-900 text-lg leading-relaxed mt-2">
                                ${q.text}
                            </h4>

                            <input type="text"
                                   placeholder="Type details (optional)..."
                                   oninput="answers[${q.id}] = this.value"
                                   class="w-full mt-6 px-4 py-3 rounded-xl border border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500 text-sm">
                        </div>
                    </div>
                </div>
            `;
        }
    });
}

function setRating(qid, rating) {
    answers[qid] = rating;

    const stars = document.querySelectorAll(`#stars-${qid} .star-btn`);

    stars.forEach((star, i) => {
        star.classList.toggle('off', i >= rating);
    });

    const label = document.getElementById(`label-${qid}`);

    label.innerText =
        rating >= 5 ? 'Excellent' :
        rating === 4 ? 'Very Good' :
        rating === 3 ? 'Good' :
        rating === 2 ? 'Fair' : 'Poor';
}

function setYesNo(qid, value) {

    answers[qid] = value;

    const yes = document.getElementById(`yes-${qid}`);
    const no = document.getElementById(`no-${qid}`);

    if (value) {
        yes.className = 'px-6 py-2.5 bg-sky-600 text-white rounded-xl text-sm font-bold shadow-sm';
        no.className = 'px-6 py-2.5 bg-white text-slate-700 border border-slate-200 rounded-xl text-sm font-bold';
    } else {
        yes.className = 'px-6 py-2.5 bg-white text-slate-700 border border-slate-200 rounded-xl text-sm font-bold';
        no.className = 'px-6 py-2.5 bg-slate-900 text-white rounded-xl text-sm font-bold shadow-sm';
    }
}

function backToSites() {
    document.getElementById('surveyStep').classList.add('hidden');
    document.getElementById('destinationStep').classList.remove('hidden');

    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

async function submitSurvey() {

    const feedback = document.getElementById('generalFeedback').value;

    const res = await fetch('/api/responses', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            tourist_name: @json(auth()->user()->name),
            tourist_email: @json(auth()->user()->email),
            nationality: @json(auth()->user()->nationality ?? 'Philippines'),
            age_group: @json(auth()->user()->age_group ?? '25-34'),
            destination_id: selectedDestination.id,
            answers: answers,
            feedback_text: feedback,
            encoded_by: 'self'
        })
    });

    if (res.ok) {

        document.getElementById('surveyStep').classList.add('hidden');
        document.getElementById('successStep').classList.remove('hidden');

        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });

    } else {

        alert('Failed to submit survey.');
    }
}

loadTouristData();
</script>
@endsection