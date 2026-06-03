@extends('tourism.layout')

@section('content')
<div class="min-h-screen bg-slate-50 text-slate-900">
    <header class="h-20 bg-white/80 backdrop-blur border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-sky-600 text-white flex items-center justify-center text-2xl shadow-lg">≋</div>
                <div>
                    <h1 class="font-extrabold text-xl">HINUNANGAN PORTAL</h1>
                    <p class="text-[10px] uppercase tracking-[.25em] text-slate-400 font-bold">Satisfaction & Policy Module</p>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-2 bg-slate-100 rounded-full px-4 py-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <span class="w-2 h-2 bg-emerald-300 rounded-full"></span>
                Secure Entry Gateway
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-6 py-14 grid lg:grid-cols-2 gap-12 items-start">
        <section>
            <p class="text-sky-600 font-mono text-xs uppercase tracking-[.35em] font-bold mb-5">
                ✣ Southern Leyte Eco-Sanctuaries
            </p>

            <h2 class="text-5xl font-extrabold leading-tight tracking-tight">
                Empowering Hinunangan Tourism through Real Feedback.
            </h2>

            <p class="mt-5 text-lg text-slate-500 leading-relaxed">
                Welcome to the Tourist Satisfaction Survey & Smart Policy System.
                We gather genuine guest experiences to optimize beautiful spots like
                San Pedro, San Pablo islets, and local reserves.
            </p>

            <div class="mt-8 rounded-2xl overflow-hidden border border-slate-200 bg-white shadow-sm">
                <img src="{{ asset('images/hinunangan_paradise_1779325004774.png') }}"
                     class="w-full h-56 object-cover"
                     alt="Beautiful Twin Islands of Hinunangan, Southern Leyte">

                <div class="p-4">
                    <span class="inline-flex px-3 py-1 rounded-full bg-slate-800 text-white text-[10px] font-mono uppercase tracking-widest">
                        📍 San Pedro & San Pablo Islets
                    </span>
                    <p class="mt-4 text-sm text-slate-500 leading-relaxed">
                        Hinunangan's pristine gem islets feature calm, shallow crystal channels,
                        coconut-fringed shorelines, and peaceful outrigger fishing canoes.
                    </p>
                </div>
            </div>

            <div class="mt-6 space-y-4">
                <div class="bg-white border border-slate-200 rounded-2xl p-5 flex gap-4 shadow-sm">
                    <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center text-xl">◎</div>
                    <div>
                        <h3 class="font-bold">For Travelers</h3>
                        <p class="text-sm text-slate-500">Log in to safely upload your rating inputs, cleanliness reports, and local recommendations.</p>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-2xl p-5 flex gap-4 shadow-sm">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">⚿</div>
                    <div>
                        <h3 class="font-bold">For Officers & Admin</h3>
                        <p class="text-sm text-slate-500">Verify satisfaction settings, manage survey questions, and synthesize actions with reports.</p>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="bg-white border border-slate-200 rounded-3xl shadow-xl overflow-hidden">
                <div class="grid grid-cols-2 bg-slate-50 p-1">
                    <button type="button" onclick="showTab('tourist')" id="touristBtn"
                            class="py-3 rounded-2xl bg-white shadow-sm text-sky-700 font-bold">
                        ♙ Tourist Portal
                    </button>

                    <button type="button" onclick="showTab('official')" id="officialBtn"
                            class="py-3 rounded-2xl text-slate-500 font-bold">
                        🔑 Official Personnel
                    </button>
                </div>

                <div class="p-8">
                    @if(session('error'))
                        <div class="mb-5 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form id="touristForm" method="POST" action="{{ route('tourist.login') }}" class="space-y-5">
                        @csrf

                        <div class="text-center mb-6">
                            <h2 class="text-2xl font-extrabold">Traveler Satisfaction survey</h2>
                            <p class="text-sm text-slate-400 mt-2">Help Southern Leyte perfect its local eco-destinations.</p>
                        </div>

                        <div>
                            <label class="block text-xs font-extrabold uppercase mb-2">Full Name / Screen Name</label>
                            <input name="name" value="Explorer" required class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 font-semibold focus:outline-none focus:ring-2 focus:ring-sky-500">
                        </div>

                        <div>
                            <label class="block text-xs font-extrabold uppercase mb-2">Email Address Optional</label>
                            <input name="email" type="email" placeholder="e.g. john@travels.com" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 font-semibold focus:outline-none focus:ring-2 focus:ring-sky-500">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-extrabold uppercase mb-2">Nationality</label>
                                <select name="nationality" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 font-semibold">
                                    <option>Philippines</option>
                                    <option>Japan</option>
                                    <option>Australia</option>
                                    <option>USA</option>
                                    <option>Germany</option>
                                    <option>South Korea</option>
                                    <option>Other</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-extrabold uppercase mb-2">Age Bracket</label>
                                <select name="age_group" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 font-semibold">
                                    <option>Under 18</option>
                                    <option>18-24 yrs</option>
                                    <option selected>25-34 yrs</option>
                                    <option>35-44 yrs</option>
                                    <option>45-54 yrs</option>
                                    <option>55+ yrs</option>
                                </select>
                            </div>
                        </div>

                        <button class="w-full bg-sky-600 hover:bg-sky-700 text-white rounded-xl py-3 font-extrabold shadow-lg">
                            ◎ Enter Tourist survey
                        </button>
                    </form>

                    <form id="officialForm" method="POST" action="{{ route('login') }}" class="space-y-5 hidden">
                        @csrf

                        <div class="text-center mb-6">
                            <h2 class="text-2xl font-extrabold">Official Access</h2>
                            <p class="text-sm text-slate-400 mt-2">Login as staff or administrator.</p>
                        </div>

                        <div>
                            <label class="block text-xs font-extrabold uppercase mb-2">Role</label>
                            <select name="role" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 font-semibold">
                                <option>Staff</option>
                                <option>Admin</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-extrabold uppercase mb-2">Username</label>
                            <input name="username" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 font-semibold" required>
                        </div>

                        <div>
                            <label class="block text-xs font-extrabold uppercase mb-2">Password</label>
                            <input name="password" type="password" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 font-semibold" required>
                        </div>

                        <button class="w-full bg-slate-900 hover:bg-slate-800 text-white rounded-xl py-3 font-extrabold shadow-lg">
                            Login Official Account
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-6 bg-amber-50 border border-amber-200 rounded-2xl p-5 text-sm">
                <div class="flex justify-between">
                    <h3 class="font-mono font-bold uppercase tracking-widest text-amber-700">ⓘ Sandbox Access Credentials</h3>
                    <button onclick="this.closest('div.mt-6').remove()" class="text-amber-700 underline">Dismiss</button>
                </div>

                <p class="mt-3">Use the quick credentials below to examine director charts, logs, and simulated forms instantly:</p>

                <div class="mt-4 flex flex-wrap gap-3">
                    <span class="px-4 py-2 bg-amber-100 rounded-lg font-mono text-xs font-bold">👥 Staff: staff / staff123</span>
                    <span class="px-4 py-2 bg-amber-100 rounded-lg font-mono text-xs font-bold">🔑 Admin: admin / admin123</span>
                </div>
            </div>
        </section>
    </main>

    <footer class="text-center text-[11px] uppercase tracking-[.3em] text-slate-400 font-mono py-6">
        Hinunangan Office of Tourism & Eco-Management • Southern Leyte Government
    </footer>
</div>

<script>
function showTab(tab) {
    document.getElementById('touristForm').classList.toggle('hidden', tab !== 'tourist');
    document.getElementById('officialForm').classList.toggle('hidden', tab !== 'official');

    document.getElementById('touristBtn').className = tab === 'tourist'
        ? 'py-3 rounded-2xl bg-white shadow-sm text-sky-700 font-bold'
        : 'py-3 rounded-2xl text-slate-500 font-bold';

    document.getElementById('officialBtn').className = tab === 'official'
        ? 'py-3 rounded-2xl bg-white shadow-sm text-sky-700 font-bold'
        : 'py-3 rounded-2xl text-slate-500 font-bold';
}
</script>
@endsection