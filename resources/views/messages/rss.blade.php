{{-- @php echo '<?xml version="1.0" encoding="UTF-8"?>'; @endphp
<rss version="2.0">
    <channel>
        <title>Tube Feed Tracker Updates</title>
        <link>{{ url('/messages') }}</link>
        <description>Latest updates and messages from Tube Feed Tracker</description>
        <language>en-us</language>
        @foreach($messages as $message)
        <item>
            <title>{{ $message->title }}</title>
            <link>{{ url('/messages') }}</link>
            <description>{{ $message->message }}</description>
            <pubDate>{{ $message->published_at->toRssString() }}</pubDate>
            <guid>{{ url('/messages') }}#{{ $message->id }}</guid>
        </item>
        @endforeach
    </channel>
</rss> --}}