<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tube Feed Tracker - Updates</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 py-12">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Tube Feed Tracker Updates</h1>
            <p class="text-gray-600">Latest features, tips, and messages</p>
            {{-- <a href="{{ route('messages.rss') }}" class="inline-flex items-center mt-4 text-blue-600 hover:text-blue-700">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M5 3a1 1 0 000 2c5.523 0 10 4.477 10 10a1 1 0 102 0C17 8.373 11.627 3 5 3z"/>
                    <path d="M4 9a1 1 0 011-1 7 7 0 017 7 1 1 0 11-2 0 5 5 0 00-5-5 1 1 0 01-1-1zM3 15a2 2 0 114 0 2 2 0 01-4 0z"/>
                </svg>
                Subscribe via RSS
            </a> --}}
        </div>

        <!-- messages -->
        <div class="space-y-6">
            @forelse($messages as $message)
                <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 
                    {{ $message->type === 'feature' ? 'border-green-500' : '' }}
                    {{ $message->type === 'tip' ? 'border-blue-500' : '' }}
                    {{ $message->type === 'update' ? 'border-purple-500' : '' }}
                    {{ $message->type === 'maintenance' ? 'border-yellow-500' : '' }}
                ">
                    <!-- Type Badge -->
                    <div class="flex items-center mb-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            {{ $message->type === 'feature' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $message->type === 'tip' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $message->type === 'update' ? 'bg-purple-100 text-purple-800' : '' }}
                            {{ $message->type === 'maintenance' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        ">
                            @if($message->type === 'feature') 🎉 New Feature
                            @elseif($message->type === 'tip') 💡 Tip
                            @elseif($message->type === 'update') 📢 Update
                            @else 🔧 Maintenance
                            @endif
                        </span>
                    </div>

                    <!-- Title -->
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">
                        {{ $message->title }}
                    </h2>

                    <!-- Message -->
                    <div class="text-gray-700 mb-4 prose max-w-none">
                        {!! nl2br(e($message->message)) !!}
                    </div>

                    <!-- Date -->
                    <p class="text-sm text-gray-500">
                        Posted {{ $message->published_at->diffForHumans() }}
                    </p>
                </div>
            @empty
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">No messages yet. Check back soon!</p>
                </div>
            @endforelse
        </div>

        <!-- Footer -->
        <div class="text-center mt-12 text-gray-600">
            <p>Questions? Visit <a href="https://tubefeedrate.com" class="text-blue-600 hover:underline">Tube Feed Tracker</a></p>
        </div>
    </div>
</body>
</html>