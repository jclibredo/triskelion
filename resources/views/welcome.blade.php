<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tau Gamma Phi & Tau Gamma Sigma | Triskelion Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>

<body class="antialiased selection:bg-yellow-500 selection:text-black">

    <!-- Top Navigation Bar -->
    <header class="fixed top-0 inset-x-0 z-50 bg-zinc-950/90 backdrop-blur-md border-b border-yellow-500/20">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <!-- Brand Emblem -->
            <a href="/" class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-full bg-gradient-to-br from-yellow-400 to-amber-600 p-0.5 flex items-center justify-center shadow-lg shadow-yellow-500/20">
                    <div class="w-full h-full rounded-full bg-zinc-950 flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('images/Tau_Gamma_Phi_seal.png') }}" alt="Tau Gamma Phi Seal" class="w-full h-full object-cover">
                    </div>
                </div>
                <div>
                    <span class="font-display text-lg font-bold tracking-wider text-yellow-400 block leading-none">TRISKELION</span>
                    <span class="text-[11px] uppercase tracking-[0.2em] text-zinc-400">Tau Gamma Phi &bull; Tau Gamma Sigma</span>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-zinc-300">
                <a href="#about" class="hover:text-yellow-400 transition">Tenets &amp; Heritage</a>
                <a href="#events" class="hover:text-yellow-400 transition">Events</a>
                <a href="#announcements" class="hover:text-yellow-400 transition">Announcements</a>
            </nav>

            <!-- Portal CTA -->
            <div class="flex items-center gap-3">
                @auth
                @php
                $dashboardUrl = match (auth()->user()->accountType) {
                'ADMIN' => url('/admin'),
                'COUNCIL' => url('/council'),
                'AREA' => url('/area'),
                'CHAPTER' => url('/chapter'),
                default => url('/member'),
                };
                @endphp
                <a href="{{ $dashboardUrl }}" class="px-5 py-2.5 rounded-lg bg-yellow-500 hover:bg-yellow-400 text-zinc-950 font-semibold text-sm transition shadow-lg shadow-yellow-500/20">
                    Go to Dashboard &rarr;
                </a>
                @else
                <div class="relative" id="loginDropdownWrapper">
                    <button
                        type="button"
                        id="loginDropdownBtn"
                        onclick="toggleLoginDropdown()"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-yellow-500 hover:bg-yellow-400 text-zinc-950 font-semibold text-sm transition shadow-lg shadow-yellow-500/20 cursor-pointer">
                        <span>Login</span>
                        <svg id="loginDropdownChevron" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- 5-Role Dropdown Menu -->
                    <div
                        id="loginDropdownMenu"
                        class="hidden absolute right-0 mt-2.5 w-72 rounded-xl bg-zinc-900 border border-yellow-500/30 shadow-2xl shadow-black/80 overflow-hidden z-50">
                        <div class="px-4 py-2.5 border-b border-zinc-800">
                            <span class="text-[11px] font-semibold uppercase tracking-widest text-zinc-400">Select Account Login</span>
                        </div>

                        <div class="p-1.5 space-y-1">
                            <!-- 1. Member Login -->
                            <a href="{{ url('/member/login') }}" class="flex items-start gap-3 p-2.5 rounded-lg hover:bg-yellow-500/10 group transition">
                                <div class="w-8 h-8 rounded-lg bg-yellow-500/15 border border-yellow-500/30 flex items-center justify-center text-yellow-400 font-display font-bold text-xs shrink-0 mt-0.5">
                                    M
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-white group-hover:text-yellow-400 transition">Member Login</div>
                                    <div class="text-xs text-zinc-400">Personal profile, events &amp; updates</div>
                                </div>
                            </a>

                            <!-- 2. Chapter Login -->
                            <a href="{{ url('/chapter/login') }}" class="flex items-start gap-3 p-2.5 rounded-lg hover:bg-yellow-500/10 group transition">
                                <div class="w-8 h-8 rounded-lg bg-yellow-500/15 border border-yellow-500/30 flex items-center justify-center text-yellow-400 font-display font-bold text-xs shrink-0 mt-0.5">
                                    CH
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-white group-hover:text-yellow-400 transition">Chapter Login</div>
                                    <div class="text-xs text-zinc-400">Chapter officers &amp; member roster</div>
                                </div>
                            </a>

                            <!-- 3. Area Login -->
                            <a href="{{ url('/area/login') }}" class="flex items-start gap-3 p-2.5 rounded-lg hover:bg-yellow-500/10 group transition">
                                <div class="w-8 h-8 rounded-lg bg-yellow-500/15 border border-yellow-500/30 flex items-center justify-center text-yellow-400 font-display font-bold text-xs shrink-0 mt-0.5">
                                    AR
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-white group-hover:text-yellow-400 transition">Area Login</div>
                                    <div class="text-xs text-zinc-400">Area jurisdiction &amp; chapters</div>
                                </div>
                            </a>

                            <!-- 4. Council Login -->
                            <a href="{{ url('/council/login') }}" class="flex items-start gap-3 p-2.5 rounded-lg hover:bg-yellow-500/10 group transition">
                                <div class="w-8 h-8 rounded-lg bg-yellow-500/15 border border-yellow-500/30 flex items-center justify-center text-yellow-400 font-display font-bold text-xs shrink-0 mt-0.5">
                                    CO
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-white group-hover:text-yellow-400 transition">Council Login</div>
                                    <div class="text-xs text-zinc-400">Council governance &amp; directives</div>
                                </div>
                            </a>
                            <div class="border-t border-zinc-800 my-1"></div>
                            <!-- 5. System Admin Login -->
                            <a href="{{ url('/admin/login') }}" class="flex items-start gap-3 p-2.5 rounded-lg hover:bg-yellow-500/10 group transition">
                                <div class="w-8 h-8 rounded-lg bg-zinc-800 border border-zinc-700 group-hover:border-yellow-500/30 flex items-center justify-center text-yellow-400 font-display font-bold text-xs shrink-0 mt-0.5">
                                    AD
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-white group-hover:text-yellow-400 transition">Admin Login</div>
                                    <div class="text-xs text-zinc-400">System-wide master control</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative pt-36 pb-24 lg:pt-44 lg:pb-32 overflow-hidden">
        <!-- Subtle Background Radial Glow -->
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-yellow-500/15 via-zinc-950 to-zinc-950"></div>

        <div class="max-w-7xl mx-auto px-6 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-yellow-500/10 border border-yellow-500/30 text-yellow-400 text-xs font-semibold uppercase tracking-widest mb-8">
                <span>Fortis &bull; Voluntas &bull; Fraternitas</span>
            </div>

            <h1 class="font-display text-4xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight uppercase leading-tight mb-6">
                <span class="block text-white">Tau Gamma Phi</span>
                <span class="block gold-gradient mt-1">&amp; Tau Gamma Sigma</span>
            </h1>

            <p class="max-w-2xl mx-auto text-zinc-400 text-base sm:text-lg leading-relaxed mb-10">
                United in brotherhood and sisterhood. The official digital registry, chapter management hub, and community portal for Triskelion Grand Fraternity and Sorority members.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ url('/admin') }}" class="px-8 py-3.5 rounded-lg bg-yellow-500 hover:bg-yellow-400 text-zinc-950 font-bold text-sm uppercase tracking-wider transition shadow-xl shadow-yellow-500/20">
                    Access Portal
                </a>
                <a href="#events" class="px-8 py-3.5 rounded-lg bg-zinc-900 hover:bg-zinc-800 text-zinc-200 border border-zinc-700 font-semibold text-sm uppercase tracking-wider transition">
                    Upcoming Activities
                </a>
            </div>

            <!-- Live Directory Statistics -->
            <div class="mt-20 grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-4xl mx-auto">
                <div class="p-6 rounded-2xl bg-zinc-900/70 border gold-border">
                    <div class="font-display text-3xl sm:text-4xl font-bold text-yellow-400">{{ number_format($stats['members'] ?? 0) }}</div>
                    <div class="text-xs uppercase tracking-widest text-zinc-400 mt-1">Registered Triskelions</div>
                </div>
                <div class="p-6 rounded-2xl bg-zinc-900/70 border gold-border">
                    <div class="font-display text-3xl sm:text-4xl font-bold text-yellow-400">{{ number_format($stats['chapters'] ?? 0) }}</div>
                    <div class="text-xs uppercase tracking-widest text-zinc-400 mt-1">Active Chapters</div>
                </div>
                <div class="p-6 rounded-2xl bg-zinc-900/70 border gold-border">
                    <div class="font-display text-3xl sm:text-4xl font-bold text-yellow-400">{{ number_format($stats['councils'] ?? 0) }}</div>
                    <div class="text-xs uppercase tracking-widest text-zinc-400 mt-1">Recognized Councils</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Tenets Section -->
    <section id="about" class="py-20 border-t border-zinc-900 bg-zinc-950">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-14">
                <h2 class="font-display text-3xl font-bold text-white uppercase tracking-wide">The Three-Legged Stool</h2>
                <p class="text-zinc-400 text-sm mt-2">Foundational pillars guiding every Brod and Sis</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 rounded-2xl bg-zinc-900/60 border gold-border gold-glow transition">
                    <div class="w-12 h-12 rounded-xl bg-yellow-500/10 border border-yellow-500/30 flex items-center justify-center text-yellow-400 font-display font-bold text-xl mb-5">I</div>
                    <h3 class="font-display text-xl font-bold text-yellow-400 mb-3">FORTIS (Strength)</h3>
                    <p class="text-zinc-400 text-sm leading-relaxed">
                        Strength of character, intellect, and moral conviction—standing resilient in the face of adversity while upholding truth and justice.
                    </p>
                </div>

                <div class="p-8 rounded-2xl bg-zinc-900/60 border gold-border gold-glow transition">
                    <div class="w-12 h-12 rounded-xl bg-yellow-500/10 border border-yellow-500/30 flex items-center justify-center text-yellow-400 font-display font-bold text-xl mb-5">II</div>
                    <h3 class="font-display text-xl font-bold text-yellow-400 mb-3">VOLUNTAS (Free Will)</h3>
                    <p class="text-zinc-400 text-sm leading-relaxed">
                        Freedom of thought and principled action—empowering every Triskelion to lead with wisdom, accountability, and self-determination.
                    </p>
                </div>

                <div class="p-8 rounded-2xl bg-zinc-900/60 border gold-border gold-glow transition">
                    <div class="w-12 h-12 rounded-xl bg-yellow-500/10 border border-yellow-500/30 flex items-center justify-center text-yellow-400 font-display font-bold text-xl mb-5">III</div>
                    <h3 class="font-display text-xl font-bold text-yellow-400 mb-3">FRATERNITAS (Brotherhood)</h3>
                    <p class="text-zinc-400 text-sm leading-relaxed">
                        Unwavering solidarity between Tau Gamma Phi and Tau Gamma Sigma—fostering lifelong service to the community and nation.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Upcoming Events Section (Live with Slider & Fixed Image Paths) -->
    <section id="events" class="py-20 border-t border-zinc-900 bg-zinc-900/30">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-widest text-yellow-400">Calendar &amp; Gatherings</span>
                    <h2 class="font-display text-3xl font-bold text-white uppercase mt-1">Upcoming Events</h2>
                </div>
                <div class="text-xs text-zinc-500 mt-2 sm:mt-0">Scroll horizontally to view more &rarr;</div>
            </div>

            @if($events->count())
            <!-- Horizontal Scroll Container -->
            <div class="flex gap-6 overflow-x-auto pb-6 snap-x snap-mandatory scrollbar-thin scrollbar-thumb-yellow-500/30 scrollbar-track-zinc-900">
                @foreach($events as $event)
                @php
                $photo = is_array($event->eventphotos) && count($event->eventphotos) > 0
                ? asset('storage/' . $event->eventphotos[0])
                : null;
                @endphp
                <div class="min-w-[320px] max-w-[350px] flex-1 rounded-2xl overflow-hidden bg-zinc-900 border gold-border gold-glow transition flex flex-col snap-start shrink-0">
                    @if($photo)
                    <img src="{{ $photo }}" alt="{{ $event->eventname }}" class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gradient-to-br from-zinc-800 to-zinc-950 flex items-center justify-center border-b border-zinc-800">
                        <span class="font-display text-yellow-500/40 text-xs tracking-widest uppercase">Triskelion Event</span>
                    </div>
                    @endif

                    <div class="p-6 flex-1 flex flex-col">
                        <div class="text-xs font-semibold text-yellow-400 uppercase tracking-wider mb-2">
                            {{ \Carbon\Carbon::parse($event->eventdate)->format('F d, Y') }}
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">{{ $event->eventname }}</h3>
                        <p class="text-zinc-400 text-sm line-clamp-3 flex-1">{{ $event->eventdetails }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="p-10 rounded-2xl bg-zinc-900/50 border border-zinc-800 text-center text-zinc-400 text-sm">
                No active events posted yet. Log in to the admin panel to schedule upcoming chapter or council events.
            </div>
            @endif
        </div>
    </section>
    <!-- Announcements / Posts Section (Live with Slider & Fixed Image Paths) -->
    <section id="announcements" class="py-20 border-t border-zinc-900 bg-zinc-950">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-widest text-yellow-400">News &amp; Directives</span>
                    <h2 class="font-display text-3xl font-bold text-white uppercase mt-1">Latest Announcements</h2>
                </div>
                <div class="text-xs text-zinc-500 mt-2 sm:mt-0">Scroll horizontally to view more &rarr;</div>
            </div>

            @if($posts->count())
            <!-- Horizontal Scroll Container -->
            <div class="flex gap-6 overflow-x-auto pb-6 snap-x snap-mandatory scrollbar-thin scrollbar-thumb-yellow-500/30 scrollbar-track-zinc-900">
                @foreach($posts as $post)
                @php
                $postPhoto = is_array($post->postphotos) && count($post->postphotos) > 0
                ? asset('storage/' . $post->postphotos[0])
                : null;
                @endphp
                <article class="min-w-[320px] max-w-[350px] flex-1 rounded-2xl overflow-hidden bg-zinc-900/70 border gold-border gold-glow transition flex flex-col snap-start shrink-0">
                    @if($postPhoto)
                    <img src="{{ $postPhoto }}" alt="{{ $post->postname }}" class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gradient-to-br from-zinc-800 to-zinc-950 flex items-center justify-center border-b border-zinc-800">
                        <span class="font-display text-yellow-500/40 text-xs tracking-widest uppercase">Triskelion Post</span>
                    </div>
                    @endif
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="text-xs text-zinc-500 mb-2">{{ $post->created_at->diffForHumans() }}</div>
                        <h3 class="text-lg font-bold text-white mb-2">{{ $post->postname }}</h3>
                        <p class="text-zinc-400 text-sm line-clamp-3">{{ $post->postdetails }}</p>
                    </div>
                </article>
                @endforeach
            </div>
            @else
            <div class="p-10 rounded-2xl bg-zinc-900/50 border border-zinc-800 text-center text-zinc-400 text-sm">
                No announcements published yet. Create posts in your Filament dashboard to display updates here.
            </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-yellow-500/20 bg-zinc-950 py-12">
        <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-zinc-500">
            <div>
                <span class="font-display font-bold text-yellow-400">TAU GAMMA PHI &bull; TAU GAMMA SIGMA</span>
                <span class="block sm:inline sm:ml-2">&copy; {{ date('Y') }} Triskelion Information System. All rights reserved.</span>
            </div>
            <div class="text-xs uppercase tracking-widest text-zinc-400">
                Long Live Triskelion!
            </div>
        </div>
    </footer>
    <script>
        function toggleLoginDropdown() {
            const menu = document.getElementById('loginDropdownMenu');
            const chevron = document.getElementById('loginDropdownChevron');
            menu.classList.toggle('hidden');
            chevron.classList.toggle('rotate-180');
        }

        document.addEventListener('click', function(event) {
            const wrapper = document.getElementById('loginDropdownWrapper');
            const menu = document.getElementById('loginDropdownMenu');
            const chevron = document.getElementById('loginDropdownChevron');

            if (wrapper && !wrapper.contains(event.target)) {
                menu.classList.add('hidden');
                chevron.classList.remove('rotate-180');
            }
        });
    </script>
</body>

</html>