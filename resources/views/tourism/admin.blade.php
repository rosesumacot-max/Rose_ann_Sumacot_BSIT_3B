@extends('tourism.layout')

@section('content')
<div class="min-h-screen bg-slate-50 text-slate-900 flex flex-col">

    {{-- TOP NAV --}}
    <nav class="sticky top-0 bg-white border-b border-slate-200 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-sky-600 flex items-center justify-center text-white shadow-sm">
                    <span class="text-xl font-black">≋</span>
                </div>
                <div>
                    <span class="font-bold text-slate-900 tracking-tight text-base block">HINUNANGAN PORTAL</span>
                    <span class="block text-[10px] uppercase font-bold tracking-wide text-slate-500">Tourism Satisfaction System</span>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2.5 bg-slate-50 border border-slate-300 px-3.5 py-1.5 rounded-xl">
                    <div class="w-7 h-7 rounded-full bg-sky-100 border border-sky-300 flex items-center justify-center text-sky-700 font-bold text-xs">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="hidden md:block leading-tight">
                        <p class="text-xs font-bold text-slate-800">{{ auth()->user()->name }}</p>
                        <p class="text-[9px] uppercase font-bold text-slate-500 tracking-wider">Admin</p>
                    </div>
                </div>

                <div class="hidden md:flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-wide">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                    Database Synced
                </div>

                <button onclick="location.reload()" class="w-9 h-9 rounded-lg border border-slate-300 flex items-center justify-center">⟳</button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="px-4 py-2 rounded-xl border border-red-200 text-slate-900 text-xs font-bold hover:bg-red-50">⇱ Sign Out</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full flex-1">

        {{-- ACCESS CARD --}}
        <div class="bg-white border border-slate-200 p-4 rounded-2xl shadow-sm mb-8">
            <span class="text-[10px] uppercase font-bold tracking-widest text-sky-600 block">
                AUTHENTICATED SECTOR ACCESS
            </span>
            <h3 class="font-extrabold text-slate-900 text-sm mt-1">
                👑 Executive Tourism Strategy Control Console
            </h3>
            <p class="text-xs text-slate-500 mt-2">
                Authorized as Administrator. You have permissions to configure metrics and run Gemini AI reports.
            </p>
        </div>

        {{-- HERO --}}
        <div class="relative overflow-hidden rounded-2xl bg-[#0f172a] text-white min-h-[170px] flex items-center mb-8">
            <div class="relative z-10 p-8 max-w-3xl">
                <div class="inline-flex px-3 py-1 rounded-full bg-white/10 text-white text-[10px] font-extrabold tracking-widest uppercase">
                    Tourism Management Desk
                </div>
                <h1 class="mt-5 text-3xl font-extrabold">Hinunangan Tourism Director</h1>
                <p class="mt-3 text-sm text-slate-300 max-w-3xl">
                    System manager console. Modify survey metrics, manage landmarks, audit feedback logs,
                    and trigger municipal strategic recommendations powered by Google Gemini.
                </p>
            </div>

            <button onclick="resetDatabase()" class="absolute right-8 top-16 px-5 py-3 rounded-xl bg-slate-800 border border-slate-700 text-rose-300 text-xs font-bold">
                ↻ Run DB Reset
            </button>

            <div class="absolute right-14 bottom-[-20px] text-[150px] text-white/5">⚙</div>
        </div>

        {{-- TABS --}}
        <div class="overflow-x-auto border-b border-slate-200 mb-8">
            <div class="flex gap-6 min-w-max text-sm font-bold text-slate-500">
                <button onclick="showAdminTab('dashboard')" id="tab-dashboard" class="admin-tab active-tab py-4 border-b-2 border-sky-600 text-sky-600">
                    📊 Dashboard & Statistics
                </button>
                <button onclick="showAdminTab('questions')" id="tab-questions" class="admin-tab py-4 border-b-2 border-transparent">
                    🙋 Survey Question Matrix
                </button>
                <button onclick="showAdminTab('destinations')" id="tab-destinations" class="admin-tab py-4 border-b-2 border-transparent">
                    📍 Destination Management
                </button>
                <button onclick="showAdminTab('responses')" id="tab-responses" class="admin-tab py-4 border-b-2 border-transparent">
                    📝 Submissions Database
                </button>
                <button onclick="showAdminTab('ai')" id="tab-ai" class="admin-tab py-4 border-b-2 border-transparent">
                    ✨ Gemini Strategic Advisor
                </button>
            </div>
        </div>

        {{-- DASHBOARD --}}
        <section id="dashboardTab">
            <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-sm mb-8 flex justify-between items-center">
                <div>
                    <h2 class="font-extrabold text-lg">⌖ Strategic Performance Dashboard</h2>
                    <p class="text-sm text-slate-500">Analyze satisfaction levels, travel patterns, and demographics.</p>
                </div>
                <select id="focusSpot" class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-bold">
                    <option value="">🗺️ All Destinations</option>
                </select>
            </div>

            <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-5 mb-8 flex justify-between items-center">
                <div class="flex gap-4 items-center">
                    <div class="w-11 h-11 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-700 text-xl">▣</div>
                    <div>
                        <h3 class="font-extrabold">AIVEN CLOUD MYSQL DATABASE CONNECTED
                            <span class="ml-2 px-2 py-1 rounded bg-emerald-600 text-white text-[10px]">CONNECTED MYSQL/AIVEN LIVE</span>
                        </h3>
                        <p class="text-sm text-slate-600">Live synchronization enabled. Data commits are being written securely.</p>
                    </div>
                </div>
                <span class="px-4 py-2 rounded-xl border border-slate-400 text-xs font-mono">● SSL: ENABLED</span>
            </div>

            <div class="grid md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <p class="text-xs font-bold text-slate-400 uppercase">Total Submissions</p>
                    <h2 id="statResp" class="text-4xl font-black mt-2">0</h2>
                    <p class="text-xs text-emerald-600 font-bold mt-2">✓ Live Active DB</p>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <p class="text-xs font-bold text-slate-400 uppercase">Cleanliness Index</p>
                    <h2 id="statClean" class="text-4xl font-black mt-2 text-emerald-600">0.0<span class="text-base text-slate-400">/5</span></h2>
                    <p class="text-xs text-slate-400 font-mono mt-2">Waste & preserves index</p>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <p class="text-xs font-bold text-slate-400 uppercase">Hospitality Score</p>
                    <h2 id="statHosp" class="text-4xl font-black mt-2 text-sky-600">0.0<span class="text-base text-slate-400">/5</span></h2>
                    <p class="text-xs text-slate-400 font-mono mt-2">Community assistance</p>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <p class="text-xs font-bold text-slate-400 uppercase">Safety Index</p>
                    <h2 id="statSafe" class="text-4xl font-black mt-2 text-sky-600">0.0<span class="text-base text-slate-400">/5</span></h2>
                    <p class="text-xs text-slate-400 font-mono mt-2">Assistance & rescue units</p>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <h2 class="text-xl font-extrabold mb-1">Attractions Feedback Breakdown</h2>
                    <p class="text-sm text-slate-500 mb-6">Comparing review counts and average tourist scores.</p>
                    <div id="destinationBreakdown" class="space-y-5"></div>
                </div>

                <div class="space-y-8">
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                        <h2 class="text-xl font-extrabold mb-6">◎ Visitor Origin Statistics</h2>
                        <div id="originStats" class="space-y-4"></div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                        <h2 class="text-xl font-extrabold mb-6">♙ Age Demographics</h2>
                        <div id="ageStats" class="grid grid-cols-2 gap-4"></div>
                    </div>
                </div>
            </div>
        </section>

        {{-- DESTINATIONS --}}
        <section id="destinationsTab" class="hidden bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
            <h2 class="text-2xl font-extrabold mb-4">Destination Management</h2>
            <form id="destinationForm" class="grid md:grid-cols-2 gap-4 mb-6">
                <input id="destName" class="rounded-xl border border-slate-200 px-4 py-3" placeholder="Destination Name" required>
                <select id="destCategory" class="rounded-xl border border-slate-200 px-4 py-3">
                    <option>Island</option><option>Beach</option><option>Spring</option><option>Heritage</option><option>Adventure</option>
                </select>
                <input id="destLocation" class="rounded-xl border border-slate-200 px-4 py-3" placeholder="Location" required>
                <textarea id="destDescription" class="rounded-xl border border-slate-200 px-4 py-3 md:col-span-2" placeholder="Description" required></textarea>
                <button class="bg-sky-600 text-white rounded-xl py-3 font-bold md:col-span-2">Add Destination</button>
            </form>
            <div id="destinationList" class="space-y-3"></div>
        </section>

        {{-- QUESTIONS --}}
        <section id="questionsTab" class="hidden bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
            <h2 class="text-2xl font-extrabold mb-4">Survey Question Matrix</h2>
            <form id="questionForm" class="grid md:grid-cols-3 gap-4 mb-6">
                <input id="questionText" class="rounded-xl border border-slate-200 px-4 py-3 md:col-span-3" placeholder="Question Text" required>
                <select id="questionCategory" class="rounded-xl border border-slate-200 px-4 py-3">
                    <option>Cleanliness</option><option>Hospitality</option><option>Safety</option><option>Accessibility</option><option>Attraction Quality</option><option>Accommodation</option>
                </select>
                <select id="questionType" class="rounded-xl border border-slate-200 px-4 py-3">
                    <option value="rating">Rating</option><option value="yes_no">Yes / No</option><option value="text">Text</option>
                </select>
                <button class="bg-sky-600 text-white rounded-xl py-3 font-bold">Add Question</button>
            </form>
            <div id="questionList" class="space-y-3"></div>
        </section>

        {{-- RESPONSES --}}
        <section id="responsesTab" class="hidden bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
            <h2 class="text-2xl font-extrabold mb-4">Submissions Database</h2>
            <div id="responsesList" class="space-y-4"></div>
        </section>

        {{-- AI --}}
        <section id="aiTab" class="hidden bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
            <h2 class="text-2xl font-extrabold mb-4">Gemini Strategic Advisor</h2>
            <button onclick="generateAiReport()" class="bg-sky-600 text-white rounded-xl px-6 py-3 font-bold">Generate AI Report</button>
            <div id="aiReportBox" class="mt-6 text-slate-700"></div>
        </section>
    </main>
</div>

<script>
let destinations = [], questions = [], responses = [];

async function loadAdminData() {
    destinations = await fetch('/api/destinations').then(r => r.json());
    questions = await fetch('/api/questions').then(r => r.json());
    responses = await fetch('/api/responses').then(r => r.json());

    statResp.innerText = responses.length;
    statClean.innerHTML = `${avgCategory('Cleanliness')}<span class="text-base text-slate-400">/5</span>`;
    statHosp.innerHTML = `${avgCategory('Hospitality')}<span class="text-base text-slate-400">/5</span>`;
    statSafe.innerHTML = `${avgCategory('Safety')}<span class="text-base text-slate-400">/5</span>`;

    focusSpot.innerHTML += destinations.map(d => `<option>${d.name}</option>`).join('');

    renderBreakdown();
    renderOriginStats();
    renderAgeStats();
    renderDestinations();
    renderQuestions();
    renderResponses();
}

function avgCategory(category) {
    const qs = questions.filter(q => q.category === category).map(q => String(q.id));
    let vals = [];
    responses.forEach(r => qs.forEach(id => {
        if (r.answers && !isNaN(Number(r.answers[id]))) vals.push(Number(r.answers[id]));
    }));
    return vals.length ? (vals.reduce((a,b)=>a+b,0)/vals.length).toFixed(1) : '0.0';
}

function renderBreakdown() {
    destinationBreakdown.innerHTML = destinations.map(d => {
        const rating = Number(d.average_rating ?? 0);
        const percent = Math.min((rating / 5) * 100, 100);
        return `
            <div>
                <div class="flex justify-between items-center font-bold">
                    <span>${d.name} <span class="ml-2 px-2 py-1 rounded bg-slate-100 text-slate-500 text-[10px] uppercase">${d.category}</span></span>
                    <span class="font-mono">${rating.toFixed(1)} / 5.0 (${d.total_reviews ?? 0} votes)</span>
                </div>
                <div class="mt-2 h-2 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-sky-500 rounded-full" style="width:${percent}%"></div>
                </div>
            </div>
        `;
    }).join('');
}

function renderOriginStats() {
    const counts = {};
    responses.forEach(r => counts[r.nationality] = (counts[r.nationality] || 0) + 1);
    const total = responses.length || 1;

    originStats.innerHTML = Object.entries(counts).map(([name,count]) => `
        <div>
            <div class="flex justify-between font-bold"><span>${name}</span><span>${count} (${Math.round(count/total*100)}%)</span></div>
            <div class="mt-2 h-2 bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-sky-500 rounded-full" style="width:${count/total*100}%"></div>
            </div>
        </div>
    `).join('');
}

function renderAgeStats() {
    const counts = {};
    responses.forEach(r => counts[r.age_group] = (counts[r.age_group] || 0) + 1);

    ageStats.innerHTML = Object.entries(counts).map(([age,count]) => `
        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
            <p class="text-xs font-bold text-slate-400 uppercase">${age}</p>
            <h3 class="text-2xl font-black mt-2">${count}</h3>
            <p class="text-xs text-slate-400">respondents</p>
        </div>
    `).join('');
}

function showAdminTab(tab) {
    ['dashboard','destinations','questions','responses','ai'].forEach(t => {
        document.getElementById(t + 'Tab').classList.toggle('hidden', t !== tab);
        const btn = document.getElementById('tab-' + t);
        btn.className = t === tab
            ? 'admin-tab py-4 border-b-2 border-sky-600 text-sky-600'
            : 'admin-tab py-4 border-b-2 border-transparent';
    });
}

function renderDestinations() {
    destinationList.innerHTML = destinations.map(d => `
        <div class="p-4 rounded-2xl border flex justify-between gap-4">
            <div><b>${d.name}</b><p class="text-sm text-slate-500">${d.category} • ${d.location}</p><p class="text-sm mt-1">${d.description}</p></div>
            <button onclick="deleteDestination(${d.id})" class="bg-red-500 text-white rounded-xl px-4 py-2">Delete</button>
        </div>
    `).join('');
}

function renderQuestions() {
    questionList.innerHTML = questions.map(q => `
        <div class="p-4 rounded-2xl border flex justify-between gap-4">
            <div><b>${q.text}</b><p class="text-sm text-slate-500">${q.category} • ${q.type}</p></div>
            <button onclick="deleteQuestion(${q.id})" class="bg-red-500 text-white rounded-xl px-4 py-2">Delete</button>
        </div>
    `).join('');
}

function renderResponses() {
    responsesList.innerHTML = responses.map(r => `
        <div class="p-5 rounded-2xl border">
            <b>${r.tourist_name}</b>
            <p class="text-sm text-slate-500">${r.nationality} • ${r.age_group}</p>
            <p class="text-sm text-slate-500">${r.destination?.name ?? 'Destination'}</p>
            <p class="font-bold text-amber-500 mt-2">⭐ ${r.overall_rating}</p>
            <p class="mt-3">${r.feedback_text ?? ''}</p>
        </div>
    `).join('');
}

destinationForm.addEventListener('submit', async e => {
    e.preventDefault();
    await fetch('/api/destinations', {
        method:'POST',
        headers:{'Content-Type':'application/json','Accept':'application/json'},
        body: JSON.stringify({name:destName.value, category:destCategory.value, location:destLocation.value, description:destDescription.value})
    });
    location.reload();
});

questionForm.addEventListener('submit', async e => {
    e.preventDefault();
    await fetch('/api/questions', {
        method:'POST',
        headers:{'Content-Type':'application/json','Accept':'application/json'},
        body: JSON.stringify({text:questionText.value, category:questionCategory.value, type:questionType.value})
    });
    location.reload();
});

async function deleteDestination(id) {
    if (!confirm('Delete this destination?')) return;
    await fetch('/api/destinations/' + id, {method:'DELETE'});
    location.reload();
}

async function deleteQuestion(id) {
    if (!confirm('Delete this question?')) return;
    await fetch('/api/questions/' + id, {method:'DELETE'});
    location.reload();
}

async function generateAiReport() {
    aiReportBox.innerHTML = `
        <div class="p-5 rounded-2xl bg-slate-50 text-slate-500 font-bold">
            Generating AI tourism report...
        </div>
    `;

    const res = await fetch('/api/generate-ai-report', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    if (!res.ok) {
        const text = await res.text();

        aiReportBox.innerHTML = `
            <div class="p-5 rounded-2xl bg-red-50 text-red-700 font-bold">
                Failed to generate report. Status: ${res.status}
                <pre class="mt-3 text-xs whitespace-pre-wrap">${text}</pre>
            </div>
        `;

        return;
    }

    const data = await res.json();
    const report = data.report;

    aiReportBox.innerHTML = `
        <div class="p-5 rounded-2xl bg-sky-50 border border-sky-200">
            <h3 class="font-extrabold text-lg text-slate-900">${report.overallSatisfaction}</h3>

            <h4 class="font-bold mt-4 text-slate-900">Strategic Recommendations</h4>

            <ul class="list-disc pl-6 mt-2 text-slate-700">
                ${report.strategicRecommendations.map(i => `<li>${i}</li>`).join('')}
            </ul>
        </div>
    `;
}

async function resetDatabase() {
    if (!confirm('Reset all survey responses and reports?')) return;

    await fetch('/api/reset-db', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    location.reload();
}

loadAdminData();
</script>
@endsection