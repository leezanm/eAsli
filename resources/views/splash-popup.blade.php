<!-- Splash Popup Modal -->
<div id="splashModal" class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm hidden" style="z-index: 9999;">
    <div class="relative w-full max-w-4xl mx-4 bg-white rounded-3xl shadow-2xl animate-in fade-in zoom-in duration-300 overflow-hidden">
        <!-- Close Button -->
        <button onclick="closeSplash()" class="absolute top-4 right-4 inline-flex items-center justify-center w-10 h-10 rounded-full bg-neutral-100 hover:bg-neutral-200 text-neutral-700 transition" style="z-index: 10000;">
            <i class="fas fa-times text-xl"></i>
        </button>

        <!-- Content -->
        <div class="p-0 md:p-8">
            <!-- Header -->
            <div class="text-center mb-6 px-6 pt-6">
                <span class="inline-block bg-gradient-to-r from-accent-500 to-accent-600 text-white px-4 py-2 rounded-full font-bold text-xs uppercase tracking-wider mb-4">
                    🎬 Featured Video
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-neutral-900 mb-2">Discover Our Story</h2>
                <p class="text-neutral-600 text-sm md:text-base">Watch what makes us special</p>
            </div>

            <!-- Video Container -->
            <div class="relative w-full bg-black rounded-2xl overflow-hidden mx-6 mb-6" style="padding-bottom: 56.25%;">
                <video
                    id="splashVideo"
                    class="absolute inset-0 w-full h-full object-cover"
                    controls
                    autoplay
                    muted
                    controlsList="nodownload"
                >
                    <source src="{{ asset('storage/video/easli_intro.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>

                <!-- Fallback message if video not found -->
                <div id="videoFallback" class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-neutral-200 to-neutral-300 hidden">
                    <div class="text-center">
                        <i class="fas fa-video text-5xl text-neutral-400 mb-3"></i>
                        <p class="text-neutral-600 font-semibold">Video not available</p>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            {{-- <div class="border-t border-neutral-200 px-6 py-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3"> --}}
                    {{-- <a href="{{ route('products.shop') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-gradient-to-r from-accent-500 to-accent-600 text-white font-bold shadow-lg hover:shadow-xl transition transform hover:scale-105">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Start Shopping</span>
                    </a> --}}
                    {{-- <button onclick="closeSplash()" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg border-2 border-neutral-300 text-neutral-700 font-bold hover:bg-neutral-50 transition">
                        <i class="fas fa-times"></i>
                        <span>Close</span>
                    </button> --}}
                {{-- </div>
            </div> --}}
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes zoomIn {
        from {
            transform: scale(0.95);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .animate-in.fade-in {
        animation: fadeIn 0.3s ease-in-out;
    }

    .animate-in.zoom-in {
        animation: zoomIn 0.3s ease-in-out;
    }
</style>

<script>
    function closeSplash() {
        const modal = document.getElementById('splashModal');
        modal.classList.add('hidden');
        // Store in sessionStorage so it doesn't show again during this session
        sessionStorage.setItem('splashClosed', 'true');
    }

    function refreshSplash() {
        // Reload the page to get new random products
        location.reload();
    }

    function showSplash() {
        const modal = document.getElementById('splashModal');
        // Check if user already closed it this session
        if (sessionStorage.getItem('splashClosed') !== 'true') {
            modal.classList.remove('hidden');
        }
    }

    // Show splash when page loads (after a small delay for better UX)
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(showSplash, 800);
    });
</script>
