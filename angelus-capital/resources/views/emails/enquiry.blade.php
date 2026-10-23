@php
    $rows = array_filter([
        'Name' => $enquiry['name'] ?? null,
        'Email' => $enquiry['email'] ?? null,
        'Phone' => $enquiry['phone'] ?? null,
        'Organization' => $enquiry['organization'] ?? null,
        'Enquiry' => config('acpl.enquiry_types.'.$enquiry['enquiry_type']),
        'Routed to' => $unit,
    ]);
@endphp
<!DOCTYPE html>
<html lang="en">
    <body style="margin:0;padding:24px;background:#f5f1e8;font-family:Arial,Helvetica,sans-serif;color:#001233;">
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;margin:0 auto;background:#ffffff;border-radius:12px;overflow:hidden;">
            <tr>
                <td style="background:#001440;padding:24px 28px;color:#f2d18a;font-size:18px;">New website enquiry</td>
            </tr>
            <tr>
                <td style="padding:28px;">
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                        @foreach ($rows as $label => $value)
                            <tr>
                                <td style="padding:8px 0;width:140px;color:#56627a;font-size:13px;vertical-align:top;">{{ $label }}</td>
                                <td style="padding:8px 0;font-size:14px;">{{ $value }}</td>
                            </tr>
                        @endforeach
                    </table>

                    @if (filled($enquiry['message'] ?? null))
                        <p style="margin:24px 0 8px;color:#56627a;font-size:13px;">Message</p>
                        <p style="margin:0;font-size:14px;line-height:1.6;white-space:pre-line;">{{ $enquiry['message'] }}</p>
                    @endif

                    @if ($answers !== [])
                        <p style="margin:24px 0 8px;color:#56627a;font-size:13px;">Pre-consultation questionnaire</p>
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                            @foreach ($answers as $question => $answer)
                                <tr>
                                    <td style="padding:6px 0;width:220px;color:#56627a;font-size:13px;vertical-align:top;">{{ $question }}</td>
                                    <td style="padding:6px 0;font-size:14px;">{{ $answer }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @endif

                    @if ($campaign !== [])
                        <p style="margin:24px 0 8px;color:#56627a;font-size:13px;">Where this lead came from</p>
                        <p style="margin:0;font-size:12px;line-height:1.6;color:#56627a;">
                            @foreach ($campaign as $key => $value)
                                {{ $key }}: {{ $value }}<br>
                            @endforeach
                        </p>
                    @endif

                    <p style="margin:28px 0 0;font-size:12px;color:#56627a;">Reply to this email to respond directly to {{ $enquiry['name'] }}.</p>
                </td>
            </tr>
        </table>
    </body>
</html>
