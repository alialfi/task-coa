<table>
    <thead>
        <tr>
            <th>Category</th>
            @foreach ($result['months'] as $month)
                <th>{{ $month }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($result['categories'] as $cat)
            <tr>
                <td>{{ $cat['name'] }}</td>
                @foreach ($result['months'] as $month)
                    <td>{{ $cat['months'][$month] ?? 0 }}</td>
                @endforeach
            </tr>
        @endforeach

        <tr>
            <th>Total Income</th>
            @foreach ($result['months'] as $month)
                <th>{{ $result['totals'][$month]['income'] ?? 0 }}</th>
            @endforeach
        </tr>
        <tr>
            <th>Total Expense</th>
            @foreach ($result['months'] as $month)
                <th>{{ $result['totals'][$month]['expense'] ?? 0 }}</th>
            @endforeach
        </tr>
        <tr>
            <th>Net Income</th>
            @foreach ($result['months'] as $month)
                <th>{{ $result['totals'][$month]['net'] ?? 0 }}</th>
            @endforeach
        </tr>
    </tbody>
</table>
