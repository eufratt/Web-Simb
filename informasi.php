<!-- Informasi: Apa Itu Tanah Longsor? -->
<section id="info" class="py-20 bg-stone-600">
    <div class="container mx-auto px-2 pt-1">
        <div class="flex flex-col md:flex-row items-center gap-12">
            <!-- Gambar/Ilustrasi -->
            <div class="w-full md:w-1/2 bg-white/10 backdrop-blur-3xl border border-white/20 shadow-lg rounded-2xl px-1 py-1 flex items-center justify-between">
                <video autoplay muted loop playsinline class="w-full h-auto border rounded-xl drop-shadow-[0_0_17px_rgba(255,255,255,0.8)]">
                    <source src="assets/VideoAnimasi.mp4" type="video/mp4">
                </video>
            </div>
            <!-- Teks Penjelasan dengan Tab -->
            <div class="w-full md:w-1/2 bg-white/10 backdrop-blur-2xl border border-white/20 shadow-lg rounded-2xl px-6 py-4 text-white">
                <!-- Tab Navigation - Di tengah dan memenuhi ruangan -->
                <div class="flex justify-center border-b border-white/20 mb-6">
                    <button class="tab-button active flex-1 px-4 py-3 text-center text-white font-semibold border-b-2 border-white transition-all duration-300 hover:bg-white/10 rounded-t-lg" data-tab="definisi">Definisi</button>
                    <button class="tab-button flex-1 px-4 py-3 text-center text-white font-semibold border-b-2 border-transparent transition-all duration-300 hover:bg-white/10 rounded-t-lg" data-tab="faktor">Faktor Penyebab</button>
                    <button class="tab-button flex-1 px-4 py-3 text-center text-white font-semibold border-b-2 border-transparent transition-all duration-300 hover:bg-white/10 rounded-t-lg" data-tab="tipe">Tipe-Tipe</button>
                    <button class="tab-button flex-1 px-4 py-3 text-center text-white font-semibold border-b-2 border-transparent transition-all duration-300 hover:bg-white/10 rounded-t-lg" data-tab="dampak">Dampak</button>
                </div>

                <!-- Tab Content - Estetik dengan padding dan spacing -->
                <div class="tab-content h-80 overflow-y-auto p-4 space-y-4">
                    <!-- Tab Definisi -->
                    <div id="definisi" class="tab-pane active">
                        <h2 class="text-3xl md:text-4xl font-bold mb-6 text-center">Definisi Tanah Longsor</h2>
                        <p class="text-white text-lg mb-4 leading-relaxed">Tanah longsor adalah perpindahan material pembentuk lereng...</p>
                        <p class="text-white text-lg mb-6 leading-relaxed">Peristiwa ini dapat terjadi secara tiba-tiba atau perlahan...</p>
                    </div>

                    <!-- Tab Faktor Penyebab -->
                    <div id="faktor" class="tab-pane hidden">
                        <h2 class="text-3xl md:text-4xl font-bold mb-6 text-center">Faktor Penyebab Terjadinya Longsor</h2>
                        <h4 class="text-2xl font-semibold mb-4">A. Faktor Alam</h4>
                        <ol class="list-decimal ml-6 space-y-3 mb-6">
                            <li class="leading-relaxed">Perubahan kondisi geologi...</li>
                            <li class="leading-relaxed">Curah hujan tinggi...</li>
                            <li class="leading-relaxed">Topografi curam...</li>
                        </ol>
                        <h4 class="text-2xl font-semibold mb-4">B. Faktor Manusia</h4>
                        <ol class="list-decimal ml-6 space-y-3 mb-8">
                            <li class="leading-relaxed">Penggundulan hutan...</li>
                            <li class="leading-relaxed">Pembangunan permukiman...</li>
                            <li class="leading-relaxed">Sistem drainase buruk...</li>
                        </ol>
                    </div>

                    <!-- Tab Tipe-Tipe -->
                    <div id="tipe" class="tab-pane hidden">
                        <h2 class="text-3xl md:text-4xl font-bold mb-6 text-center">Tipe-Tipe Tanah Longsor</h2>
                        <ul class="list-disc ml-6 space-y-3 mb-8">
                            <li class="leading-relaxed"><strong>Falls</strong> – material batu...</li>
                            <li class="leading-relaxed"><strong>Slides</strong> – pergerakan tanah...</li>
                            <li class="leading-relaxed"><strong>Flows</strong> – tanah bergerak...</li>
                            <li class="leading-relaxed"><strong>Topples</strong> – tanah atau batuan...</li>
                            <li class="leading-relaxed"><strong>Creep</strong> – pergerakan lambat...</li>
                            <li class="leading-relaxed"><strong>Spread</strong> – penyebaran lateral...</li>
                        </ul>
                    </div>

                    <!-- Tab Dampak -->
                    <div id="dampak" class="tab-pane hidden">
                        <h2 class="text-3xl md:text-4xl font-bold mb-6 text-center">Dampak Tanah Longsor</h2>
                        <h4 class="text-2xl font-semibold mb-4">Dampak Positif</h4>
                        <ul class="list-disc ml-6 space-y-3 mb-6">
                            <li class="leading-relaxed">Meningkatkan kestabilan tanah...</li>
                            <li class="leading-relaxed">Membentuk lahan baru...</li>
                            <li class="leading-relaxed">Membantu proses pelapukan batuan...</li>
                            <li class="leading-relaxed">Meningkatkan kelembapan tanah...</li>
                        </ul>
                        <h4 class="text-2xl font-semibold mb-4">Dampak Negatif</h4>
                        <ul class="list-disc ml-6 space-y-3 mb-10">
                            <li class="leading-relaxed">Kerusakan lingkungan...</li>
                            <li class="leading-relaxed">Kerugian materi...</li>
                            <li class="leading-relaxed">Gangguan ekonomi...</li>
                            <li class="leading-relaxed">Risiko korban jiwa...</li>
                        </ul>
                        <div class="bg-white/20 border border-white/40 text-white p-4 rounded-lg text-center shadow-md">
                            <p class="font-medium italic">Memahami risiko di sekitar kita adalah langkah awal untuk keselamatan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript untuk Tab Functionality -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabPanes = document.querySelectorAll('.tab-pane');

        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons and panes
                tabButtons.forEach(btn => {
                    btn.classList.remove('active', 'border-white');
                    btn.classList.add('border-transparent');
                });
                tabPanes.forEach(pane => pane.classList.add('hidden'));

                // Add active class to clicked button and corresponding pane
                this.classList.add('active');
                this.classList.remove('border-transparent');
                this.classList.add('border-white');
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.remove('hidden');
            });
        });
    });
</script>
