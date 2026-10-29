<x-mail::message>
# New enquiry: {{ $enquiry->topic }}

**{{ $enquiry->name }}** ({{ $enquiry->email }}{{ $enquiry->phone ? ', '.$enquiry->phone : '' }}) sent a message through the website:

<x-mail::panel>
{{ $enquiry->message }}
</x-mail::panel>

<x-mail::button :url="route('admin.enquiries.index')">
View enquiries
</x-mail::button>

Reply to this email to answer {{ Str::before($enquiry->name, ' ') }} directly.
</x-mail::message>
