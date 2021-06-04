@props(['type'])

@if(session()->has($type))
    <div class="pt-5">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm">
                <div class="p-6 bg-green-300 border-b border-gray-200">
                    {{ session($type) }}
                </div>
            </div>
        </div>
    </div>
@endif
