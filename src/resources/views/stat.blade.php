<h1>Statistic for {{ $urls['short'] }} ({{ $urls['source'] }})</h1>

<h2>Summary</h2>

<table>
    <caption>Visits</caption>
    <th>Total</th>
    <td>{{ $total }}</td>
</table>


<h2>Last 50 visits</h2>

<table>
    <caption>Visitors</caption>
    <tr>
        <th>Ip address</th>
        <th>Region</th>
        <th>Browser name</th>
        <th>Browser version</th>
        <th>Platform</th>
    </tr>

    @foreach ($visitors as $visitor)
        <tr>
            <td>{{ $visitor->ip }}</td>
            <td>{{ $visitor->region }}</td>
            <td>{{ $visitor->browser_name }}</td>
            <td>{{ $visitor->browser_version }}</td>
            <td>{{ $visitor->platform }}</td>
        </tr>
    @endforeach

</table>


