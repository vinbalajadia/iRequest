<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - iRequest System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        
        /* Subtle Dot Background Pattern */
        .bg-dot-pattern {
            background-image: radial-gradient(#e5e7eb 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="bg-white text-zinc-950 antialiased selection:bg-zinc-900 selection:text-white">
    
    <div class="fixed inset-0 -z-10 h-full w-full bg-white bg-dot-pattern [mask-image:radial-gradient(ellipse_at_center,white,transparent)]"></div>

    <div class="relative flex min-h-screen flex-col">
        <nav class="sticky top-0 z-50 w-full border-b border-zinc-100 bg-white/80 backdrop-blur-md">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-8">
                <div class="flex items-center gap-2">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-zinc-900 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <span class="text-lg font-bold tracking-tight">iRequest</span>
                </div>
                
                <div class="flex items-center gap-6">
                    <a href="{{ route('student.login') }}" class="text-sm font-medium text-zinc-600 hover:text-zinc-900 transition-colors">Log in</a>
                    <a href="{{ route('admin.login') }}" class="rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white hover:bg-zinc-800 transition-colors shadow-sm ring-1 ring-zinc-900/5">
                        Admin Portal
                    </a>
                </div>
            </div>
        </nav>

        <main class="flex-grow">
            <div class="relative pt-20 pb-24 sm:pt-32 sm:pb-32">
                <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
                    
                    <div class="mb-8 flex justify-center fade-in">
                        <div class="rounded-full border border-zinc-200 bg-white px-3 py-1 text-sm text-zinc-600 shadow-sm">
                            <span class="font-medium text-zinc-900">New System</span> &middot; Faster processing times
                        </div>
                    </div>

                    <h1 class="mx-auto max-w-4xl text-5xl font-extrabold tracking-tighter text-zinc-900 sm:text-7xl">
                        Document requests, <br class="hidden sm:block" />
                        <span class="text-zinc-500">simplified.</span>
                    </h1>
                    
                    <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-zinc-600">
                        The official student document management system. Request transcripts, diplomas, and certifications without the queue.
                    </p>

                    <div class="mt-10 flex items-center justify-center gap-x-4">
                        <a href="{{ route('student.register') }}" class="group rounded-lg bg-zinc-900 px-8 py-3.5 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-900 transition-all">
                            Get Started
                            <span class="inline-block transition-transform group-hover:translate-x-1 ml-1">→</span>
                        </a>
                        <a href="#features" class="text-sm font-semibold leading-6 text-zinc-900 hover:text-zinc-600 transition-colors">
                            Learn more
                        </a>
                    </div>
                </div>
            </div>

            <div id="features" class="mx-auto max-w-7xl px-6 lg:px-8 pb-24">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <div class="group relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-8 transition-all hover:border-zinc-300 hover:shadow-lg hover:shadow-zinc-200/50">
                        <div class="mb-4 inline-flex h-10 w-10 items-center justify-center rounded-lg bg-zinc-100 group-hover:bg-zinc-900 group-hover:text-white transition-colors">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-zinc-900">Online Request</h3>
                        <p class="mt-2 text-sm text-zinc-500">Submit requests from anywhere. No need to visit the registrar's office physically.</p>
                    </div>

                    <div class="group relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-8 transition-all hover:border-zinc-300 hover:shadow-lg hover:shadow-zinc-200/50">
                        <div class="mb-4 inline-flex h-10 w-10 items-center justify-center rounded-lg bg-zinc-100 group-hover:bg-zinc-900 group-hover:text-white transition-colors">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-zinc-900">Real-time Tracking</h3>
                        <p class="mt-2 text-sm text-zinc-500">Get live updates on your document status via email or dashboard notifications.</p>
                    </div>

                    <div class="group relative overflow-hidden rounded-2xl border border-zinc-200 bg-white p-8 transition-all hover:border-zinc-300 hover:shadow-lg hover:shadow-zinc-200/50">
                        <div class="mb-4 inline-flex h-10 w-10 items-center justify-center rounded-lg bg-zinc-100 group-hover:bg-zinc-900 group-hover:text-white transition-colors">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-zinc-900">Fast Processing</h3>
                        <p class="mt-2 text-sm text-zinc-500">Automated workflows ensure your documents are prepared and released quickly.</p>
                    </div>
                </div>
            </div>

            <div class="border-t border-zinc-100 bg-zinc-50/50">
                <div class="mx-auto max-w-7xl px-6 py-24 lg:px-8">
                    <div class="mx-auto max-w-2xl text-center mb-16">
                        <h2 class="text-3xl font-bold tracking-tight text-zinc-900">Available Documents</h2>
                        <p class="mt-4 text-zinc-600">Everything you need, ready for request.</p>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        <div class="flex items-center gap-4 rounded-xl border border-zinc-200 bg-white p-4 shadow-sm transition-hover hover:border-zinc-400">
                            <div class="flex h-10 w-10 flex-none items-center justify-center rounded-full bg-zinc-100 text-zinc-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            </div>
                            <span class="text-sm font-semibold text-zinc-900">Transcript of Records</span>
                        </div>
                         <div class="flex items-center gap-4 rounded-xl border border-zinc-200 bg-white p-4 shadow-sm transition-hover hover:border-zinc-400">
                            <div class="flex h-10 w-10 flex-none items-center justify-center rounded-full bg-zinc-100 text-zinc-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" /></svg>
                            </div>
                            <span class="text-sm font-semibold text-zinc-900">Good Moral Cert.</span>
                        </div>
                         <div class="flex items-center gap-4 rounded-xl border border-zinc-200 bg-white p-4 shadow-sm transition-hover hover:border-zinc-400">
                            <div class="flex h-10 w-10 flex-none items-center justify-center rounded-full bg-zinc-100 text-zinc-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                            </div>
                            <span class="text-sm font-semibold text-zinc-900">Diploma</span>
                        </div>
                         <div class="flex items-center gap-4 rounded-xl border border-zinc-200 bg-white p-4 shadow-sm transition-hover hover:border-zinc-400">
                            <div class="flex h-10 w-10 flex-none items-center justify-center rounded-full bg-zinc-100 text-zinc-600">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                            </div>
                            <span class="text-sm font-semibold text-zinc-900">Cert. of Enrollment</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="border-t border-zinc-200 bg-white">
            <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8 flex flex-col items-center">
                <div class="flex items-center gap-2 mb-4 opacity-50">
                    <div class="h-5 w-5 bg-zinc-900 rounded-md"></div>
                    <span class="text-sm font-bold tracking-tight">iRequest</span>
                </div>
                <p class="text-center text-xs text-zinc-500">
                    &copy; 2024 iRequest System. <span class="mx-1">&middot;</span> Built for students.
                </p>
            </div>
        </footer>
    </div>
</body>
</html>