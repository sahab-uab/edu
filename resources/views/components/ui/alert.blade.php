<div>
    @if (session()->has('error'))
        <div class="errro-label mb-3 text-base bg-red-100 gap-x-1.5 text-red-500 w-full py-2 px-2 rounded-base inline-flex">
            <i class="ri-error-warning-line"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif
    @if (session()->has('success'))
        <div class="errro-label mb-3 text-base bg-green-100 gap-x-1.5 text-green-500 w-full py-2 px-2 rounded-base inline-flex">
            <i class="ri-checkbox-circle-line"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
</div>
