@extends('tourism.layout')

@section('content')
<div class="min-h-screen">
    <header class="bg-white border-b sticky top-0 z-20">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-xl font-extrabold text-sky-700">📝 Staff Dashboard</h1>
                <p class="text-sm text-slate-500">Encode walk-in tourist survey responses</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn bg-slate-100">Logout</button>
            </form>
        </div>
    </header>

    <main class="max-w-7xl mx-auto p-6 grid lg:grid-cols-3 gap-6">
        <section class="lg:col-span-2 card p-6">
            <h2 class="text-2xl font-extrabold mb-4">Encode Tourist Response</h2>

            <form id="staffForm" class="space-y-4">
                <input id="touristName" class="input" placeholder="Tourist Name" required>
                <input id="touristEmail" class="input" placeholder="Email Optional">

                <select id="nationality" class="input">
                    <option>Philippines</option>
                    <option>Japan</option>
                    <option>Australia</option>
                    <option>USA</option>
                    <option>Other</option>
                </select>

                <select id="ageGroup" class="input">
                    <option>Under 18</option>
                    <option>18-24</option>
                    <option selected>25-34</option>
                    <option>35-44</option>
                    <option>45-54</option>
                    <option>55+</option>
                </select>

                <select id="destinationId" class="input" required></select>

                <div id="questionsBox" class="space-y-4"></div>

                <button type="submit" class="btn btn-primary w-full">Save Survey Response</button>
            </form>
        </section>

        <aside class="card p-6">
            <h2 class="text-xl font-extrabold mb-4">Recent Responses</h2>
            <div id="recentResponses" class="space-y-3"></div>
        </aside>
    </main>
</div>

<script>
let questions = [];
let answers = {};

async function loadStaffData() {
    const destinations = await fetch('/api/destinations').then(r => r.json());
    questions = await fetch('/api/questions').then(r => r.json());
    const responses = await fetch('/api/responses').then(r => r.json());

    document.getElementById('destinationId').innerHTML = destinations.map(d =>
        `<option value="${d.id}">${d.name}</option>`
    ).join('');

    renderQuestions();

    document.getElementById('recentResponses').innerHTML = responses.slice(0, 6).map(r => `
        <div class="p-3 rounded-xl bg-slate-50">
            <b>${r.tourist_name}</b>
            <p class="text-sm text-slate-500">${r.destination?.name ?? 'Destination'} • ⭐ ${r.overall_rating}</p>
        </div>
    `).join('');
}

function renderQuestions() {
    const box = document.getElementById('questionsBox');
    box.innerHTML = '';
    answers = {};

    questions.filter(q => q.is_active).forEach(q => {
        if (q.type === 'rating') {
            answers[q.id] = 5;
            box.innerHTML += `
                <div class="border rounded-2xl p-4">
                    <label class="font-bold">${q.text}</label>
                    <select class="input mt-2" onchange="answers[${q.id}] = Number(this.value)">
                        <option value="5">5 - Excellent</option>
                        <option value="4">4 - Very Good</option>
                        <option value="3">3 - Good</option>
                        <option value="2">2 - Fair</option>
                        <option value="1">1 - Poor</option>
                    </select>
                </div>
            `;
        }

        if (q.type === 'yes_no') {
            answers[q.id] = true;
            box.innerHTML += `
                <div class="border rounded-2xl p-4">
                    <label class="font-bold">${q.text}</label>
                    <select class="input mt-2" onchange="answers[${q.id}] = this.value === 'yes'">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
            `;
        }

        if (q.type === 'text') {
            answers[q.id] = '';
            box.innerHTML += `
                <div class="border rounded-2xl p-4">
                    <label class="font-bold">${q.text}</label>
                    <textarea class="input mt-2" rows="3" onchange="answers[${q.id}] = this.value"></textarea>
                </div>
            `;
        }
    });
}

document.getElementById('staffForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const res = await fetch('/api/responses', {
        method: 'POST',
        headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
        body: JSON.stringify({
            tourist_name: touristName.value,
            tourist_email: touristEmail.value,
            nationality: nationality.value,
            age_group: ageGroup.value,
            destination_id: destinationId.value,
            answers: answers,
            feedback_text: Object.values(answers).filter(v => typeof v === 'string').join(' '),
            encoded_by: 'Staff Assist: {{ auth()->user()->name }}'
        })
    });

    if (res.ok) {
        alert('Survey response saved successfully.');
        location.reload();
    } else {
        alert('Failed to save response.');
    }
});

loadStaffData();
</script>
@endsection